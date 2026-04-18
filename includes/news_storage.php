<?php

declare(strict_types=1);

function cuc_news_storage_path(): string
{
    return __DIR__ . '/../storage/news_posts.json';
}

function cuc_event_storage_path(): string
{
    return __DIR__ . '/../storage/news_events.json';
}

function cuc_job_storage_path(): string
{
    return __DIR__ . '/../storage/job_vacancies.json';
}

function cuc_alumni_honor_storage_path(): string
{
    return __DIR__ . '/../storage/alumni_honors.json';
}

function cuc_news_public_image_prefix(): string
{
    return 'assets/images/news/';
}

function cuc_event_public_image_prefix(): string
{
    return 'assets/images/events/';
}

function cuc_alumni_honor_public_image_prefix(): string
{
    return 'assets/images/alumni-honors/';
}

function cuc_normalize_honor_gpa(string $value): ?string
{
    $value = trim($value);
    if ($value === '') {
        return null;
    }

    if (!preg_match('/^(?:[0-3](?:\.\d{1,2})?|4(?:\.0{1,2})?)$/', $value)) {
        return null;
    }

    $numeric = (float)$value;
    if ($numeric < 0 || $numeric > 4) {
        return null;
    }

    return number_format($numeric, 2, '.', '');
}

function cuc_ensure_event_storage_file(): void
{
    $path = cuc_event_storage_path();
    $dir = dirname($path);

    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    if (!file_exists($path)) {
        file_put_contents($path, "[]", LOCK_EX);
    }
}

function cuc_ensure_job_storage_file(): void
{
    $path = cuc_job_storage_path();
    $dir = dirname($path);

    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    if (!file_exists($path)) {
        file_put_contents($path, "[]", LOCK_EX);
    }
}

function cuc_ensure_alumni_honor_storage_file(): void
{
    $path = cuc_alumni_honor_storage_path();
    $dir = dirname($path);

    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    if (!file_exists($path)) {
        file_put_contents($path, "[]", LOCK_EX);
    }
}

function cuc_ensure_news_storage_file(): void
{
    $path = cuc_news_storage_path();
    $dir = dirname($path);

    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    if (!file_exists($path)) {
        file_put_contents($path, "[]", LOCK_EX);
    }
}

function cuc_read_news_posts(): array
{
    cuc_ensure_news_storage_file();

    $path = cuc_news_storage_path();
    $raw = file_get_contents($path);
    if ($raw === false || trim($raw) === '') {
        return [];
    }

    $decoded = json_decode($raw, true);
    if (!is_array($decoded)) {
        return [];
    }

    $posts = [];
    foreach ($decoded as $item) {
        if (!is_array($item)) {
            continue;
        }

        $title = trim((string)($item['title'] ?? ''));
        $summary = trim((string)($item['summary'] ?? ''));
        if ($title === '' || $summary === '') {
            continue;
        }

        $publishDate = trim((string)($item['publish_date'] ?? ''));
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $publishDate)) {
            $publishDate = date('Y-m-d');
        }

        $monthLabel = trim((string)($item['month_label'] ?? ''));
        if ($monthLabel === '') {
            $monthLabel = date('F Y', strtotime($publishDate));
        }

        $posts[] = [
            'id' => (string)($item['id'] ?? ''),
            'title' => $title,
            'summary' => $summary,
            'url' => trim((string)($item['url'] ?? '')),
            'image_path' => trim((string)($item['image_path'] ?? '')),
            'publish_date' => $publishDate,
            'month_label' => $monthLabel,
            'published' => !empty($item['published']),
            'created_at' => (string)($item['created_at'] ?? ''),
        ];
    }

    usort(
        $posts,
        static function (array $a, array $b): int {
            $byDate = strcmp((string)$b['publish_date'], (string)$a['publish_date']);
            if ($byDate !== 0) {
                return $byDate;
            }

            return strcmp((string)$b['created_at'], (string)$a['created_at']);
        }
    );

    return $posts;
}

function cuc_write_news_posts(array $posts): bool
{
    cuc_ensure_news_storage_file();

    $encoded = json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    if ($encoded === false) {
        return false;
    }

    return file_put_contents(cuc_news_storage_path(), $encoded, LOCK_EX) !== false;
}

