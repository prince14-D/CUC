<?php
$pageTitle = 'Colleges';
$pageDescription = 'Explore the colleges within Christian University College.';
$bodyClass = 'colleges-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
    .colleges-page .page-hero {
        padding: 40px 0 20px;
    }

    .colleges-page .section {
        padding: 1.5rem 0;
    }

    .colleges-page .section-heading {
        margin-bottom: 1rem;
        text-align: left;
    }

    .colleges-page .section-heading h2 {
        font-size: clamp(1.3rem, 4vw, 1.6rem);
        margin-bottom: 8px;
    }

    .colleges-page .section-heading p {
        font-size: 0.9rem;
    }

    .colleges-page .about-stats-grid,
    .colleges-page .news-grid,
    .colleges-page .split-layout {
        grid-template-columns: 1fr;
    }

    .colleges-page .about-stat-card,
    .colleges-page .news-card,
    .colleges-page .callout {
        padding: 1rem;
    }

    .colleges-page .btn-row {
        flex-direction: column;
        gap: 0.6rem;
    }

    .colleges-page .btn-row .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .colleges-page .page-hero {
        padding: 34px 0 18px;
    }

    .colleges-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .colleges-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .colleges-page p,
    .colleges-page li {
        font-size: 0.92rem;
    }

    .colleges-page .about-stat-card strong {
        font-size: clamp(1.3rem, 7vw, 1.8rem);
    }

    .colleges-page .news-card h3,
    .colleges-page .callout h2 {
        font-size: 1rem;
    }
}
</style>

<section
    class="page-hero"
    style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.9), rgba(140, 21, 21, 0.82)), url('assets/images/slider2.jpeg') center/cover no-repeat;">
    <div class="container">
        <span class="eyebrow">Colleges</span>
        <h1>Academic Colleges at Christian University College</h1>
        <p>Our colleges provide focused learning pathways that prepare students for careers, leadership, and service.</p>
    </div>
</section>

<section class="section about-highlight-band">
    <div class="container about-stats-grid">
        <article class="about-stat-card">
            <strong>6</strong>
            <span>Academic Colleges</span>
        </article>
        <article class="about-stat-card">
            <strong>40+</strong>
            <span>Programs and Certificates</span>
        </article>
        <article class="about-stat-card">
            <strong>250+</strong>
            <span>Faculty and Staff</span>
        </article>
        <article class="about-stat-card">
            <strong>3,500+</strong>
            <span>Students Enrolled</span>
        </article>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Our Colleges</span>
            <h2>Choose a College Aligned with Your Calling</h2>
            <p>Each college combines academic depth, practical training, and values-based leadership development.</p>
        </div>
        <div class="news-grid">
            <article class="news-card reveal-on-scroll">
                <h3>College of Business and Public Administration</h3>
                <p>Programs that prepare ethical professionals for business leadership, public service, and organizational development.</p>
                <ul class="clean-list">
                    <li>Business Administration</li>
                    <li>Public Administration</li>
                    <li>Leadership and Management</li>
                </ul>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>College of Education</h3>
                <p>Teacher preparation and educational leadership training for impactful service in schools and learning communities.</p>
                <ul class="clean-list">
                    <li>Teacher Education</li>
                    <li>Educational Leadership</li>
                    <li>Curriculum and Instruction</li>
                </ul>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>College of Health Sciences</h3>
                <p>Health-focused programs that combine academic excellence, practical training, and compassionate care.</p>
                <ul class="clean-list">
                    <li>Public Health Foundations</li>
                    <li>Clinical and Community Practice</li>
                    <li>Health Policy and Promotion</li>
                </ul>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>College of Social Sciences and Human Studies</h3>
                <p>Interdisciplinary programs that address social development, human behavior, and community transformation.</p>
                <ul class="clean-list">
                    <li>Social Sciences</li>
                    <li>Human Studies</li>
                    <li>Community Development</li>
                </ul>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>College of Biblical Studies (Theology)</h3>
                <p>Biblical and theological education designed to form grounded leaders for ministry and service.</p>
                <ul class="clean-list">
                    <li>Biblical Studies</li>
                    <li>Theology</li>
                    <li>Ministry Formation</li>
                </ul>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>College of Sciences &amp; Technology</h3>
                <p>Scientific and technology-centered learning pathways for innovation, research, and practical problem solving.</p>
                <ul class="clean-list">
                    <li>Natural Sciences</li>
                    <li>Computing and Technology</li>
                    <li>Applied Research</li>
                </ul>
            </article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container split-layout">
        <article class="callout reveal-on-scroll">
            <h2>How Our College Structure Supports Students</h2>
            <p>
                Students can begin with certificates, progress to diploma tracks, and continue into degree pathways.
                This staged approach allows flexibility while keeping academic quality and career relevance at the center.
            </p>
            <p>
                Academic advisors in each college help students select pathways based on interests, strengths,
                and long-term professional goals.
            </p>
        </article>
        <article class="callout reveal-on-scroll">
            <h2>Download College Program Guide</h2>
            <p>Access complete program details, entry pathways, and faculty information in one document.</p>
            <a href="assets/docs/program-catalog.pdf" class="btn btn-primary" download>Download Program Catalog (PDF)</a>
        </article>
    </div>
</section>

<section class="cta">
    <div class="container cta-inner">
        <h2>Ready to Join a College at CUC?</h2>
        <p>Explore admissions and choose the academic pathway that fits your future.</p>
        <div class="btn-row">
            <a href="admissions.php" class="btn btn-primary">Start Application</a>
            <a href="academics.php" class="btn btn-light">View All Programs</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
