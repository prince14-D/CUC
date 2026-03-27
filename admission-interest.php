<?php
$pageTitle = 'Admission Interest Form';
$pageDescription = 'Register your interest in a CUC course or program.';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$formData = [
    'full_name' => '',
    'email' => '',
    'phone' => '',
    'program_level' => '',
    'program_interest' => '',
    'intake_term' => '',
    'qualification' => '',
    'message' => ''
];

$formStatus = '';
$formMessage = '';

$programLevels = [
    'certificate' => 'Certificate',
    'diploma' => 'Diploma',
    'associate' => 'Associate Degree',
    'bachelor' => 'Bachelor Degree',
    'postgraduate' => 'Postgraduate'
];

$programOptions = [
    'business-public-admin' => 'Business and Public Administration',
    'education' => 'Education',
    'health-sciences' => 'Health Sciences',
    'social-sciences-human-studies' => 'Social Sciences and Human Studies',
    'biblical-studies-theology' => 'Biblical Studies (Theology)',
    'sciences-technology' => 'Sciences and Technology'
];

$intakeOptions = [
    '2026-fall' => 'Fall 2026',
    '2027-spring' => 'Spring 2027',
    '2027-fall' => 'Fall 2027',
    'not-sure' => 'Not Sure Yet'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData['full_name'] = trim($_POST['full_name'] ?? '');
    $formData['email'] = trim($_POST['email'] ?? '');
    $formData['phone'] = trim($_POST['phone'] ?? '');
    $formData['program_level'] = trim($_POST['program_level'] ?? '');
    $formData['program_interest'] = trim($_POST['program_interest'] ?? '');
    $formData['intake_term'] = trim($_POST['intake_term'] ?? '');
    $formData['qualification'] = trim($_POST['qualification'] ?? '');
    $formData['message'] = trim($_POST['message'] ?? '');

    $csrfToken = $_POST['csrf_token'] ?? '';

    if (!hash_equals($_SESSION['csrf_token'], $csrfToken)) {
        $formStatus = 'error';
        $formMessage = 'Your session token is invalid. Please refresh the page and try again.';
    } elseif (
        $formData['full_name'] === '' ||
        $formData['email'] === '' ||
        $formData['program_level'] === '' ||
        $formData['program_interest'] === '' ||
        $formData['intake_term'] === '' ||
        !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)
    ) {
        $formStatus = 'error';
        $formMessage = 'Please complete all required fields with valid information.';
    } elseif (
        !isset($programLevels[$formData['program_level']]) ||
        !isset($programOptions[$formData['program_interest']]) ||
        !isset($intakeOptions[$formData['intake_term']])
    ) {
        $formStatus = 'error';
        $formMessage = 'Please select valid options for level, program, and intake term.';
    } else {
        $storageDir = __DIR__ . '/storage';
        $storageFile = $storageDir . '/admission_interest_submissions.csv';

        if (!is_dir($storageDir) && !mkdir($storageDir, 0755, true) && !is_dir($storageDir)) {
            $formStatus = 'error';
            $formMessage = 'We could not save your submission right now. Please try again later.';
        } else {
            $isNewFile = !file_exists($storageFile);
            $fp = fopen($storageFile, 'ab');

            if ($fp === false) {
                $formStatus = 'error';
                $formMessage = 'We could not save your submission right now. Please try again later.';
            } else {
                if ($isNewFile) {
                    fputcsv($fp, [
                        'submitted_at',
                        'full_name',
                        'email',
                        'phone',
                        'program_level',
                        'program_interest',
                        'intake_term',
                        'qualification',
                        'message'
                    ]);
                }

                fputcsv($fp, [
                    date('Y-m-d H:i:s'),
                    $formData['full_name'],
                    $formData['email'],
                    $formData['phone'],
                    $programLevels[$formData['program_level']],
                    $programOptions[$formData['program_interest']],
                    $intakeOptions[$formData['intake_term']],
                    $formData['qualification'],
                    $formData['message']
                ]);

                fclose($fp);

                $formStatus = 'success';
                $formMessage = 'Thank you. Your interest has been registered. Admissions will contact you soon.';
                $formData = [
                    'full_name' => '',
                    'email' => '',
                    'phone' => '',
                    'program_level' => '',
                    'program_interest' => '',
                    'intake_term' => '',
                    'qualification' => '',
                    'message' => ''
                ];
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }
        }
    }
}