function cuc_add_news_post(array $input): bool
{
    $title = trim((string)($input['title'] ?? ''));
    $summary = trim((string)($input['summary'] ?? ''));
    $url = trim((string)($input['url'] ?? ''));
    $publishDate = trim((string)($input['publish_date'] ?? ''));
    $monthLabel = trim((string)($input['month_label'] ?? ''));
    $imagePath = trim((string)($input['image_path'] ?? ''));
    $published = !empty($input['published']);

    if ($title === '' || $summary === '') {
        return false;
    }

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $publishDate)) {
        $publishDate = date('Y-m-d');
    }

    if ($monthLabel === '') {
        $monthLabel = date('F Y', strtotime($publishDate));
    }

    if ($url === '') {
        $url = '#';
    }

    $posts = cuc_read_news_posts();
    array_unshift(
        $posts,
        [
            'id' => bin2hex(random_bytes(8)),
            'title' => $title,
            'summary' => $summary,
            'url' => $url,
            'image_path' => $imagePath,
            'publish_date' => $publishDate,
            'month_label' => $monthLabel,
            'published' => $published,
            'created_at' => gmdate('c'),
        ]
    );

    return cuc_write_news_posts($posts);
}

function cuc_update_news_post(string $id, array $input): bool
{
    $id = trim($id);
    if ($id === '') {
        return false;
    }

    $title = trim((string)($input['title'] ?? ''));
    $summary = trim((string)($input['summary'] ?? ''));
    $url = trim((string)($input['url'] ?? ''));
    $publishDate = trim((string)($input['publish_date'] ?? ''));
    $monthLabel = trim((string)($input['month_label'] ?? ''));
    $imagePath = trim((string)($input['image_path'] ?? ''));
    $published = !empty($input['published']);

    if ($title === '' || $summary === '') {
        return false;
    }

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $publishDate)) {
        $publishDate = date('Y-m-d');
    }

    if ($monthLabel === '') {
        $monthLabel = date('F Y', strtotime($publishDate));
    }

    if ($url === '') {
        $url = '#';
    }

    $posts = cuc_read_news_posts();
    $updated = false;

    foreach ($posts as &$post) {
        if ((string)($post['id'] ?? '') !== $id) {
            continue;
        }

        $post['title'] = $title;
        $post['summary'] = $summary;
        $post['url'] = $url;
        $post['image_path'] = $imagePath;
        $post['publish_date'] = $publishDate;
        $post['month_label'] = $monthLabel;
        $post['published'] = $published;
        $updated = true;
        break;
    }
    unset($post);

    if (!$updated) {
        return false;
    }

    return cuc_write_news_posts($posts);
}

function cuc_delete_news_post(string $id): bool
{
    $id = trim($id);
    if ($id === '') {
        return false;
    }

    $posts = cuc_read_news_posts();
    $before = count($posts);

    $posts = array_values(
        array_filter(
            $posts,
            static fn(array $post): bool => (string)($post['id'] ?? '') !== $id
        )
    );

    if (count($posts) === $before) {
        return false;
    }

    return cuc_write_news_posts($posts);
}

function cuc_get_published_news(): array
{
    $posts = cuc_read_news_posts();

    return array_values(
        array_filter(
            $posts,
            static fn(array $post): bool => !empty($post['published'])
        )
    );
}

function cuc_latest_news_month_label(array $publishedPosts): ?string
{
    if (empty($publishedPosts)) {
        return null;
    }

    return (string)$publishedPosts[0]['month_label'];
}

function cuc_get_news_post_by_id(string $id): ?array
{
    $id = trim($id);
    if ($id === '') {
        return null;
    }

    $posts = cuc_read_news_posts();
    foreach ($posts as $post) {
        if ((string)($post['id'] ?? '') === $id) {
            return $post;
        }
    }

    return null;
}

function cuc_remove_news_image(string $imagePath): void
{
    cuc_remove_public_image($imagePath, cuc_news_public_image_prefix());
}

function cuc_remove_public_image(string $imagePath, string $prefix): void
{
    $imagePath = trim($imagePath);
    $prefix = trim($prefix);
    if ($imagePath === '' || $prefix === '' || strpos($imagePath, $prefix) !== 0) {
        return;
    }

    $absolutePath = __DIR__ . '/../' . $imagePath;
    if (is_file($absolutePath)) {
        @unlink($absolutePath);
    }
}

