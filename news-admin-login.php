<?php
session_start();

$adminUser = getenv('CUC_ADMIN_USER') ?: 'admin';
$adminPass = getenv('CUC_ADMIN_PASS') ?: 'changeme-now';
$usingDefaultCredentials = getenv('CUC_ADMIN_USER') === false || getenv('CUC_ADMIN_PASS') === false;
$loginError = '';

if (!empty($_SESSION['news_admin_logged_in'])) {
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

$pageTitle = 'News Admin Login';
$pageDescription = 'Secure login for the News and Job Vacancy admin panel.';
$bodyClass = 'news-admin-login-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
    .news-admin-login-page .page-hero {
        padding: 40px 0 20px;
    }

    .news-admin-login-page .section {
        padding: 1.5rem 0;
    }

    .news-admin-login-page .callout {
        max-width: 100% !important;
        margin: 0 auto !important;
        padding: 1rem;
    }

    .news-admin-login-page .contact-form button,
    .news-admin-login-page .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .news-admin-login-page .page-hero {
        padding: 34px 0 18px;
    }

    .news-admin-login-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .news-admin-login-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .news-admin-login-page p,
    .news-admin-login-page label,
    .news-admin-login-page input,
    .news-admin-login-page button {
        font-size: 0.92rem;
    }

    .news-admin-login-page .callout h2 {
        font-size: 1rem;
    }
}
</style>

<section class="page-hero" style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.9), rgba(140, 21, 21, 0.82)), url('assets/images/slider2.jpeg') center/cover no-repeat;">
    <div class="container">
        <span class="eyebrow">Admin Access</span>
        <h1>News Admin Login</h1>
        <p>Sign in before accessing the admin dashboard.</p>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <article class="callout reveal-on-scroll" style="max-width: 620px; margin: 0 auto;">
            <h2>Admin Login</h2>
            <p>Use your admin username and password to continue.</p>

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

            <form class="contact-form" method="post" action="news-admin.php">
                <input type="hidden" name="action" value="login">

                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="btn btn-primary">Sign In</button>
            </form>
        </article>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
