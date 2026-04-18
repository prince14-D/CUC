<?php
$pageTitle = 'About Overview';
$pageDescription = 'Overview of Christian University College, mission, vision, and institutional values.';
$bodyClass = 'about-overview-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
    .about-overview-page .page-hero {
        padding: 40px 0 20px;
    }

    .about-overview-page .section {
        padding: 1.5rem 0;
    }

    .about-overview-page .section-heading {
        margin-bottom: 1rem;
        text-align: left;
    }

    .about-overview-page .section-heading h2 {
        font-size: clamp(1.3rem, 4vw, 1.6rem);
        margin-bottom: 8px;
    }

    .about-overview-page .section-heading p {
        font-size: 0.9rem;
    }

    .about-overview-page .about-stats-grid,
    .about-overview-page .feature-grid,
    .about-overview-page .about-pillars-grid,
    .about-overview-page .about-timeline,
    .about-overview-page .split-layout {
        grid-template-columns: 1fr;
    }

    .about-overview-page .about-stat-card,
    .about-overview-page .feature-card,
    .about-overview-page .about-pillar-card,
    .about-overview-page .about-timeline article,
    .about-overview-page .callout {
        padding: 1rem;
    }

    .about-overview-page .about-timeline article {
        border-left-width: 4px;
    }

    .about-overview-page .cta .container {
        padding: 1rem 0;
    }

    .about-overview-page .btn-row {
        flex-direction: column;
        gap: 0.6rem;
    }

    .about-overview-page .btn-row .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .about-overview-page .page-hero {
        padding: 34px 0 18px;
    }

    .about-overview-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .about-overview-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .about-overview-page p,
    .about-overview-page li {
        font-size: 0.92rem;
    }

    .about-overview-page .about-stat-card strong {
        font-size: clamp(1.3rem, 7vw, 1.8rem);
    }

    .about-overview-page .about-timeline h3,
    .about-overview-page .about-pillar-card h3,
    .about-overview-page .feature-card h3,
    .about-overview-page .callout h3 {
        font-size: 1rem;
    }
}
</style>

<section class="page-hero about-overview-hero">
    <div class="container">
        <span class="eyebrow">About Overview</span>
        <h1>Christian University College at a Glance</h1>
        <p>
            Christian University College is a Christ-centered institution dedicated to
            academic excellence, ethical leadership, and service to society.
        </p>
    </div>
</section>

<section class="section about-highlight-band">
    <div class="container about-stats-grid">
        <article class="about-stat-card">
            <strong>2019</strong>
            <span>Year Founded</span>
        </article>
        <article class="about-stat-card">
            <strong>40+</strong>
            <span>Academic Pathways</span>
        </article>
        <article class="about-stat-card">
            <strong>3,500+</strong>
            <span>Active Students</span>
        </article>
        <article class="about-stat-card">
            <strong>25</strong>
            <span>Global Partners</span>
        </article>
    </div>
</section>

<section class="section">
    <div class="container split-layout">
        <article>
            <h2>Who We Are</h2>
            <p>
                Founded in 2019 in Paynesville City, Liberia, CUC delivers quality education
                designed to equip students with practical competence, strong character, and
                a commitment to national and global impact.
            </p>
            <p>
                Our learning environment promotes critical thinking, innovation, and
                values-based decision-making across all disciplines.
            </p>
        </article>
        <article class="callout">
            <h3>Mission</h3>
            <p>To foster wisdom, faith, and service through excellent academic programs in a Christ-centered community.</p>
            <h3>Vision</h3>
            <p>To be a leading institution recognized for academic excellence and transformational leadership.</p>
        </article>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Core Values</span>
            <h2>Principles That Shape the CUC Experience</h2>
        </div>
        <div class="feature-grid">
            <article class="feature-card"><h3>Integrity</h3><p>We uphold honesty and accountability.</p></article>
            <article class="feature-card"><h3>Excellence</h3><p>We pursue high standards in teaching and service.</p></article>
            <article class="feature-card"><h3>Innovation</h3><p>We embrace creative and practical solutions.</p></article>
            <article class="feature-card"><h3>Service</h3><p>We build communities through purposeful action.</p></article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Strategic Focus</span>
            <h2>How CUC Delivers Transformational Education</h2>
        </div>
        <div class="about-pillars-grid">
            <article class="about-pillar-card">
                <h3>Academic Rigor</h3>
                <p>Programs are designed with strong standards, practical relevance, and measurable outcomes.</p>
            </article>
            <article class="about-pillar-card">
                <h3>Leadership Formation</h3>
                <p>Students develop confidence, ethical judgment, and servant leadership values.</p>
            </article>
            <article class="about-pillar-card">
                <h3>Innovation and Technology</h3>
                <p>Digital tools and modern learning models prepare students for future-focused careers.</p>
            </article>
            <article class="about-pillar-card">
                <h3>Community Impact</h3>
                <p>CUC aligns learning with societal needs through outreach, research, and collaboration.</p>
            </article>
        </div>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Milestones</span>
            <h2>Our Journey in Brief</h2>
        </div>
        <div class="about-timeline">
            <article>
                <h3>2019</h3>
                <p>Christian University College was established with a mission to provide faith-based quality education.</p>
            </article>
            <article>
                <h3>2021</h3>
                <p>Expanded academic programs across business, technology, education, and ministry studies.</p>
            </article>
            <article>
                <h3>2024</h3>
                <p>Enhanced e-learning systems and student services to improve access and support.</p>
            </article>
            <article>
                <h3>2026</h3>
                <p>Strengthened global partnerships and institutional visibility across the region.</p>
            </article>
        </div>
    </div>
</section>

<section class="cta about-cta">
    <div class="container cta-inner">
        <h2>Discover More About Life and Learning at CUC</h2>
        <p>Explore our academic pages, leadership offices, and opportunities to become part of our growing university community.</p>
        <div class="btn-row">
            <a href="academics.php" class="btn btn-primary">Explore Academics</a>
            <a href="contact.php" class="btn btn-light">Contact Admissions</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