function cuc_read_events(): array
{
    cuc_ensure_event_storage_file();

    $path = cuc_event_storage_path();
    $raw = file_get_contents($path);
    if ($raw === false || trim($raw) === '') {
        return [];
    }

    $decoded = json_decode($raw, true);
    if (!is_array($decoded)) {
        return [];
    }

    $events = [];
    foreach ($decoded as $item) {
        if (!is_array($item)) {
            continue;
        }

        $title = trim((string)($item['title'] ?? ''));
        $summary = trim((string)($item['summary'] ?? ''));
        $eventDate = trim((string)($item['event_date'] ?? ''));
        if ($title === '' || $summary === '' || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $eventDate)) {
            continue;
        }

        $events[] = [
            'id' => (string)($item['id'] ?? ''),
            'title' => $title,
            'summary' => $summary,
            'location' => trim((string)($item['location'] ?? '')),
            'event_date' => $eventDate,
            'event_time' => trim((string)($item['event_time'] ?? '')),
            'url' => trim((string)($item['url'] ?? '')),
            'image_path' => trim((string)($item['image_path'] ?? '')),
            'published' => !empty($item['published']),
            'created_at' => (string)($item['created_at'] ?? ''),
        ];
    }

    usort(
        $events,
        static function (array $a, array $b): int {
            $byDate = strcmp((string)$a['event_date'], (string)$b['event_date']);
            if ($byDate !== 0) {
                return $byDate;
            }

            return strcmp((string)$a['created_at'], (string)$b['created_at']);
        }
    );

    return $events;
}

function cuc_write_events(array $events): bool
{
    cuc_ensure_event_storage_file();

    $encoded = json_encode($events, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    if ($encoded === false) {
        return false;
    }

    return file_put_contents(cuc_event_storage_path(), $encoded, LOCK_EX) !== false;
}

function cuc_add_event(array $input): bool
{
    $title = trim((string)($input['title'] ?? ''));
    $summary = trim((string)($input['summary'] ?? ''));
    $location = trim((string)($input['location'] ?? ''));
    $eventDate = trim((string)($input['event_date'] ?? ''));
    $eventTime = trim((string)($input['event_time'] ?? ''));
    $url = trim((string)($input['url'] ?? ''));
    $imagePath = trim((string)($input['image_path'] ?? ''));
    $published = !empty($input['published']);

    if ($title === '' || $summary === '' || $location === '') {
        return false;
    }

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $eventDate)) {
        $eventDate = date('Y-m-d');
    }

    if ($url === '') {
        $url = '#';
    }

    $events = cuc_read_events();
    array_unshift(
        $events,
        [
            'id' => bin2hex(random_bytes(8)),
            'title' => $title,
            'summary' => $summary,
            'location' => $location,
            'event_date' => $eventDate,
            'event_time' => $eventTime,
            'url' => $url,
            'image_path' => $imagePath,
            'published' => $published,
            'created_at' => gmdate('c'),
        ]
    );

    return cuc_write_events($events);
}

function cuc_update_event(string $id, array $input): bool
{
    $id = trim($id);
    if ($id === '') {
        return false;
    }

    $title = trim((string)($input['title'] ?? ''));
    $summary = trim((string)($input['summary'] ?? ''));
    $location = trim((string)($input['location'] ?? ''));
    $eventDate = trim((string)($input['event_date'] ?? ''));
    $eventTime = trim((string)($input['event_time'] ?? ''));
    $url = trim((string)($input['url'] ?? ''));
    $imagePath = trim((string)($input['image_path'] ?? ''));
    $published = !empty($input['published']);

    if ($title === '' || $summary === '' || $location === '') {
        return false;
    }

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $eventDate)) {
        $eventDate = date('Y-m-d');
    }

    if ($url === '') {
        $url = '#';
    }

    $events = cuc_read_events();
    $updated = false;

    foreach ($events as &$event) {
        if ((string)($event['id'] ?? '') !== $id) {
            continue;
        }

        $event['title'] = $title;
        $event['summary'] = $summary;
        $event['location'] = $location;
        $event['event_date'] = $eventDate;
        $event['event_time'] = $eventTime;
        $event['url'] = $url;
        $event['image_path'] = $imagePath;
        $event['published'] = $published;
        $updated = true;
        break;
    }
    unset($event);

    if (!$updated) {
        return false;
    }

    return cuc_write_events($events);
}