include 'includes/header.php';
?>

<section
    class="page-hero"
    style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.9), rgba(140, 21, 21, 0.82)), url('assets/images/slider1.jpeg') center/cover no-repeat;">
    <div class="container">
        <span class="eyebrow">Admissions Form</span>
        <h1>Register Interest in a Course or Program</h1>
        <p>Tell us what you want to study and our admissions team will guide your next steps.</p>
    </div>
</section>

<section class="section section-tinted">
    <div class="container split-layout">
        <article class="reveal-on-scroll">
            <div class="section-heading left">
                <span class="eyebrow">Student Interest Form</span>
                <h2>Start Your Admission Journey</h2>
                <p>Complete the form below to receive tailored program and admission guidance.</p>
            </div>

            <?php if ($formStatus !== ''): ?>
                <div class="form-alert <?= $formStatus === 'success' ? 'form-alert-success' : 'form-alert-error' ?>">
                    <?= htmlspecialchars($formMessage, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>

            <form class="contact-form" method="post" action="">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">

                <label for="full-name">Full Name *</label>
                <input type="text" id="full-name" name="full_name" value="<?= htmlspecialchars($formData['full_name'], ENT_QUOTES, 'UTF-8') ?>" required>

                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($formData['email'], ENT_QUOTES, 'UTF-8') ?>" required>

                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($formData['phone'], ENT_QUOTES, 'UTF-8') ?>" placeholder="+231...">

                <label for="program-level">Program Level *</label>
                <select id="program-level" name="program_level" required>
                    <option value="">Select level</option>
                    <?php foreach ($programLevels as $value => $label): ?>
                        <option value="<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>" <?= $formData['program_level'] === $value ? 'selected' : '' ?>>
                            <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="program-interest">Program of Interest *</label>
                <select id="program-interest" name="program_interest" required>
                    <option value="">Select program</option>
                    <?php foreach ($programOptions as $value => $label): ?>
                        <option value="<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>" <?= $formData['program_interest'] === $value ? 'selected' : '' ?>>
                            <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="intake-term">Preferred Intake Term *</label>
                <select id="intake-term" name="intake_term" required>
                    <option value="">Select intake term</option>
                    <?php foreach ($intakeOptions as $value => $label): ?>
                        <option value="<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>" <?= $formData['intake_term'] === $value ? 'selected' : '' ?>>
                            <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="qualification">Highest Qualification</label>
                <input type="text" id="qualification" name="qualification" value="<?= htmlspecialchars($formData['qualification'], ENT_QUOTES, 'UTF-8') ?>" placeholder="WAEC, Diploma, Degree, etc.">

                <label for="message">Message (Optional)</label>
                <textarea id="message" name="message" rows="5" placeholder="Tell us more about your goals."><?= htmlspecialchars($formData['message'], ENT_QUOTES, 'UTF-8') ?></textarea>

                <button type="submit" class="btn btn-primary">Register Interest</button>
            </form>
        </article>

        <article class="callout reveal-on-scroll">
            <h2>What Happens Next?</h2>
            <ul class="clean-list">
                <li>Admissions reviews your interests and contact details.</li>
                <li>You receive guidance on suitable programs and entry requirements.</li>
                <li>Our team shares next-step details for application and document submission.</li>
            </ul>
            <p><strong>Email:</strong> admissions@cuc.edu.lr</p>
            <p><strong>Phone:</strong> +231 77 000 0000</p>
            <a href="admissions.php" class="btn btn-light">Back to Admissions</a>
        </article>
    </div>
</section>

<section class="cta">
    <div class="container cta-inner">
        <h2>Need Immediate Support?</h2>
        <p>Our admissions team is ready to help you choose the right pathway.</p>
        <div class="btn-row">
            <a href="contact.php" class="btn btn-primary">Talk to Admissions</a>
            <a href="academics.php" class="btn btn-light">Explore Programs</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
