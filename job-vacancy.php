<?php
require_once __DIR__ . '/includes/news_storage.php';

$pageTitle = 'Job Vacancy';
$pageDescription = 'Current job vacancies and career opportunities at Christian University College.';
$bodyClass = 'job-vacancy-page';

$activeJobs = cuc_get_active_job_vacancies();
$departmentCount = count(
    array_unique(
        array_filter(
            array_map(
                static fn(array $job): string => trim((string)($job['department'] ?? '')),
                $activeJobs
            )
        )
    )
);
$onlineApplicationCount = count(
    array_filter(
        $activeJobs,
        static fn(array $job): bool => trim((string)($job['application_url'] ?? '')) !== '' && trim((string)($job['application_url'] ?? '')) !== '#'
    )
);
$emailApplicationCount = count(
    array_filter(
        $activeJobs,
        static fn(array $job): bool => trim((string)($job['application_email'] ?? '')) !== ''
    )
);

include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
    .job-vacancy-page .page-hero {
        padding: 40px 0 20px;
    }

    .job-vacancy-page .section {
        padding: 1.5rem 0;
    }

    .job-vacancy-page .section-heading {
        margin-bottom: 1rem;
        text-align: left;
    }

    .job-vacancy-page .section-heading h2 {
        font-size: clamp(1.3rem, 4vw, 1.6rem);
        margin-bottom: 8px;
    }

    .job-vacancy-page .section-heading p {
        font-size: 0.9rem;
    }

    .job-vacancy-page .about-stats-grid,
    .job-vacancy-page .news-grid,
    .job-vacancy-page .split-layout {
        grid-template-columns: 1fr;
    }

    .job-vacancy-page .about-stat-card,
    .job-vacancy-page .news-card,
    .job-vacancy-page .callout {
        padding: 1rem;
    }

    .job-vacancy-page .btn-row {
        flex-direction: column;
        gap: 0.6rem;
    }

    .job-vacancy-page .btn-row .btn,
    .job-vacancy-page .cta-inner .btn,
    .job-vacancy-page .news-card .btn,
    .job-vacancy-page .callout .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .job-vacancy-page .page-hero {
        padding: 34px 0 18px;
    }

    .job-vacancy-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .job-vacancy-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .job-vacancy-page p,
    .job-vacancy-page li {
        font-size: 0.92rem;
    }

    .job-vacancy-page .about-stat-card strong {
        font-size: clamp(1.3rem, 7vw, 1.8rem);
    }

    .job-vacancy-page .news-card h3,
    .job-vacancy-page .callout h2,
    .job-vacancy-page .cta-inner h2 {
        font-size: 1rem;
    }
}
</style>

<section
    class="page-hero"
    style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.9), rgba(140, 21, 21, 0.82)), url('assets/images/slider2.jpeg') center/cover no-repeat;">
    <div class="container">
        <span class="eyebrow">Careers</span>
        <h1>Job Vacancy Announcements</h1>
        <p>Explore active openings at Christian University College and apply to join a mission-driven academic community.</p>
    </div>
</section>