function cuc_delete_event(string $id): bool
{
    $id = trim($id);
    if ($id === '') {
        return false;
    }

    $events = cuc_read_events();
    $before = count($events);

    $events = array_values(
        array_filter(
            $events,
            static fn(array $event): bool => (string)($event['id'] ?? '') !== $id
        )
    );

    if (count($events) === $before) {
        return false;
    }

    return cuc_write_events($events);
}

function cuc_get_published_events(): array
{
    $events = cuc_read_events();

    return array_values(
        array_filter(
            $events,
            static fn(array $event): bool => !empty($event['published'])
        )
    );
}

function cuc_get_upcoming_events(): array
{
    $today = date('Y-m-d');
    $events = cuc_get_published_events();

    $upcoming = array_values(
        array_filter(
            $events,
            static fn(array $event): bool => (string)($event['event_date'] ?? '') >= $today
        )
    );

    usort(
        $upcoming,
        static function (array $a, array $b): int {
            $byDate = strcmp((string)$a['event_date'], (string)$b['event_date']);
            if ($byDate !== 0) {
                return $byDate;
            }

            return strcmp((string)$a['created_at'], (string)$b['created_at']);
        }
    );

    return $upcoming;
}

function cuc_get_event_by_id(string $id): ?array
{
    $id = trim($id);
    if ($id === '') {
        return null;
    }

    $events = cuc_read_events();
    foreach ($events as $event) {
        if ((string)($event['id'] ?? '') === $id) {
            return $event;
        }
    }

    return null;
}

function cuc_read_job_vacancies(): array
{
    cuc_ensure_job_storage_file();

    $path = cuc_job_storage_path();
    $raw = file_get_contents($path);
    if ($raw === false || trim($raw) === '') {
        return [];
    }

    $decoded = json_decode($raw, true);
    if (!is_array($decoded)) {
        return [];
    }

    $jobs = [];
    foreach ($decoded as $item) {
        if (!is_array($item)) {
            continue;
        }

        $title = trim((string)($item['title'] ?? ''));
        $summary = trim((string)($item['summary'] ?? ''));
        $deadline = trim((string)($item['deadline'] ?? ''));
        if ($title === '' || $summary === '' || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $deadline)) {
            continue;
        }

        $jobs[] = [
            'id' => (string)($item['id'] ?? ''),
            'title' => $title,
            'summary' => $summary,
            'department' => trim((string)($item['department'] ?? '')),
            'location' => trim((string)($item['location'] ?? '')),
            'employment_type' => trim((string)($item['employment_type'] ?? '')),
            'deadline' => $deadline,
            'requirements' => trim((string)($item['requirements'] ?? '')),
            'application_email' => trim((string)($item['application_email'] ?? '')),
            'application_url' => trim((string)($item['application_url'] ?? '')),
            'published' => !empty($item['published']),
            'created_at' => (string)($item['created_at'] ?? ''),
        ];
    }

    usort(
        $jobs,
        static function (array $a, array $b): int {
            $byDeadline = strcmp((string)$a['deadline'], (string)$b['deadline']);
            if ($byDeadline !== 0) {
                return $byDeadline;
            }

            return strcmp((string)$b['created_at'], (string)$a['created_at']);
        }
    );

    return $jobs;
}

function cuc_write_job_vacancies(array $jobs): bool
{
    cuc_ensure_job_storage_file();

    $encoded = json_encode($jobs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    if ($encoded === false) {
        return false;
    }

    return file_put_contents(cuc_job_storage_path(), $encoded, LOCK_EX) !== false;
}

function cuc_add_job_vacancy(array $input): bool
{
    $title = trim((string)($input['title'] ?? ''));
    $summary = trim((string)($input['summary'] ?? ''));
    $deadline = trim((string)($input['deadline'] ?? ''));
    $department = trim((string)($input['department'] ?? ''));
    $location = trim((string)($input['location'] ?? ''));
    $employmentType = trim((string)($input['employment_type'] ?? ''));
    $requirements = trim((string)($input['requirements'] ?? ''));
    $applicationEmail = trim((string)($input['application_email'] ?? ''));
    $applicationUrl = trim((string)($input['application_url'] ?? ''));
    $published = !empty($input['published']);

    if ($title === '' || $summary === '' || $deadline === '') {
        return false;
    }

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $deadline)) {
        $deadline = date('Y-m-d');
    }

    if ($applicationUrl === '') {
        $applicationUrl = '#';
    }

    $jobs = cuc_read_job_vacancies();
    array_unshift(
        $jobs,
        [
            'id' => bin2hex(random_bytes(8)),
            'title' => $title,
            'summary' => $summary,
            'department' => $department,
            'location' => $location,
            'employment_type' => $employmentType,
            'deadline' => $deadline,
            'requirements' => $requirements,
            'application_email' => $applicationEmail,
            'application_url' => $applicationUrl,
            'published' => $published,
            'created_at' => gmdate('c'),
        ]
    );

    return cuc_write_job_vacancies($jobs);
}

