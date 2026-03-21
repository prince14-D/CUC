<?php
$pageTitle = isset($pageTitle) ? $pageTitle . ' | Christian University College' : 'Christian University College';
$pageDescription = isset($pageDescription)
    ? $pageDescription
    : 'Christian University College offers faith-based, career-ready, and globally connected higher education in Liberia.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700;900&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="container nav-wrap">
        <a href="index.php" class="brand" aria-label="Christian University College home page">
            <img src="assets/images/logo.jpg" alt="Christian University College logo">
            <span>
                Christian University College
                <small>Education for Leadership and Service</small>
            </span>
        </a>

        <button class="menu-toggle" aria-label="Toggle navigation" aria-expanded="false" aria-controls="main-nav">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav id="main-nav" class="main-nav" aria-label="Main navigation">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="academics.php">Academics</a>
            <a href="admissions.php">Admissions</a>
            <a href="news.php">News</a>
            <a href="contact.php">Contact</a>
            <a href="https://portal.yourschool.com" class="portal-btn">Student Portal</a>
        </nav>
    </div>
</header>
<main>