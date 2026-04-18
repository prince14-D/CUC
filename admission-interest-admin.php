<?php
session_start();

$adminUser = getenv('CUC_ADMIN_USER') ?: 'admin';
$adminPass = getenv('CUC_ADMIN_PASS') ?: 'changeme-now';
$usingDefaultCredentials = getenv('CUC_ADMIN_USER') === false || getenv('CUC_ADMIN_PASS') === false;

$storageFile = __DIR__ . '/storage/admission_interest_submissions.csv';
$loginError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'logout') {
    $_SESSION['admission_admin_logged_in'] = false;
    $_SESSION['admission_admin_user'] = null;
    header('Location: admission-interest-admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'login') {
    $username = trim($_POST['username'] ?? '');
    $password = (string)($_POST['password'] ?? '');

    if (hash_equals((string)$adminUser, $username) && hash_equals((string)$adminPass, $password)) {
        $_SESSION['admission_admin_logged_in'] = true;
        $_SESSION['admission_admin_user'] = $username;
        header('Location: admission-interest-admin.php');
        exit;
    }

    $loginError = 'Invalid username or password.';
}

$isAuthenticated = !empty($_SESSION['admission_admin_logged_in']);

if ($isAuthenticated && isset($_GET['download']) && $_GET['download'] === 'csv') {
    if (!file_exists($storageFile)) {
        header('HTTP/1.1 404 Not Found');
        header('Content-Type: text/plain; charset=UTF-8');
        echo 'No submissions file found.';
        exit;
    }

    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="admission_interest_submissions.csv"');
    header('Content-Length: ' . filesize($storageFile));
    readfile($storageFile);
    exit;
}

$pageTitle = 'Admission Interest Admin';
$pageDescription = 'Protected admin view for admission interest submissions.';
$bodyClass = 'admission-interest-admin-page';
include 'includes/header.php';

$headers = [];
$rows = [];

if ($isAuthenticated && file_exists($storageFile)) {
    $fp = fopen($storageFile, 'rb');
    if ($fp !== false) {
        $headers = fgetcsv($fp) ?: [];
        while (($data = fgetcsv($fp)) !== false) {
            if (count($data) > 1) {
                $rows[] = $data;
            }
        }
        fclose($fp);
    }

    $rows = array_reverse($rows);
}
?>

<style>
@media (max-width: 720px) {
    .admission-interest-admin-page .page-hero {
        padding: 40px 0 20px;
    }

    .admission-interest-admin-page .section {
        padding: 1.5rem 0;
    }

    .admission-interest-admin-page .split-layout {
        grid-template-columns: 1fr;
    }

    .admission-interest-admin-page .callout,
    .admission-interest-admin-page .admin-table-wrap {
        padding: 1rem;
    }

    .admission-interest-admin-page .btn-row {
        flex-direction: column;
        gap: 0.6rem;
    }

    .admission-interest-admin-page .btn-row .btn,
    .admission-interest-admin-page .contact-form button,
    .admission-interest-admin-page .cta-inner .btn {
        width: 100%;
    }

    .admission-interest-admin-page .admin-table-wrap {
        margin-top: 1rem !important;
    }

    .admission-interest-admin-page .admin-table-wrap > div[style] {
        border-radius: 10px !important;
    }

    .admission-interest-admin-page .admin-table-wrap table {
        min-width: 760px !important;
    }
}

@media (max-width: 480px) {
    .admission-interest-admin-page .page-hero {
        padding: 34px 0 18px;
    }

    .admission-interest-admin-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .admission-interest-admin-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .admission-interest-admin-page p,
    .admission-interest-admin-page label,
    .admission-interest-admin-page input,
    .admission-interest-admin-page button,
    .admission-interest-admin-page td,
    .admission-interest-admin-page th {
        font-size: 0.92rem;
    }

    .admission-interest-admin-page .callout h2,
    .admission-interest-admin-page .cta-inner h2 {
        font-size: 1rem;
    }

    .admission-interest-admin-page .admin-table-wrap table {
        min-width: 680px !important;
    }
}
</style>

<section
    class="page-hero"
    style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.9), rgba(140, 21, 21, 0.82)), url('assets/images/slider2.jpeg') center/cover no-repeat;">
    <div class="container">
        <span class="eyebrow">Admin Panel</span>
        <h1>Admission Interest Submissions</h1>
        <p>Secure access to student interest records and CSV export.</p>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <?php if (!$isAuthenticated): ?>
            <article class="callout reveal-on-scroll" style="max-width: 620px; margin: 0 auto;">
                <h2>Admin Login</h2>
                <p>Sign in to view submissions and download the CSV file.</p>

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
                    <h2>Submission Controls</h2>
                    <p><strong>Logged in as:</strong> <?= htmlspecialchars((string)($_SESSION['admission_admin_user'] ?? 'Admin'), ENT_QUOTES, 'UTF-8') ?></p>
                    <p><strong>Total submissions:</strong> <?= (int)count($rows) ?></p>
                    <div class="btn-row">
                        <a href="admission-interest-admin.php?download=csv" class="btn btn-primary">Download CSV</a>
                        <form method="post" action="" style="display: inline;">
                            <input type="hidden" name="action" value="logout">
                            <button type="submit" class="btn btn-light">Logout</button>
                        </form>
                    </div>
                </article>

                <article class="callout reveal-on-scroll">
                    <h2>Storage Location</h2>
                    <p><code>storage/admission_interest_submissions.csv</code></p>
                    <p>Each new form submission is appended automatically and can be exported at any time.</p>
                </article>
            </div>

            <div class="admin-table-wrap reveal-on-scroll" style="margin-top: 1.5rem;">
                <?php if (empty($rows) || empty($headers)): ?>
                    <div class="form-alert form-alert-error">No submissions available yet.</div>
                <?php else: ?>
                    <div style="overflow-x: auto; background: #fff; border: 1px solid var(--color-border); border-radius: 12px; box-shadow: var(--shadow-soft);">
                        <table style="width: 100%; border-collapse: collapse; min-width: 980px;">
                            <thead>
                                <tr style="background: var(--color-cream); text-align: left;">
                                    <?php foreach ($headers as $header): ?>
                                        <th style="padding: 10px 12px; border-bottom: 1px solid var(--color-border); font-size: 0.9rem;">
                                            <?= htmlspecialchars((string)$header, ENT_QUOTES, 'UTF-8') ?>
                                        </th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $row): ?>
                                    <tr>
                                        <?php foreach ($row as $cell): ?>
                                            <td style="padding: 10px 12px; border-bottom: 1px solid var(--color-border); vertical-align: top;">
                                                <?= htmlspecialchars((string)$cell, ENT_QUOTES, 'UTF-8') ?>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="cta">
    <div class="container cta-inner">
        <h2>Admissions Workflow</h2>
        <p>Use the admissions interest form to collect and review student intent before full application.</p>
        <div class="btn-row">
            <a href="admission-interest.php" class="btn btn-primary">Open Student Form</a>
            <a href="admissions.php" class="btn btn-light">Back to Admissions</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