function cuc_update_job_vacancy(string $id, array $input): bool
{
    $id = trim($id);
    if ($id === '') {
        return false;
    }

    $title = trim((string)($input['title'] ?? ''));
    $summary = trim((string)($input['summary'] ?? ''));
    $deadline = trim((string)($input['deadline'] ?? ''));
    $department = trim((string)($input['department'] ?? ''));
    $location = trim((string)($input['location'] ?? ''));
    $employmentType = trim((string)($input['employment_type'] ?? ''));
    $requirements = trim((string)($input['requirements'] ?? ''));
    $applicationEmail = trim((string)($input['application_email'] ?? ''));
    $applicationUrl = trim((string)($input['application_url'] ?? ''));
    $published = !empty($input['published']);

    if ($title === '' || $summary === '' || $deadline === '') {
        return false;
    }

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $deadline)) {
        $deadline = date('Y-m-d');
    }

    if ($applicationUrl === '') {
        $applicationUrl = '#';
    }

    $jobs = cuc_read_job_vacancies();
    $updated = false;

    foreach ($jobs as &$job) {
        if ((string)($job['id'] ?? '') !== $id) {
            continue;
        }

        $job['title'] = $title;
        $job['summary'] = $summary;
        $job['department'] = $department;
        $job['location'] = $location;
        $job['employment_type'] = $employmentType;
        $job['deadline'] = $deadline;
        $job['requirements'] = $requirements;
        $job['application_email'] = $applicationEmail;
        $job['application_url'] = $applicationUrl;
        $job['published'] = $published;
        $updated = true;
        break;
    }
    unset($job);

    if (!$updated) {
        return false;
    }

    return cuc_write_job_vacancies($jobs);
}

function cuc_delete_job_vacancy(string $id): bool
{
    $id = trim($id);
    if ($id === '') {
        return false;
    }

    $jobs = cuc_read_job_vacancies();
    $before = count($jobs);

    $jobs = array_values(
        array_filter(
            $jobs,
            static fn(array $job): bool => (string)($job['id'] ?? '') !== $id
        )
    );

    if (count($jobs) === $before) {
        return false;
    }

    return cuc_write_job_vacancies($jobs);
}

function cuc_get_job_vacancy_by_id(string $id): ?array
{
    $id = trim($id);
    if ($id === '') {
        return null;
    }

    $jobs = cuc_read_job_vacancies();
    foreach ($jobs as $job) {
        if ((string)($job['id'] ?? '') === $id) {
            return $job;
        }
    }

    return null;
}

function cuc_get_active_job_vacancies(): array
{
    $today = date('Y-m-d');
    $jobs = cuc_read_job_vacancies();

    $active = array_values(
        array_filter(
            $jobs,
            static fn(array $job): bool => !empty($job['published']) && (string)($job['deadline'] ?? '') >= $today
        )
    );

    usort(
        $active,
        static function (array $a, array $b): int {
            $byDeadline = strcmp((string)$a['deadline'], (string)$b['deadline']);
            if ($byDeadline !== 0) {
                return $byDeadline;
            }

            return strcmp((string)$b['created_at'], (string)$a['created_at']);
        }
    );

    return $active;
}

