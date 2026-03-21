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
    <link rel="icon" type="image/jpeg" href="assets/images/logo.jpg">
    <link rel="apple-touch-icon" href="assets/images/logo.jpg">
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
            <div class="nav-dropdown">
                <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false" aria-controls="about-submenu">
                    About
                </button>
                <div id="about-submenu" class="dropdown-menu">
                    <a href="about-overview.php">Overview</a>
                    <a href="office-president.php">Office of the President</a>
                    <a href="office-vice-president.php">Office of the Vice President</a>
                    <a href="history.php">History</a>
                </div>
            </div>
            <div class="nav-dropdown">
                <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false" aria-controls="academics-submenu">
                    Academics
                </button>
                <div id="academics-submenu" class="dropdown-menu">
                    <a href="academics.php">Academics Overview</a>
                    <a href="dean-student-affairs.php">Dean of Student Affairs</a>
                    <a href="colleges.php">Colleges</a>
                    <a href="departments-a-z.php">Departments A-Z</a>
                    <a href="academic-affairs.php">Academic Affairs</a>
                    <a href="academic-calendar.php">Academic Calendar</a>
                    <a href="academic-quality-assurance.php">Academic Quality Assurance</a>
                    <a href="student-handbook.php">Student Handbook</a>
                </div>
            </div>
            <a href="admissions.php">Admissions</a>
            <div class="nav-dropdown">
                <button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false" aria-controls="pages-submenu">
                    Pages
                </button>
                <div id="pages-submenu" class="dropdown-menu">

                    <a href="accreditation.php">Accreditation</a>
                    <a href="faculty-staff.php">Faculty &amp; Staff</a>
                    <a href="alumni.php">Alumni</a>
                </div>
            </div>
            <a href="news.php">News</a>
            <a href="contact.php">Contact</a>
            <a href="https://portal.yourschool.com" class="portal-btn">Student Portal</a>
        </nav>
    </div>
</header>
<main>