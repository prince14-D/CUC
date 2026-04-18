<?php
$pageTitle = 'Departments A-Z';
$pageDescription = 'Alphabetical list of academic departments at Christian University College.';
$bodyClass = 'departments-a-z-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
    .departments-a-z-page .page-hero {
        padding: 40px 0 20px;
    }

    .departments-a-z-page .section {
        padding: 1.5rem 0;
    }

    .departments-a-z-page .section-heading {
        margin-bottom: 1rem;
        text-align: left;
    }

    .departments-a-z-page .section-heading h2 {
        font-size: clamp(1.3rem, 4vw, 1.6rem);
        margin-bottom: 8px;
    }

    .departments-a-z-page .section-heading p {
        font-size: 0.9rem;
    }

    .departments-a-z-page .about-stats-grid,
    .departments-a-z-page .news-grid,
    .departments-a-z-page .feature-grid,
    .departments-a-z-page .split-layout,
    .departments-a-z-page .department-photo-grid {
        grid-template-columns: 1fr;
    }

    .departments-a-z-page .about-stat-card,
    .departments-a-z-page .news-card,
    .departments-a-z-page .feature-card,
    .departments-a-z-page .callout {
        padding: 1rem;
    }

    .departments-a-z-page .btn-row {
        flex-direction: column;
        gap: 0.6rem;
    }

    .departments-a-z-page .btn-row .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .departments-a-z-page .page-hero {
        padding: 34px 0 18px;
    }

    .departments-a-z-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .departments-a-z-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .departments-a-z-page p,
    .departments-a-z-page li {
        font-size: 0.92rem;
    }

    .departments-a-z-page .about-stat-card strong {
        font-size: clamp(1.3rem, 7vw, 1.8rem);
    }

    .departments-a-z-page .news-card h3,
    .departments-a-z-page .feature-card h3,
    .departments-a-z-page .callout h2 {
        font-size: 1rem;
    }
}
</style>

<section
    class="page-hero"
    style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.9), rgba(140, 21, 21, 0.82)), url('assets/images/slider1.jpeg') center/cover no-repeat;">
    <div class="container">
        <span class="eyebrow">Departments A-Z</span>
        <h1>Browse Academic Departments by Discipline</h1>
        <p>Explore departments across business, technology, education, public service, and theology to find your ideal study pathway.</p>
    </div>
</section>

<section class="section about-highlight-band">
    <div class="container about-stats-grid">
        <article class="about-stat-card">
            <strong>6</strong>
            <span>Core Departments</span>
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
            <span class="eyebrow">A-Z Directory</span>
            <h2>Department Listings</h2>
            <p>Use this quick directory to identify departments and specialization areas offered at Christian University College.</p>
        </div>
        <div class="news-grid">
            <article class="news-card reveal-on-scroll">
                <h3>A-D</h3>
                <ul class="clean-list">
                    <li>Accounting Department</li>
                    <li>Business Administration Department</li>
                    <li>Computer Science Department</li>
                    <li>Development Studies Unit</li>
                </ul>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>E-P</h3>
                <ul class="clean-list">
                    <li>Education Department</li>
                    <li>Entrepreneurship and Innovation Unit</li>
                    <li>Public Administration Department</li>
                    <li>Policy and Governance Studies</li>
                </ul>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>T-Z</h3>
                <ul class="clean-list">
                    <li>Theology Department</li>
                    <li>Teacher Development Programs</li>
                    <li>Technology and Digital Learning Support</li>
                    <li>Youth Leadership and Ethics Studies</li>
                </ul>
            </article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Popular Departments</span>
            <h2>Academic Units Driving Student Success</h2>
        </div>
        <div class="feature-grid">
            <article class="feature-card reveal-on-scroll"><h3>Accounting Department</h3><p>Financial accounting, auditing, and taxation with practical case-based learning.</p></article>
            <article class="feature-card reveal-on-scroll"><h3>Business Administration Department</h3><p>Management, operations, entrepreneurship, and organizational leadership training.</p></article>
            <article class="feature-card reveal-on-scroll"><h3>Computer Science Department</h3><p>Programming, data fundamentals, and systems design for digital transformation careers.</p></article>
            <article class="feature-card reveal-on-scroll"><h3>Education Department</h3><p>Teacher preparation and educational leadership for schools and learning institutions.</p></article>
            <article class="feature-card reveal-on-scroll"><h3>Public Administration Department</h3><p>Governance, policy, and development administration for public service impact.</p></article>
            <article class="feature-card reveal-on-scroll"><h3>Theology Department</h3><p>Biblical studies, ministry formation, ethics, and faith-based leadership.</p></article>
        </div>
    </div>
</section>

<section class="section section-tinted">
    <div class="container split-layout">
        <article class="callout reveal-on-scroll">
            <h2>Advising and Department Selection Support</h2>
            <p>
                Not sure which department is right for you? Our academic advisors can help you choose
                a pathway that fits your goals, strengths, and long-term career plans.
            </p>
            <p>
                Students can also request progression guidance when moving from certificate to diploma
                and degree-level study options.
            </p>
        </article>
        <article class="callout reveal-on-scroll">
            <h2>Download Department Guide</h2>
            <p>Get complete department and program details in one document for admissions and planning.</p>
            <a href="assets/docs/program-catalog.pdf" class="btn btn-primary" download>Download Program Catalog (PDF)</a>
        </article>
    </div>
</section>

<section class="cta">
    <div class="container cta-inner">
        <h2>Find Your Department and Start Your Journey</h2>
        <p>Connect with admissions to explore requirements, pathways, and next steps.</p>
        <div class="btn-row">
            <a href="admissions.php" class="btn btn-primary">Apply Now</a>
            <a href="contact.php" class="btn btn-light">Talk to an Advisor</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