<section class="section about-highlight-band">
    <div class="container about-stats-grid">
        <article class="about-stat-card">
            <strong><?= (int)count($activeJobs) ?></strong>
            <span>Open Positions</span>
        </article>
        <article class="about-stat-card">
            <strong><?= (int)$departmentCount ?></strong>
            <span>Departments</span>
        </article>
        <article class="about-stat-card">
            <strong><?= (int)$onlineApplicationCount ?></strong>
            <span>Online Applications</span>
        </article>
        <article class="about-stat-card">
            <strong><?= (int)$emailApplicationCount ?></strong>
            <span>Email Listings</span>
        </article>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Current Openings</span>
            <h2>Available Roles at CUC</h2>
            <p>Review role details, requirements, and application deadlines below.</p>
        </div>

        <?php if (empty($activeJobs)): ?>
            <article class="callout reveal-on-scroll" style="max-width: 860px; margin: 0 auto;">
                <h2>No active vacancies right now</h2>
                <p>Admin can publish new openings from the News Admin page, and they will appear here automatically.</p>
                <div class="btn-row">
                    <a href="news-admin.php" class="btn btn-primary">Open Admin</a>
                    <a href="contact.php" class="btn btn-light">Contact Office</a>
                </div>
            </article>
        <?php else: ?>
            <div class="news-grid">
                <?php foreach ($activeJobs as $job): ?>
                    <?php
                    $requirements = array_values(
                        array_filter(
                            preg_split('/\r\n|\r|\n/', (string)($job['requirements'] ?? '')) ?: [],
                            static fn(string $item): bool => trim($item) !== ''
                        )
                    );
                    $applicationUrl = trim((string)($job['application_url'] ?? ''));
                    $applicationEmail = trim((string)($job['application_email'] ?? ''));
                    if ($applicationUrl !== '' && $applicationUrl !== '#') {
                        $applyHref = $applicationUrl;
                        $applyLabel = 'Apply Online';
                    } elseif ($applicationEmail !== '') {
                        $applyHref = 'mailto:' . $applicationEmail;
                        $applyLabel = 'Apply by Email';
                    } else {
                        $applyHref = 'contact.php';
                        $applyLabel = 'Contact HR Office';
                    }
                    ?>
                    <article class="news-card reveal-on-scroll">
                        <p class="meta">Deadline: <?= htmlspecialchars(date('F j, Y', strtotime((string)$job['deadline'])), ENT_QUOTES, 'UTF-8') ?></p>
                        <h3><?= htmlspecialchars((string)$job['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <?php if ((string)($job['department'] ?? '') !== ''): ?>
                            <p><strong>Department:</strong> <?= htmlspecialchars((string)$job['department'], ENT_QUOTES, 'UTF-8') ?></p>
                        <?php endif; ?>
                        <?php if ((string)($job['location'] ?? '') !== ''): ?>
                            <p><strong>Location:</strong> <?= htmlspecialchars((string)$job['location'], ENT_QUOTES, 'UTF-8') ?></p>
                        <?php endif; ?>
                        <?php if ((string)($job['employment_type'] ?? '') !== ''): ?>
                            <p><strong>Type:</strong> <?= htmlspecialchars((string)$job['employment_type'], ENT_QUOTES, 'UTF-8') ?></p>
                        <?php endif; ?>
                        <p><?= htmlspecialchars((string)$job['summary'], ENT_QUOTES, 'UTF-8') ?></p>

                        <?php if (!empty($requirements)): ?>
                            <ul class="clean-list">
                                <?php foreach ($requirements as $requirement): ?>
                                    <li><?= htmlspecialchars(trim($requirement), ENT_QUOTES, 'UTF-8') ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <a href="<?= htmlspecialchars($applyHref, ENT_QUOTES, 'UTF-8') ?>" class="btn btn-primary">
                            <?= htmlspecialchars($applyLabel, ENT_QUOTES, 'UTF-8') ?>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="section section-tinted">
    <div class="container split-layout">
        <article class="callout reveal-on-scroll">
            <h2>How to Apply</h2>
            <ol class="clean-list ordered">
                <li>Prepare your application letter and updated CV.</li>
                <li>Attach academic credentials and any supporting documents.</li>
                <li>Submit before the listed deadline using the application link or email.</li>
                <li>Shortlisted candidates will be contacted for interview.</li>
            </ol>
        </article>
        <article class="callout reveal-on-scroll">
            <h2>Application Contact</h2>
            <p><strong>Email:</strong> careers@cuc.edu.lr</p>
            <p><strong>Phone:</strong> +231 88 1846 653</p>
            <p><strong>Office Hours:</strong> Monday to Friday, 8:30 AM - 4:30 PM</p>
            <a href="contact.php" class="btn btn-primary">Contact HR Office</a>
        </article>
    </div>
</section>

<section class="cta">
    <div class="container cta-inner">
        <h2>Build Your Career with CUC</h2>
        <p>Join a collaborative institution committed to excellence, integrity, and service.</p>
        <div class="btn-row">
            <a href="mailto:careers@cuc.edu.lr" class="btn btn-primary">Apply by Email</a>
            <a href="news.php" class="btn btn-light">Back to News</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
