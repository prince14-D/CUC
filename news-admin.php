<?php
session_start();

require_once __DIR__ . '/includes/news_storage.php';

$adminUser = getenv('CUC_ADMIN_USER') ?: 'admin';
$adminPass = getenv('CUC_ADMIN_PASS') ?: 'changeme-now';
$usingDefaultCredentials = getenv('CUC_ADMIN_USER') === false || getenv('CUC_ADMIN_PASS') === false;

$loginError = '';
$formError = '';
$formSuccess = '';

function cuc_upload_site_image(array $file, string $publicPrefix, string &$error): ?string
{
    $uploadError = (int)($file['error'] ?? UPLOAD_ERR_NO_FILE);
    if ($uploadError === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if ($uploadError !== UPLOAD_ERR_OK) {
        $error = 'Image upload failed. Please try again.';
        return null;
    }

    $tmpName = (string)($file['tmp_name'] ?? '');
    if ($tmpName === '' || !is_uploaded_file($tmpName)) {
        $error = 'Invalid uploaded image file.';
        return null;
    }

    $size = (int)($file['size'] ?? 0);
    if ($size > 3 * 1024 * 1024) {
        $error = 'Image is too large. Maximum size is 3MB.';
        return null;
    }

    $imageInfo = @getimagesize($tmpName);
    $imageType = is_array($imageInfo) ? (int)($imageInfo[2] ?? 0) : 0;
    $allowed = [
        IMAGETYPE_JPEG => 'jpg',
        IMAGETYPE_PNG => 'png',
        IMAGETYPE_WEBP => 'webp',
        IMAGETYPE_GIF => 'gif',
    ];

    if (!isset($allowed[$imageType])) {
        $error = 'Only JPG, PNG, WEBP, and GIF images are allowed.';
        return null;
    }

    $publicDir = rtrim($publicPrefix, '/');
    $absoluteDir = __DIR__ . '/' . $publicDir;
    if (!is_dir($absoluteDir) && !mkdir($absoluteDir, 0775, true)) {
        $error = 'Unable to create image upload folder.';
        return null;
    }

    $filename = 'img_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $allowed[$imageType];
    $absoluteTarget = $absoluteDir . '/' . $filename;

    $saveWithGd = static function ($sourcePath, int $type, string $targetPath): bool {
        $createFnsLocal = [
            IMAGETYPE_JPEG => 'imagecreatefromjpeg',
            IMAGETYPE_PNG => 'imagecreatefrompng',
            IMAGETYPE_WEBP => 'imagecreatefromwebp',
            IMAGETYPE_GIF => 'imagecreatefromgif',
        ];

        $createFn = $createFnsLocal[$type] ?? null;
        if (!is_string($createFn) || !function_exists($createFn) || !function_exists('imagecreatetruecolor')) {
            return false;
        }

        $size = @getimagesize($sourcePath);
        if (!is_array($size)) {
            return false;
        }

        $srcWidth = (int)($size[0] ?? 0);
        $srcHeight = (int)($size[1] ?? 0);
        if ($srcWidth <= 0 || $srcHeight <= 0) {
            return false;
        }

        $maxWidth = 1600;
        $maxHeight = 1200;
        $scale = min($maxWidth / $srcWidth, $maxHeight / $srcHeight, 1);

        $dstWidth = max(1, (int)round($srcWidth * $scale));
        $dstHeight = max(1, (int)round($srcHeight * $scale));

        $src = @($createFn)($sourcePath);
        if ($src === false) {
            return false;
        }

        $dst = imagecreatetruecolor($dstWidth, $dstHeight);
        if ($dst === false) {
            imagedestroy($src);
            return false;
        }

        if ($type === IMAGETYPE_PNG || $type === IMAGETYPE_WEBP || $type === IMAGETYPE_GIF) {
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
            $transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
            imagefilledrectangle($dst, 0, 0, $dstWidth, $dstHeight, $transparent);
        }

        imagecopyresampled($dst, $src, 0, 0, 0, 0, $dstWidth, $dstHeight, $srcWidth, $srcHeight);

        $saved = false;
        if ($type === IMAGETYPE_JPEG && function_exists('imagejpeg')) {
            $saved = imagejpeg($dst, $targetPath, 82);
        } elseif ($type === IMAGETYPE_PNG && function_exists('imagepng')) {
            $saved = imagepng($dst, $targetPath, 6);
        } elseif ($type === IMAGETYPE_WEBP && function_exists('imagewebp')) {
            $saved = imagewebp($dst, $targetPath, 82);
        } elseif ($type === IMAGETYPE_GIF && function_exists('imagegif')) {
            $saved = imagegif($dst, $targetPath);
        }

        imagedestroy($dst);
        imagedestroy($src);

        return (bool)$saved;
    };

    $gdAvailable = isset($allowed[$imageType]) && function_exists('imagecreatetruecolor');
    if ($gdAvailable) {
        if ($saveWithGd($tmpName, $imageType, $absoluteTarget)) {
            return $publicDir . '/' . $filename;
        }
    }

    if (!move_uploaded_file($tmpName, $absoluteTarget)) {
        $error = 'Unable to save uploaded image.';
        return null;
    }

    return $publicDir . '/' . $filename;
}

function cuc_upload_news_image(array $file, string &$error): ?string
{
    return cuc_upload_site_image($file, cuc_news_public_image_prefix(), $error);
}

function cuc_upload_event_image(array $file, string &$error): ?string
{
    return cuc_upload_site_image($file, cuc_event_public_image_prefix(), $error);
}

function cuc_upload_alumni_honor_image(array $file, string &$error): ?string
{
    return cuc_upload_site_image($file, cuc_alumni_honor_public_image_prefix(), $error);
}

if (empty($_SESSION['news_admin_csrf'])) {
    $_SESSION['news_admin_csrf'] = bin2hex(random_bytes(16));
}

$csrfToken = (string)$_SESSION['news_admin_csrf'];

$defaultFormState = [
    'month_label' => date('F Y'),
    'publish_date' => date('Y-m-d'),
    'title' => '',
    'summary' => '',
    'url' => '',
    'image_path' => '',
    'published' => true,
];

$formState = $defaultFormState;
$editingPostId = null;

$defaultEventFormState = [
    'title' => '',
    'event_date' => date('Y-m-d'),
    'event_time' => '',
    'location' => '',
    'summary' => '',
    'url' => '',
    'image_path' => '',
    'published' => true,
];

$eventFormState = $defaultEventFormState;
$editingEventId = null;
$eventFormError = '';
$eventFormSuccess = '';

$defaultJobFormState = [
    'title' => '',
    'department' => '',
    'location' => '',
    'employment_type' => '',
    'deadline' => date('Y-m-d'),
    'summary' => '',
    'requirements' => '',
    'application_email' => '',
    'application_url' => '',
    'published' => true,
];

$jobFormState = $defaultJobFormState;
$editingJobId = null;
$jobFormError = '';
$jobFormSuccess = '';

$defaultHonorFormState = [
    'title' => '',
    'honor_level' => '',
    'gpa' => '',
    'image_path' => '',
    'published' => true,
];

$honorFormState = $defaultHonorFormState;
$editingHonorId = null;
$honorFormError = '';
$honorFormSuccess = '';

$isAuthenticated = !empty($_SESSION['news_admin_logged_in']);

if (!$isAuthenticated && (!isset($_POST['action']) || (string)$_POST['action'] !== 'login')) {
    header('Location: news-admin-login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'logout') {
    $_SESSION['news_admin_logged_in'] = false;
    $_SESSION['news_admin_user'] = null;
    header('Location: news-admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'login') {
    $username = trim((string)($_POST['username'] ?? ''));
    $password = (string)($_POST['password'] ?? '');

    if (hash_equals((string)$adminUser, $username) && hash_equals((string)$adminPass, $password)) {
        $_SESSION['news_admin_logged_in'] = true;
        $_SESSION['news_admin_user'] = $username;
        header('Location: news-admin.php');
        exit;
    }

    $loginError = 'Invalid username or password.';
}

$allPosts = $isAuthenticated ? cuc_read_news_posts() : [];
$allEvents = $isAuthenticated ? cuc_read_events() : [];
$allJobs = $isAuthenticated ? cuc_read_job_vacancies() : [];
$allHonors = $isAuthenticated ? cuc_read_alumni_honors() : [];

if ($isAuthenticated && isset($_GET['edit'])) {
    $candidateId = trim((string)$_GET['edit']);
    if ($candidateId !== '') {
        foreach ($allPosts as $candidatePost) {
            if ((string)$candidatePost['id'] !== $candidateId) {
                continue;
            }

            $editingPostId = $candidateId;
            $formState = [
                'month_label' => (string)$candidatePost['month_label'],
                'publish_date' => (string)$candidatePost['publish_date'],
                'title' => (string)$candidatePost['title'],
                'summary' => (string)$candidatePost['summary'],
                'url' => (string)$candidatePost['url'],
                'image_path' => (string)($candidatePost['image_path'] ?? ''),
                'published' => !empty($candidatePost['published']),
            ];
            break;
        }
    }
}

if ($isAuthenticated && isset($_GET['event_edit'])) {
    $candidateId = trim((string)$_GET['event_edit']);
    if ($candidateId !== '') {
        foreach ($allEvents as $candidateEvent) {
            if ((string)$candidateEvent['id'] !== $candidateId) {
                continue;
            }

            $editingEventId = $candidateId;
            $eventFormState = [
                'title' => (string)$candidateEvent['title'],
                'event_date' => (string)$candidateEvent['event_date'],
                'event_time' => (string)$candidateEvent['event_time'],
                'location' => (string)$candidateEvent['location'],
                'summary' => (string)$candidateEvent['summary'],
                'url' => (string)$candidateEvent['url'],
                'image_path' => (string)($candidateEvent['image_path'] ?? ''),
                'published' => !empty($candidateEvent['published']),
            ];
            break;
        }
    }
}

if ($isAuthenticated && isset($_GET['job_edit'])) {
    $candidateId = trim((string)$_GET['job_edit']);
    if ($candidateId !== '') {
        foreach ($allJobs as $candidateJob) {
            if ((string)$candidateJob['id'] !== $candidateId) {
                continue;
            }

            $editingJobId = $candidateId;
            $jobFormState = [
                'title' => (string)$candidateJob['title'],
                'department' => (string)$candidateJob['department'],
                'location' => (string)$candidateJob['location'],
                'employment_type' => (string)$candidateJob['employment_type'],
                'deadline' => (string)$candidateJob['deadline'],
                'summary' => (string)$candidateJob['summary'],
                'requirements' => (string)$candidateJob['requirements'],
                'application_email' => (string)$candidateJob['application_email'],
                'application_url' => (string)$candidateJob['application_url'],
                'published' => !empty($candidateJob['published']),
            ];
            break;
        }
    }
}

if ($isAuthenticated && isset($_GET['honor_edit'])) {
    $candidateId = trim((string)$_GET['honor_edit']);
    if ($candidateId !== '') {
        foreach ($allHonors as $candidateHonor) {
            if ((string)$candidateHonor['id'] !== $candidateId) {
                continue;
            }

            $editingHonorId = $candidateId;
            $honorFormState = [
                'title' => (string)$candidateHonor['title'],
                'honor_level' => (string)$candidateHonor['honor_level'],
                'gpa' => (string)$candidateHonor['gpa'],
                'image_path' => (string)($candidateHonor['image_path'] ?? ''),
                'published' => !empty($candidateHonor['published']),
            ];
            break;
        }
    }
}

if ($isAuthenticated && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $postedCsrf = (string)($_POST['csrf_token'] ?? '');
    if (!hash_equals($csrfToken, $postedCsrf)) {
        $formError = 'Invalid request token. Please refresh and try again.';
    } else {
        $action = (string)($_POST['action'] ?? '');

        if ($action === 'delete_post') {
            $postId = trim((string)($_POST['post_id'] ?? ''));
            if ($postId === '') {
                $formError = 'Unable to identify post for deletion.';
            } else {
                $existingPost = cuc_get_news_post_by_id($postId);
                if (cuc_delete_news_post($postId)) {
                    if (is_array($existingPost)) {
                        cuc_remove_news_image((string)($existingPost['image_path'] ?? ''));
                    }

                    $formSuccess = 'News update deleted successfully.';
                    if ($editingPostId === $postId) {
                        $editingPostId = null;
                        $formState = $defaultFormState;
                    }
                } else {
                    $formError = 'Unable to delete post. Please try again.';
                }
            }
        }

        if ($action === 'delete_event') {
            $eventId = trim((string)($_POST['event_id'] ?? ''));
            if ($eventId === '') {
                $eventFormError = 'Unable to identify event for deletion.';
            } else {
                $existingEvent = cuc_get_event_by_id($eventId);
                if (cuc_delete_event($eventId)) {
                    if (is_array($existingEvent)) {
                        cuc_remove_public_image((string)($existingEvent['image_path'] ?? ''), cuc_event_public_image_prefix());
                    }

                    $eventFormSuccess = 'Event deleted successfully.';
                    if ($editingEventId === $eventId) {
                        $editingEventId = null;
                        $eventFormState = $defaultEventFormState;
                    }
                } else {
                    $eventFormError = 'Unable to delete event. Please try again.';
                }
            }
        }

        if ($action === 'delete_job') {
            $jobId = trim((string)($_POST['job_id'] ?? ''));
            if ($jobId === '') {
                $jobFormError = 'Unable to identify job for deletion.';
            } else {
                if (cuc_delete_job_vacancy($jobId)) {
                    $jobFormSuccess = 'Job vacancy deleted successfully.';
                    if ($editingJobId === $jobId) {
                        $editingJobId = null;
                        $jobFormState = $defaultJobFormState;
                    }
                } else {
                    $jobFormError = 'Unable to delete job vacancy. Please try again.';
                }
            }
        }

        if ($action === 'delete_honor') {
            $honorId = trim((string)($_POST['honor_id'] ?? ''));
            if ($honorId === '') {
                $honorFormError = 'Unable to identify honor record for deletion.';
            } else {
                $existingHonor = cuc_get_alumni_honor_by_id($honorId);
                if (cuc_delete_alumni_honor($honorId)) {
                    if (is_array($existingHonor)) {
                        cuc_remove_public_image((string)($existingHonor['image_path'] ?? ''), cuc_alumni_honor_public_image_prefix());
                    }

                    $honorFormSuccess = 'Honor record deleted successfully.';
                    if ($editingHonorId === $honorId) {
                        $editingHonorId = null;
                        $honorFormState = $defaultHonorFormState;
                    }
                } else {
                    $honorFormError = 'Unable to delete honor record. Please try again.';
                }
            }
        }

        if ($action === 'add_post' || $action === 'update_post') {
            $formState = [
                'month_label' => trim((string)($_POST['month_label'] ?? '')),
                'publish_date' => trim((string)($_POST['publish_date'] ?? '')),
                'title' => trim((string)($_POST['title'] ?? '')),
                'summary' => trim((string)($_POST['summary'] ?? '')),
                'url' => trim((string)($_POST['url'] ?? '')),
                'image_path' => (string)$formState['image_path'],
                'published' => !empty($_POST['published']),
            ];

            $title = (string)$formState['title'];
            $summary = (string)$formState['summary'];
            $url = (string)$formState['url'];

            if ($title === '' || $summary === '') {
                $formError = 'Title and update summary are required.';
            } elseif ($url !== '' && $url !== '#' && !filter_var($url, FILTER_VALIDATE_URL)) {
                $formError = 'If provided, Read More URL must be a valid full link (https://...).';
            } else {
                if ($action === 'add_post') {
                    $uploadError = '';
                    $uploadedImagePath = cuc_upload_news_image($_FILES['image'] ?? [], $uploadError);
                    if ($uploadError !== '') {
                        $formError = $uploadError;
                    } else {
                        $formState['image_path'] = (string)($uploadedImagePath ?? '');
                        $ok = cuc_add_news_post($formState);
                        if ($ok) {
                            $formSuccess = 'News update posted successfully.';
                            $formState = $defaultFormState;
                        } else {
                            if ($uploadedImagePath !== null) {
                                cuc_remove_news_image($uploadedImagePath);
                            }
                            $formError = 'Unable to save post. Please try again.';
                        }
                    }
                } else {
                    $postId = trim((string)($_POST['post_id'] ?? ''));
                    if ($postId === '') {
                        $formError = 'Missing post identifier for update.';
                    } else {
                        $existingPost = cuc_get_news_post_by_id($postId);
                        if (!is_array($existingPost)) {
                            $formError = 'Post not found for editing.';
                        } else {
                            $uploadError = '';
                            $uploadedImagePath = cuc_upload_news_image($_FILES['image'] ?? [], $uploadError);
                            if ($uploadError !== '') {
                                $formError = $uploadError;
                            } else {
                                $finalImagePath = (string)($existingPost['image_path'] ?? '');
                                $removeCurrentImage = !empty($_POST['remove_image']);

                                if ($removeCurrentImage) {
                                    cuc_remove_news_image($finalImagePath);
                                    $finalImagePath = '';
                                }

                                if ($uploadedImagePath !== null) {
                                    if ($finalImagePath !== '') {
                                        cuc_remove_news_image($finalImagePath);
                                    }
                                    $finalImagePath = $uploadedImagePath;
                                }

                                $formState['image_path'] = $finalImagePath;
                                $ok = cuc_update_news_post($postId, $formState);
                                if ($ok) {
                                    $formSuccess = 'News update edited successfully.';
                                    $editingPostId = null;
                                    $formState = $defaultFormState;
                                } else {
                                    if ($uploadedImagePath !== null) {
                                        cuc_remove_news_image($uploadedImagePath);
                                    }
                                    $formError = 'Unable to edit post. Please try again.';
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($action === 'add_event' || $action === 'update_event') {
            $eventFormState = [
                'title' => trim((string)($_POST['event_title'] ?? '')),
                'event_date' => trim((string)($_POST['event_date'] ?? '')),
                'event_time' => trim((string)($_POST['event_time'] ?? '')),
                'location' => trim((string)($_POST['event_location'] ?? '')),
                'summary' => trim((string)($_POST['event_summary'] ?? '')),
                'url' => trim((string)($_POST['event_url'] ?? '')),
                'image_path' => (string)$eventFormState['image_path'],
                'published' => !empty($_POST['event_published']),
            ];

            $eventTitle = (string)$eventFormState['title'];
            $eventLocation = (string)$eventFormState['location'];
            $eventSummary = (string)$eventFormState['summary'];
            $eventUrl = (string)$eventFormState['url'];

            if ($eventTitle === '' || $eventLocation === '' || $eventSummary === '') {
                $eventFormError = 'Event title, location, and summary are required.';
            } elseif ($eventUrl !== '' && $eventUrl !== '#' && !filter_var($eventUrl, FILTER_VALIDATE_URL)) {
                $eventFormError = 'If provided, Event URL must be a valid full link (https://...).';
            } else {
                if ($action === 'add_event') {
                    $uploadError = '';
                    $uploadedImagePath = cuc_upload_event_image($_FILES['event_image'] ?? [], $uploadError);
                    if ($uploadError !== '') {
                        $eventFormError = $uploadError;
                    } else {
                        $eventFormState['image_path'] = (string)($uploadedImagePath ?? '');
                        $ok = cuc_add_event([
                            'title' => $eventFormState['title'],
                            'event_date' => $eventFormState['event_date'],
                            'event_time' => $eventFormState['event_time'],
                            'location' => $eventFormState['location'],
                            'summary' => $eventFormState['summary'],
                            'url' => $eventFormState['url'],
                            'image_path' => $eventFormState['image_path'],
                            'published' => $eventFormState['published'],
                        ]);

                        if ($ok) {
                            $eventFormSuccess = 'Event posted successfully.';
                            $eventFormState = $defaultEventFormState;
                        } else {
                            if ($uploadedImagePath !== null) {
                                cuc_remove_public_image($uploadedImagePath, cuc_event_public_image_prefix());
                            }
                            $eventFormError = 'Unable to save event. Please try again.';
                        }
                    }
                } else {
                    $eventId = trim((string)($_POST['event_id'] ?? ''));
                    if ($eventId === '') {
                        $eventFormError = 'Missing event identifier for update.';
                    } else {
                        $existingEvent = cuc_get_event_by_id($eventId);
                        if (!is_array($existingEvent)) {
                            $eventFormError = 'Event not found for editing.';
                        } else {
                            $uploadError = '';
                            $uploadedImagePath = cuc_upload_event_image($_FILES['event_image'] ?? [], $uploadError);
                            if ($uploadError !== '') {
                                $eventFormError = $uploadError;
                            } else {
                                $finalImagePath = (string)($existingEvent['image_path'] ?? '');
                                $removeCurrentImage = !empty($_POST['event_remove_image']);

                                if ($removeCurrentImage) {
                                    cuc_remove_public_image($finalImagePath, cuc_event_public_image_prefix());
                                    $finalImagePath = '';
                                }

                                if ($uploadedImagePath !== null) {
                                    if ($finalImagePath !== '') {
                                        cuc_remove_public_image($finalImagePath, cuc_event_public_image_prefix());
                                    }
                                    $finalImagePath = $uploadedImagePath;
                                }

                                $eventFormState['image_path'] = $finalImagePath;
                                $ok = cuc_update_event($eventId, [
                                    'title' => $eventFormState['title'],
                                    'event_date' => $eventFormState['event_date'],
                                    'event_time' => $eventFormState['event_time'],
                                    'location' => $eventFormState['location'],
                                    'summary' => $eventFormState['summary'],
                                    'url' => $eventFormState['url'],
                                    'image_path' => $eventFormState['image_path'],
                                    'published' => $eventFormState['published'],
                                ]);

                                if ($ok) {
                                    $eventFormSuccess = 'Event updated successfully.';
                                    $editingEventId = null;
                                    $eventFormState = $defaultEventFormState;
                                } else {
                                    if ($uploadedImagePath !== null) {
                                        cuc_remove_public_image($uploadedImagePath, cuc_event_public_image_prefix());
                                    }
                                    $eventFormError = 'Unable to update event. Please try again.';
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($action === 'add_job' || $action === 'update_job') {
            $jobFormState = [
                'title' => trim((string)($_POST['job_title'] ?? '')),
                'department' => trim((string)($_POST['job_department'] ?? '')),
                'location' => trim((string)($_POST['job_location'] ?? '')),
                'employment_type' => trim((string)($_POST['job_employment_type'] ?? '')),
                'deadline' => trim((string)($_POST['job_deadline'] ?? '')),
                'summary' => trim((string)($_POST['job_summary'] ?? '')),
                'requirements' => trim((string)($_POST['job_requirements'] ?? '')),
                'application_email' => trim((string)($_POST['job_application_email'] ?? '')),
                'application_url' => trim((string)($_POST['job_application_url'] ?? '')),
                'published' => !empty($_POST['job_published']),
            ];

            $jobTitle = (string)$jobFormState['title'];
            $jobSummary = (string)$jobFormState['summary'];
            $jobDeadline = (string)$jobFormState['deadline'];

            if ($jobTitle === '' || $jobSummary === '' || $jobDeadline === '') {
                $jobFormError = 'Job title, summary, and deadline are required.';
            } elseif ($jobFormState['application_url'] !== '' && $jobFormState['application_url'] !== '#' && !filter_var((string)$jobFormState['application_url'], FILTER_VALIDATE_URL)) {
                $jobFormError = 'If provided, Application URL must be a valid full link (https://...).';
            } elseif ($jobFormState['application_email'] !== '' && !filter_var((string)$jobFormState['application_email'], FILTER_VALIDATE_EMAIL)) {
                $jobFormError = 'If provided, Application Email must be valid.';
            } else {
                if ($action === 'add_job') {
                    $ok = cuc_add_job_vacancy($jobFormState);
                    if ($ok) {
                        $jobFormSuccess = 'Job vacancy posted successfully.';
                        $jobFormState = $defaultJobFormState;
                    } else {
                        $jobFormError = 'Unable to save job vacancy. Please try again.';
                    }
                } else {
                    $jobId = trim((string)($_POST['job_id'] ?? ''));
                    if ($jobId === '') {
                        $jobFormError = 'Missing job identifier for update.';
                    } else {
                        $existingJob = cuc_get_job_vacancy_by_id($jobId);
                        if (!is_array($existingJob)) {
                            $jobFormError = 'Job vacancy not found for editing.';
                        } else {
                            $ok = cuc_update_job_vacancy($jobId, $jobFormState);
                            if ($ok) {
                                $jobFormSuccess = 'Job vacancy updated successfully.';
                                $editingJobId = null;
                                $jobFormState = $defaultJobFormState;
                            } else {
                                $jobFormError = 'Unable to update job vacancy. Please try again.';
                            }
                        }
                    }
                }
            }
        }

        if ($action === 'add_honor' || $action === 'update_honor') {
            $honorFormState = [
                'title' => trim((string)($_POST['honor_title'] ?? '')),
                'honor_level' => trim((string)($_POST['honor_level'] ?? '')),
                'gpa' => trim((string)($_POST['honor_gpa'] ?? '')),
                'image_path' => (string)$honorFormState['image_path'],
                'published' => !empty($_POST['honor_published']),
            ];

            if (
                (string)$honorFormState['title'] === '' ||
                (string)$honorFormState['honor_level'] === '' ||
                (string)$honorFormState['gpa'] === ''
            ) {
                $honorFormError = 'Title, honor level, and GPA are required.';
            } elseif (cuc_normalize_honor_gpa((string)$honorFormState['gpa']) === null) {
                $honorFormError = 'GPA must be between 0.00 and 4.00 (up to 2 decimal places).';
            } else {
                $honorFormState['gpa'] = (string)cuc_normalize_honor_gpa((string)$honorFormState['gpa']);
                if ($action === 'add_honor') {
                    $uploadError = '';
                    $uploadedImagePath = cuc_upload_alumni_honor_image($_FILES['honor_image'] ?? [], $uploadError);
                    if ($uploadError !== '') {
                        $honorFormError = $uploadError;
                    } else {
                        $honorFormState['image_path'] = (string)($uploadedImagePath ?? '');
                        $ok = cuc_add_alumni_honor($honorFormState);
                        if ($ok) {
                            $honorFormSuccess = 'Honor record posted successfully.';
                            $honorFormState = $defaultHonorFormState;
                        } else {
                            if ($uploadedImagePath !== null) {
                                cuc_remove_public_image($uploadedImagePath, cuc_alumni_honor_public_image_prefix());
                            }
                            $honorFormError = 'Unable to save honor record. Please try again.';
                        }
                    }
                } else {
                    $honorId = trim((string)($_POST['honor_id'] ?? ''));
                    if ($honorId === '') {
                        $honorFormError = 'Missing honor identifier for update.';
                    } else {
                        $existingHonor = cuc_get_alumni_honor_by_id($honorId);
                        if (!is_array($existingHonor)) {
                            $honorFormError = 'Honor record not found for editing.';
                        } else {
                            $uploadError = '';
                            $uploadedImagePath = cuc_upload_alumni_honor_image($_FILES['honor_image'] ?? [], $uploadError);
                            if ($uploadError !== '') {
                                $honorFormError = $uploadError;
                            } else {
                                $finalImagePath = (string)($existingHonor['image_path'] ?? '');
                                $removeCurrentImage = !empty($_POST['honor_remove_image']);

                                if ($removeCurrentImage) {
                                    cuc_remove_public_image($finalImagePath, cuc_alumni_honor_public_image_prefix());
                                    $finalImagePath = '';
                                }

                                if ($uploadedImagePath !== null) {
                                    if ($finalImagePath !== '') {
                                        cuc_remove_public_image($finalImagePath, cuc_alumni_honor_public_image_prefix());
                                    }
                                    $finalImagePath = $uploadedImagePath;
                                }

                                $honorFormState['image_path'] = $finalImagePath;
                                $ok = cuc_update_alumni_honor($honorId, $honorFormState);
                                if ($ok) {
                                    $honorFormSuccess = 'Honor record updated successfully.';
                                    $editingHonorId = null;
                                    $honorFormState = $defaultHonorFormState;
                                } else {
                                    if ($uploadedImagePath !== null) {
                                        cuc_remove_public_image($uploadedImagePath, cuc_alumni_honor_public_image_prefix());
                                    }
                                    $honorFormError = 'Unable to update honor record. Please try again.';
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    $allPosts = cuc_read_news_posts();
    $allEvents = cuc_read_events();
    $allJobs = cuc_read_job_vacancies();
    $allHonors = cuc_read_alumni_honors();
}

$isEditing = $editingPostId !== null;
$isEventEditing = $editingEventId !== null;
$isJobEditing = $editingJobId !== null;
$isHonorEditing = $editingHonorId !== null;

$pageTitle = 'News Admin';
$pageDescription = 'Admin panel for posting monthly school updates.';
$bodyClass = 'news-admin-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
    .news-admin-page .page-hero {
        padding: 40px 0 20px;
    }

    .news-admin-page .section {
        padding: 1.5rem 0;
    }

    .news-admin-page .split-layout {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .news-admin-page .callout {
        padding: 1rem;
    }

    .news-admin-page .btn-row {
        flex-direction: column;
        gap: 0.6rem;
    }

    .news-admin-page .btn-row .btn,
    .news-admin-page .btn-row form,
    .news-admin-page .contact-form button,
    .news-admin-page .cta-inner .btn {
        width: 100%;
    }

    .news-admin-page .btn-row form .btn {
        width: 100%;
    }

    .news-admin-page table {
        min-width: 680px !important;
    }

    .news-admin-page .news-upload-dropzone {
        padding: 1rem;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .news-admin-page .page-hero {
        padding: 34px 0 18px;
    }

    .news-admin-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .news-admin-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .news-admin-page p,
    .news-admin-page label,
    .news-admin-page input,
    .news-admin-page textarea,
    .news-admin-page button,
    .news-admin-page td,
    .news-admin-page th,
    .news-admin-page small {
        font-size: 0.92rem;
    }

    .news-admin-page .callout h2,
    .news-admin-page .cta-inner h2 {
        font-size: 1rem;
    }

    .news-admin-page table {
        min-width: 620px !important;
    }
}
</style>

<section
    class="page-hero"
    style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.9), rgba(140, 21, 21, 0.82)), url('assets/images/slider2.jpeg') center/cover no-repeat;">
    <div class="container">
        <span class="eyebrow">News Admin</span>
        <h1>Post Monthly School Updates</h1>
        <p>Publish the latest news so updates appear automatically on the News page.</p>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <?php if (!$isAuthenticated): ?>
            <article class="callout reveal-on-scroll" style="max-width: 620px; margin: 0 auto;">
                <h2>Admin Login</h2>
                <p>Sign in to post new monthly updates.</p>

                <?php if ($usingDefaultCredentials): ?>
                    <div class="form-alert form-alert-error">
                        Default credentials are active. Set <code>CUC_ADMIN_USER</code> and <code>CUC_ADMIN_PASS</code> in your server environment.
                    </div>
                <?php endif; ?>

                <?php if ($loginError !== ''): ?>
                    <div class="form-alert form-alert-error">
                        <?= htmlspecialchars($loginError, ENT_QUOTES, 'UTF-8') ?>
                    </div>
                <?php endif; ?>

                <form class="contact-form" method="post" action="">
                    <input type="hidden" name="action" value="login">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">

                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit" class="btn btn-primary">Sign In</button>
                </form>
            </article>
        <?php else: ?>
            <div class="split-layout">
                <article class="callout reveal-on-scroll">
                    <h2><?= $isEditing ? 'Edit News Update' : 'Create News Update' ?></h2>
                    <p><strong>Logged in as:</strong> <?= htmlspecialchars((string)($_SESSION['news_admin_user'] ?? 'Admin'), ENT_QUOTES, 'UTF-8') ?></p>

                    <?php if ($formError !== ''): ?>
                        <div class="form-alert form-alert-error" style="margin-top: 0.75rem;">
                            <?= htmlspecialchars($formError, ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($formSuccess !== ''): ?>
                        <div class="form-alert" style="margin-top: 0.75rem; background: rgba(20, 27, 45, 0.08); color: var(--color-ink); border: 1px solid rgba(20, 27, 45, 0.18);">
                            <?= htmlspecialchars($formSuccess, ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    <?php endif; ?>

                    <form class="contact-form" method="post" action="" enctype="multipart/form-data" style="margin-top: 1rem;">
                        <input type="hidden" name="action" value="<?= $isEditing ? 'update_post' : 'add_post' ?>">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                        <?php if ($isEditing): ?>
                            <input type="hidden" name="post_id" value="<?= htmlspecialchars((string)$editingPostId, ENT_QUOTES, 'UTF-8') ?>">
                        <?php endif; ?>

                        <label for="month_label">Month Label</label>
                        <input type="text" id="month_label" name="month_label" value="<?= htmlspecialchars((string)$formState['month_label'], ENT_QUOTES, 'UTF-8') ?>" placeholder="April 2026" required>

                        <label for="publish_date">Publish Date</label>
                        <input type="date" id="publish_date" name="publish_date" value="<?= htmlspecialchars((string)$formState['publish_date'], ENT_QUOTES, 'UTF-8') ?>" required>

                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" value="<?= htmlspecialchars((string)$formState['title'], ENT_QUOTES, 'UTF-8') ?>" required>

                        <label for="summary">Update Summary</label>
                        <textarea id="summary" name="summary" rows="5" required><?= htmlspecialchars((string)$formState['summary'], ENT_QUOTES, 'UTF-8') ?></textarea>

                        <label for="url">Read More URL (optional)</label>
                        <input type="url" id="url" name="url" value="<?= htmlspecialchars((string)$formState['url'], ENT_QUOTES, 'UTF-8') ?>" placeholder="https://example.com/news-detail">

                        <label for="image">News Image (optional)</label>
                        <div class="news-upload-dropzone" id="news-upload-dropzone" tabindex="0" role="button" aria-label="Upload news image by drag and drop">
                            <strong>Drag and drop an image here</strong>
                            <span>or click to choose a file</span>
                        </div>
                        <input class="news-image-input" type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp,image/gif">
                        <div class="news-image-feedback" id="news-image-feedback" aria-live="polite"></div>
                        <small style="display: block; margin-top: 0.4rem; color: var(--color-ink-soft);">Allowed: JPG, PNG, WEBP, GIF (max 3MB)</small>

                        <div class="news-image-preview-wrap" id="news-image-preview-wrap" style="display:none;">
                            <p style="margin: 0 0 0.45rem;"><strong>Selected Image Preview</strong></p>
                            <img class="news-image-preview" id="news-image-preview" alt="Selected news image preview">
                        </div>

                        <?php if ($isEditing && (string)$formState['image_path'] !== ''): ?>
                            <div style="margin-top: 0.8rem;">
                                <p style="margin: 0 0 0.5rem;"><strong>Current Image</strong></p>
                                <img
                                    src="<?= htmlspecialchars((string)$formState['image_path'], ENT_QUOTES, 'UTF-8') ?>"
                                    alt="Current news image"
                                    style="width: 100%; max-width: 280px; border-radius: 10px; border: 1px solid var(--color-border);">
                                <label style="display: flex; align-items: center; gap: 8px; margin-top: 0.65rem;">
                                    <input type="checkbox" name="remove_image" value="1">
                                    Remove current image
                                </label>
                            </div>
                        <?php endif; ?>

                        <label style="display: flex; align-items: center; gap: 8px; margin-top: 0.75rem;">
                            <input type="checkbox" name="published" value="1" <?= !empty($formState['published']) ? 'checked' : '' ?>>
                            Publish immediately
                        </label>

                        <div class="btn-row" style="margin-top: 1rem;">
                            <button type="submit" class="btn btn-primary"><?= $isEditing ? 'Save Changes' : 'Post Update' ?></button>
                            <?php if ($isEditing): ?>
                                <a href="news-admin.php" class="btn btn-light">Cancel Edit</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </article>

                <article class="callout reveal-on-scroll">
                    <h2>Admin Controls</h2>
                    <p><strong>Total stored posts:</strong> <?= (int)count($allPosts) ?></p>
                    <p>All updates are stored in <code>storage/news_posts.json</code>.</p>
                    <p><strong>Total stored events:</strong> <?= (int)count($allEvents) ?></p>
                    <div class="btn-row" style="margin-top: 0.75rem;">
                        <a href="news.php" class="btn btn-light">View Public News Page</a>
                        <form method="post" action="" style="display: inline;">
                            <input type="hidden" name="action" value="logout">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn btn-primary">Logout</button>
                        </form>
                    </div>
                </article>
            </div>

            <article class="callout reveal-on-scroll" style="margin-top: 1.5rem;">
                <h2>Recent News Posts</h2>
                <?php if (empty($allPosts)): ?>
                    <p>No posts available yet.</p>
                <?php else: ?>
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; min-width: 780px;">
                            <thead>
                                <tr style="text-align: left; background: var(--color-cream);">
                                    <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Date</th>
                                    <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Month</th>
                                    <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Title</th>
                                    <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Image</th>
                                    <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Status</th>
                                    <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_slice($allPosts, 0, 20) as $post): ?>
                                    <tr>
                                        <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                            <?= htmlspecialchars((string)$post['publish_date'], ENT_QUOTES, 'UTF-8') ?>
                                        </td>
                                        <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                            <?= htmlspecialchars((string)$post['month_label'], ENT_QUOTES, 'UTF-8') ?>
                                        </td>
                                        <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                            <?= htmlspecialchars((string)$post['title'], ENT_QUOTES, 'UTF-8') ?>
                                        </td>
                                        <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                            <?= (string)($post['image_path'] ?? '') !== '' ? 'Yes' : 'No' ?>
                                        </td>
                                        <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                            <?= !empty($post['published']) ? 'Published' : 'Draft' ?>
                                        </td>
                                        <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                            <div class="btn-row" style="gap: 8px;">
                                                <a href="news-admin.php?edit=<?= urlencode((string)$post['id']) ?>" class="btn btn-light" style="padding: 6px 10px;">Edit</a>
                                                <form method="post" action="" onsubmit="return confirm('Delete this news post?');" style="display: inline;">
                                                    <input type="hidden" name="action" value="delete_post">
                                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                                    <input type="hidden" name="post_id" value="<?= htmlspecialchars((string)$post['id'], ENT_QUOTES, 'UTF-8') ?>">
                                                    <button type="submit" class="btn btn-primary" style="padding: 6px 10px;">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </article>

            <div class="split-layout" style="margin-top: 1.5rem;">
                <article class="callout reveal-on-scroll">
                    <h2><?= $isEventEditing ? 'Edit Upcoming Event' : 'Create Upcoming Event' ?></h2>
                    <p>Post campus events so they appear automatically in the public Upcoming Events section.</p>

                    <?php if ($eventFormError !== ''): ?>
                        <div class="form-alert form-alert-error" style="margin-top: 0.75rem;">
                            <?= htmlspecialchars($eventFormError, ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($eventFormSuccess !== ''): ?>
                        <div class="form-alert" style="margin-top: 0.75rem; background: rgba(20, 27, 45, 0.08); color: var(--color-ink); border: 1px solid rgba(20, 27, 45, 0.18);">
                            <?= htmlspecialchars($eventFormSuccess, ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    <?php endif; ?>

                    <form class="contact-form" method="post" action="" enctype="multipart/form-data" style="margin-top: 1rem;">
                        <input type="hidden" name="action" value="<?= $isEventEditing ? 'update_event' : 'add_event' ?>">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                        <?php if ($isEventEditing): ?>
                            <input type="hidden" name="event_id" value="<?= htmlspecialchars((string)$editingEventId, ENT_QUOTES, 'UTF-8') ?>">
                        <?php endif; ?>

                        <label for="event_title">Event Title</label>
                        <input type="text" id="event_title" name="event_title" value="<?= htmlspecialchars((string)$eventFormState['title'], ENT_QUOTES, 'UTF-8') ?>" required>

                        <label for="event_date">Event Date</label>
                        <input type="date" id="event_date" name="event_date" value="<?= htmlspecialchars((string)$eventFormState['event_date'], ENT_QUOTES, 'UTF-8') ?>" required>

                        <label for="event_time">Event Time</label>
                        <input type="text" id="event_time" name="event_time" value="<?= htmlspecialchars((string)$eventFormState['event_time'], ENT_QUOTES, 'UTF-8') ?>" placeholder="10:00 AM">

                        <label for="event_location">Location</label>
                        <input type="text" id="event_location" name="event_location" value="<?= htmlspecialchars((string)$eventFormState['location'], ENT_QUOTES, 'UTF-8') ?>" required>

                        <label for="event_summary">Event Summary</label>
                        <textarea id="event_summary" name="event_summary" rows="5" required><?= htmlspecialchars((string)$eventFormState['summary'], ENT_QUOTES, 'UTF-8') ?></textarea>

                        <label for="event_url">Registration / Info URL (optional)</label>
                        <input type="url" id="event_url" name="event_url" value="<?= htmlspecialchars((string)$eventFormState['url'], ENT_QUOTES, 'UTF-8') ?>" placeholder="https://example.com/event-link">

                        <label for="event_image">Event Banner Image (optional)</label>
                        <input type="file" id="event_image" name="event_image" accept="image/jpeg,image/png,image/webp,image/gif">
                        <small style="display: block; margin-top: 0.4rem; color: var(--color-ink-soft);">Allowed: JPG, PNG, WEBP, GIF (max 3MB)</small>

                        <?php if ($isEventEditing && (string)$eventFormState['image_path'] !== ''): ?>
                            <div style="margin-top: 0.8rem;">
                                <p style="margin: 0 0 0.5rem;"><strong>Current Banner Image</strong></p>
                                <img
                                    src="<?= htmlspecialchars((string)$eventFormState['image_path'], ENT_QUOTES, 'UTF-8') ?>"
                                    alt="Current event banner image"
                                    style="width: 100%; max-width: 280px; border-radius: 10px; border: 1px solid var(--color-border);">
                                <label style="display: flex; align-items: center; gap: 8px; margin-top: 0.65rem;">
                                    <input type="checkbox" name="event_remove_image" value="1">
                                    Remove current image
                                </label>
                            </div>
                        <?php endif; ?>

                        <label style="display: flex; align-items: center; gap: 8px; margin-top: 0.75rem;">
                            <input type="checkbox" name="event_published" value="1" <?= !empty($eventFormState['published']) ? 'checked' : '' ?>>
                            Publish immediately
                        </label>

                        <div class="btn-row" style="margin-top: 1rem;">
                            <button type="submit" class="btn btn-primary"><?= $isEventEditing ? 'Save Event' : 'Post Event' ?></button>
                            <?php if ($isEventEditing): ?>
                                <a href="news-admin.php" class="btn btn-light">Cancel Edit</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </article>

                <article class="callout reveal-on-scroll">
                    <h2>Upcoming Events Manager</h2>
                    <p>These entries feed the Upcoming Events section on the public News page.</p>

                    <?php if (empty($allEvents)): ?>
                        <div class="form-alert form-alert-error">No events posted yet.</div>
                    <?php else: ?>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; min-width: 860px;">
                                <thead>
                                    <tr style="text-align: left; background: var(--color-cream);">
                                        <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Date</th>
                                        <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Title</th>
                                        <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Location</th>
                                        <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Status</th>
                                        <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (array_slice($allEvents, 0, 20) as $event): ?>
                                        <tr>
                                            <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                                <?= htmlspecialchars((string)$event['event_date'], ENT_QUOTES, 'UTF-8') ?>
                                            </td>
                                            <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                                <?= htmlspecialchars((string)$event['title'], ENT_QUOTES, 'UTF-8') ?>
                                            </td>
                                            <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                                <?= htmlspecialchars((string)$event['location'], ENT_QUOTES, 'UTF-8') ?>
                                            </td>
                                            <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                                <?= !empty($event['published']) ? 'Published' : 'Draft' ?>
                                            </td>
                                            <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                                <div class="btn-row" style="gap: 8px;">
                                                    <a href="news-admin.php?event_edit=<?= urlencode((string)$event['id']) ?>" class="btn btn-light" style="padding: 6px 10px;">Edit</a>
                                                    <form method="post" action="" onsubmit="return confirm('Delete this event?');" style="display: inline;">
                                                        <input type="hidden" name="action" value="delete_event">
                                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                                        <input type="hidden" name="event_id" value="<?= htmlspecialchars((string)$event['id'], ENT_QUOTES, 'UTF-8') ?>">
                                                        <button type="submit" class="btn btn-primary" style="padding: 6px 10px;">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </article>

                <article class="callout reveal-on-scroll">
                    <h2><?= $isJobEditing ? 'Edit Job Vacancy' : 'Post Job Vacancy' ?></h2>
                    <p>Publish active vacancies that appear on the public Job Vacancy page.</p>

                    <?php if ($jobFormError !== ''): ?>
                        <div class="form-alert form-alert-error" style="margin-top: 0.75rem;">
                            <?= htmlspecialchars($jobFormError, ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($jobFormSuccess !== ''): ?>
                        <div class="form-alert" style="margin-top: 0.75rem; background: rgba(20, 27, 45, 0.08); color: var(--color-ink); border: 1px solid rgba(20, 27, 45, 0.18);">
                            <?= htmlspecialchars($jobFormSuccess, ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    <?php endif; ?>

                    <form class="contact-form" method="post" action="" style="margin-top: 1rem;">
                        <input type="hidden" name="action" value="<?= $isJobEditing ? 'update_job' : 'add_job' ?>">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                        <?php if ($isJobEditing): ?>
                            <input type="hidden" name="job_id" value="<?= htmlspecialchars((string)$editingJobId, ENT_QUOTES, 'UTF-8') ?>">
                        <?php endif; ?>

                        <label for="job_title">Job Title</label>
                        <input type="text" id="job_title" name="job_title" value="<?= htmlspecialchars((string)$jobFormState['title'], ENT_QUOTES, 'UTF-8') ?>" required>

                        <label for="job_department">Department / Unit</label>
                        <input type="text" id="job_department" name="job_department" value="<?= htmlspecialchars((string)$jobFormState['department'], ENT_QUOTES, 'UTF-8') ?>" placeholder="Academic Affairs">

                        <label for="job_location">Location</label>
                        <input type="text" id="job_location" name="job_location" value="<?= htmlspecialchars((string)$jobFormState['location'], ENT_QUOTES, 'UTF-8') ?>" placeholder="Monrovia, Liberia">

                        <label for="job_employment_type">Employment Type</label>
                        <input type="text" id="job_employment_type" name="job_employment_type" value="<?= htmlspecialchars((string)$jobFormState['employment_type'], ENT_QUOTES, 'UTF-8') ?>" placeholder="Full-time">

                        <label for="job_deadline">Application Deadline</label>
                        <input type="date" id="job_deadline" name="job_deadline" value="<?= htmlspecialchars((string)$jobFormState['deadline'], ENT_QUOTES, 'UTF-8') ?>" required>

                        <label for="job_summary">Job Summary</label>
                        <textarea id="job_summary" name="job_summary" rows="5" required><?= htmlspecialchars((string)$jobFormState['summary'], ENT_QUOTES, 'UTF-8') ?></textarea>

                        <label for="job_requirements">Requirements / Responsibilities</label>
                        <textarea id="job_requirements" name="job_requirements" rows="5" placeholder="One item per line"><?= htmlspecialchars((string)$jobFormState['requirements'], ENT_QUOTES, 'UTF-8') ?></textarea>

                        <label for="job_application_email">Application Email</label>
                        <input type="email" id="job_application_email" name="job_application_email" value="<?= htmlspecialchars((string)$jobFormState['application_email'], ENT_QUOTES, 'UTF-8') ?>" placeholder="careers@cuc.edu.lr">

                        <label for="job_application_url">Application URL (optional)</label>
                        <input type="url" id="job_application_url" name="job_application_url" value="<?= htmlspecialchars((string)$jobFormState['application_url'], ENT_QUOTES, 'UTF-8') ?>" placeholder="https://example.com/apply">

                        <label style="display: flex; align-items: center; gap: 8px; margin-top: 0.75rem;">
                            <input type="checkbox" name="job_published" value="1" <?= !empty($jobFormState['published']) ? 'checked' : '' ?>>
                            Publish immediately
                        </label>

                        <div class="btn-row" style="margin-top: 1rem;">
                            <button type="submit" class="btn btn-primary"><?= $isJobEditing ? 'Save Job' : 'Post Job' ?></button>
                            <?php if ($isJobEditing): ?>
                                <a href="news-admin.php" class="btn btn-light">Cancel Edit</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </article>
            </div>

            <article class="callout reveal-on-scroll" style="margin-top: 1.5rem;">
                <h2>Job Vacancy Manager</h2>
                <p>These entries feed the public Job Vacancy page.</p>

                <?php if (empty($allJobs)): ?>
                    <div class="form-alert form-alert-error">No job vacancies posted yet.</div>
                <?php else: ?>
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; min-width: 960px;">
                            <thead>
                                <tr style="text-align: left; background: var(--color-cream);">
                                    <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Deadline</th>
                                    <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Title</th>
                                    <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Department</th>
                                    <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Status</th>
                                    <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_slice($allJobs, 0, 20) as $job): ?>
                                    <tr>
                                        <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                            <?= htmlspecialchars((string)$job['deadline'], ENT_QUOTES, 'UTF-8') ?>
                                        </td>
                                        <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                            <?= htmlspecialchars((string)$job['title'], ENT_QUOTES, 'UTF-8') ?>
                                        </td>
                                        <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                            <?= htmlspecialchars((string)$job['department'], ENT_QUOTES, 'UTF-8') ?>
                                        </td>
                                        <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                            <?= !empty($job['published']) ? 'Published' : 'Draft' ?>
                                        </td>
                                        <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                            <div class="btn-row" style="gap: 8px;">
                                                <a href="news-admin.php?job_edit=<?= urlencode((string)$job['id']) ?>" class="btn btn-light" style="padding: 6px 10px;">Edit</a>
                                                <form method="post" action="" onsubmit="return confirm('Delete this job vacancy?');" style="display: inline;">
                                                    <input type="hidden" name="action" value="delete_job">
                                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                                    <input type="hidden" name="job_id" value="<?= htmlspecialchars((string)$job['id'], ENT_QUOTES, 'UTF-8') ?>">
                                                    <button type="submit" class="btn btn-primary" style="padding: 6px 10px;">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </article>

            <div class="split-layout" style="margin-top: 1.5rem;">
                <article class="callout reveal-on-scroll">
                    <h2><?= $isHonorEditing ? 'Edit Honor Graduate' : 'Add Honor Graduate' ?></h2>
                    <p>These entries feed the Honor Graduates section on the Alumni page.</p>

                    <?php if ($honorFormError !== ''): ?>
                        <div class="form-alert form-alert-error" style="margin-top: 0.75rem;">
                            <?= htmlspecialchars($honorFormError, ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($honorFormSuccess !== ''): ?>
                        <div class="form-alert" style="margin-top: 0.75rem; background: rgba(20, 27, 45, 0.08); color: var(--color-ink); border: 1px solid rgba(20, 27, 45, 0.18);">
                            <?= htmlspecialchars($honorFormSuccess, ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    <?php endif; ?>

                    <form class="contact-form" method="post" action="" enctype="multipart/form-data" style="margin-top: 1rem;">
                        <input type="hidden" name="action" value="<?= $isHonorEditing ? 'update_honor' : 'add_honor' ?>">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                        <?php if ($isHonorEditing): ?>
                            <input type="hidden" name="honor_id" value="<?= htmlspecialchars((string)$editingHonorId, ENT_QUOTES, 'UTF-8') ?>">
                        <?php endif; ?>

                        <label for="honor_title">Graduate Title</label>
                        <input type="text" id="honor_title" name="honor_title" value="<?= htmlspecialchars((string)$honorFormState['title'], ENT_QUOTES, 'UTF-8') ?>" placeholder="Class of 2025 - Theology" required>

                        <label for="honor_level">Honor Level</label>
                        <input type="text" id="honor_level" name="honor_level" value="<?= htmlspecialchars((string)$honorFormState['honor_level'], ENT_QUOTES, 'UTF-8') ?>" placeholder="Summa Cum Laude" required>

                        <label for="honor_gpa">GPA</label>
                        <input type="text" id="honor_gpa" name="honor_gpa" value="<?= htmlspecialchars((string)$honorFormState['gpa'], ENT_QUOTES, 'UTF-8') ?>" placeholder="3.95" inputmode="decimal" pattern="^(?:[0-3](?:\.\d{1,2})?|4(?:\.0{1,2})?)$" title="Enter a GPA from 0.00 to 4.00 (up to 2 decimals)." required>

                        <label for="honor_image">Graduate Image (optional)</label>
                        <input type="file" id="honor_image" name="honor_image" accept="image/jpeg,image/png,image/webp,image/gif">
                        <small style="display: block; margin-top: 0.4rem; color: var(--color-ink-soft);">Allowed: JPG, PNG, WEBP, GIF (max 3MB)</small>

                        <?php if ($isHonorEditing && (string)$honorFormState['image_path'] !== ''): ?>
                            <div style="margin-top: 0.8rem;">
                                <p style="margin: 0 0 0.5rem;"><strong>Current Image</strong></p>
                                <img
                                    src="<?= htmlspecialchars((string)$honorFormState['image_path'], ENT_QUOTES, 'UTF-8') ?>"
                                    alt="Current honor graduate image"
                                    style="width: 100%; max-width: 280px; border-radius: 10px; border: 1px solid var(--color-border);">
                                <label style="display: flex; align-items: center; gap: 8px; margin-top: 0.65rem;">
                                    <input type="checkbox" name="honor_remove_image" value="1">
                                    Remove current image
                                </label>
                            </div>
                        <?php endif; ?>

                        <label style="display: flex; align-items: center; gap: 8px; margin-top: 0.75rem;">
                            <input type="checkbox" name="honor_published" value="1" <?= !empty($honorFormState['published']) ? 'checked' : '' ?>>
                            Publish immediately
                        </label>

                        <div class="btn-row" style="margin-top: 1rem;">
                            <button type="submit" class="btn btn-primary"><?= $isHonorEditing ? 'Save Honor' : 'Add Honor' ?></button>
                            <?php if ($isHonorEditing): ?>
                                <a href="news-admin.php" class="btn btn-light">Cancel Edit</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </article>

                <article class="callout reveal-on-scroll">
                    <h2>Honor Graduate Manager</h2>
                    <p>Published entries appear in the Alumni honor section.</p>

                    <?php if (empty($allHonors)): ?>
                        <div class="form-alert form-alert-error">No honor graduate entries yet.</div>
                    <?php else: ?>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; min-width: 920px;">
                                <thead>
                                    <tr style="text-align: left; background: var(--color-cream);">
                                        <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Title</th>
                                        <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Honor</th>
                                        <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">GPA</th>
                                        <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Image</th>
                                        <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Status</th>
                                        <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (array_slice($allHonors, 0, 30) as $honor): ?>
                                        <tr>
                                            <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                                <?= htmlspecialchars((string)$honor['title'], ENT_QUOTES, 'UTF-8') ?>
                                            </td>
                                            <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                                <?= htmlspecialchars((string)$honor['honor_level'], ENT_QUOTES, 'UTF-8') ?>
                                            </td>
                                            <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                                <?= htmlspecialchars((string)$honor['gpa'], ENT_QUOTES, 'UTF-8') ?>
                                            </td>
                                            <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                                <?= (string)($honor['image_path'] ?? '') !== '' ? 'Yes' : 'No' ?>
                                            </td>
                                            <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                                <?= !empty($honor['published']) ? 'Published' : 'Draft' ?>
                                            </td>
                                            <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border);">
                                                <div class="btn-row" style="gap: 8px;">
                                                    <a href="news-admin.php?honor_edit=<?= urlencode((string)$honor['id']) ?>" class="btn btn-light" style="padding: 6px 10px;">Edit</a>
                                                    <form method="post" action="" onsubmit="return confirm('Delete this honor record?');" style="display: inline;">
                                                        <input type="hidden" name="action" value="delete_honor">
                                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                                        <input type="hidden" name="honor_id" value="<?= htmlspecialchars((string)$honor['id'], ENT_QUOTES, 'UTF-8') ?>">
                                                        <button type="submit" class="btn btn-primary" style="padding: 6px 10px;">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </article>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="cta">
    <div class="container cta-inner">
        <h2>Keep News Fresh Every Month</h2>
        <p>Post important updates for students, parents, alumni, and staff from one central admin page.</p>
        <div class="btn-row">
            <a href="news.php" class="btn btn-primary">Go to News Page</a>
            <a href="contact.php" class="btn btn-light">Contact Office</a>
        </div>
    </div>
</section>

<script>
(function () {
    var input = document.getElementById('image');
    var dropzone = document.getElementById('news-upload-dropzone');
    var previewWrap = document.getElementById('news-image-preview-wrap');
    var previewImage = document.getElementById('news-image-preview');
    var feedback = document.getElementById('news-image-feedback');
    var maxBytes = 3 * 1024 * 1024;
    var allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

    if (!input || !dropzone || !previewWrap || !previewImage || !feedback) {
        return;
    }

    function setFeedback(message, isError) {
        feedback.textContent = message;
        feedback.classList.toggle('is-error', !!isError);
    }

    function clearSelection() {
        input.value = '';
        previewWrap.style.display = 'none';
        previewImage.removeAttribute('src');
    }

    function validateImage(file) {
        if (!file) {
            setFeedback('', false);
            return false;
        }

        if (allowedTypes.indexOf(file.type) === -1) {
            setFeedback('Invalid file type. Use JPG, PNG, WEBP, or GIF.', true);
            return false;
        }

        if (file.size > maxBytes) {
            setFeedback('Image is too large. Maximum size is 3MB.', true);
            return false;
        }

        setFeedback('Image looks good and is ready to upload.', false);
        return true;
    }

    function updatePreview(file) {
        if (!validateImage(file)) {
            clearSelection();
            return;
        }

        var reader = new FileReader();
        reader.onload = function (event) {
            previewImage.src = event.target.result;
            previewWrap.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }

    input.addEventListener('change', function () {
        var file = input.files && input.files[0] ? input.files[0] : null;
        if (!file) {
            clearSelection();
            setFeedback('', false);
            return;
        }

        updatePreview(file);
    });

    dropzone.addEventListener('click', function () {
        input.click();
    });

    dropzone.addEventListener('keydown', function (event) {
        if (event.key === 'Enter' || event.key === ' ') {
            event.preventDefault();
            input.click();
        }
    });

    ['dragenter', 'dragover'].forEach(function (name) {
        dropzone.addEventListener(name, function (event) {
            event.preventDefault();
            dropzone.classList.add('is-dragging');
        });
    });

    ['dragleave', 'drop'].forEach(function (name) {
        dropzone.addEventListener(name, function (event) {
            event.preventDefault();
            dropzone.classList.remove('is-dragging');
        });
    });

    dropzone.addEventListener('drop', function (event) {
        var files = event.dataTransfer ? event.dataTransfer.files : null;
        if (!files || files.length === 0) {
            return;
        }

        if (!validateImage(files[0])) {
            clearSelection();
            return;
        }

        var dt = new DataTransfer();
        dt.items.add(files[0]);
        input.files = dt.files;
        updatePreview(files[0]);
    });
})();
</script>

<?php include 'includes/footer.php'; ?>