function cuc_read_alumni_honors(): array
{
    cuc_ensure_alumni_honor_storage_file();

    $path = cuc_alumni_honor_storage_path();
    $raw = file_get_contents($path);
    if ($raw === false || trim($raw) === '') {
        return [];
    }

    $decoded = json_decode($raw, true);
    if (!is_array($decoded)) {
        return [];
    }

    $honors = [];
    foreach ($decoded as $item) {
        if (!is_array($item)) {
            continue;
        }

        $title = trim((string)($item['title'] ?? ''));
        $honorLevel = trim((string)($item['honor_level'] ?? ''));
        $gpa = trim((string)($item['gpa'] ?? ''));
        if ($title === '' || $honorLevel === '' || $gpa === '') {
            continue;
        }

        $honors[] = [
            'id' => (string)($item['id'] ?? ''),
            'title' => $title,
            'honor_level' => $honorLevel,
            'gpa' => $gpa,
            'image_path' => trim((string)($item['image_path'] ?? '')),
            'published' => !empty($item['published']),
            'created_at' => (string)($item['created_at'] ?? ''),
        ];
    }

    usort(
        $honors,
        static function (array $a, array $b): int {
            return strcmp((string)$b['created_at'], (string)$a['created_at']);
        }
    );

    return $honors;
}

function cuc_write_alumni_honors(array $honors): bool
{
    cuc_ensure_alumni_honor_storage_file();

    $encoded = json_encode($honors, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    if ($encoded === false) {
        return false;
    }

    return file_put_contents(cuc_alumni_honor_storage_path(), $encoded, LOCK_EX) !== false;
}

function cuc_add_alumni_honor(array $input): bool
{
    $title = trim((string)($input['title'] ?? ''));
    $honorLevel = trim((string)($input['honor_level'] ?? ''));
    $gpa = trim((string)($input['gpa'] ?? ''));
    $normalizedGpa = cuc_normalize_honor_gpa($gpa);
    $imagePath = trim((string)($input['image_path'] ?? ''));
    $published = !empty($input['published']);

    if ($title === '' || $honorLevel === '' || $normalizedGpa === null) {
        return false;
    }

    $honors = cuc_read_alumni_honors();
    array_unshift(
        $honors,
        [
            'id' => bin2hex(random_bytes(8)),
            'title' => $title,
            'honor_level' => $honorLevel,
            'gpa' => $normalizedGpa,
            'image_path' => $imagePath,
            'published' => $published,
            'created_at' => gmdate('c'),
        ]
    );

    return cuc_write_alumni_honors($honors);
}

function cuc_update_alumni_honor(string $id, array $input): bool
{
    $id = trim($id);
    if ($id === '') {
        return false;
    }

    $title = trim((string)($input['title'] ?? ''));
    $honorLevel = trim((string)($input['honor_level'] ?? ''));
    $gpa = trim((string)($input['gpa'] ?? ''));
    $normalizedGpa = cuc_normalize_honor_gpa($gpa);
    $imagePath = trim((string)($input['image_path'] ?? ''));
    $published = !empty($input['published']);

    if ($title === '' || $honorLevel === '' || $normalizedGpa === null) {
        return false;
    }

    $honors = cuc_read_alumni_honors();
    $updated = false;

    foreach ($honors as &$honor) {
        if ((string)($honor['id'] ?? '') !== $id) {
            continue;
        }

        $honor['title'] = $title;
        $honor['honor_level'] = $honorLevel;
        $honor['gpa'] = $normalizedGpa;
        $honor['image_path'] = $imagePath;
        $honor['published'] = $published;
        $updated = true;
        break;
    }
    unset($honor);

    if (!$updated) {
        return false;
    }

    return cuc_write_alumni_honors($honors);
}

function cuc_delete_alumni_honor(string $id): bool
{
    $id = trim($id);
    if ($id === '') {
        return false;
    }

    $honors = cuc_read_alumni_honors();
    $before = count($honors);

    $honors = array_values(
        array_filter(
            $honors,
            static fn(array $honor): bool => (string)($honor['id'] ?? '') !== $id
        )
    );

    if (count($honors) === $before) {
        return false;
    }

    return cuc_write_alumni_honors($honors);
}

function cuc_get_alumni_honor_by_id(string $id): ?array
{
    $id = trim($id);
    if ($id === '') {
        return null;
    }

    $honors = cuc_read_alumni_honors();
    foreach ($honors as $honor) {
        if ((string)($honor['id'] ?? '') === $id) {
            return $honor;
        }
    }

    return null;
}

function cuc_get_published_alumni_honors(): array
{
    $honors = cuc_read_alumni_honors();

    return array_values(
        array_filter(
            $honors,
            static fn(array $honor): bool => !empty($honor['published'])
        )
    );
}
