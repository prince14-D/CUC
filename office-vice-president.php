<?php
$pageTitle = 'Office of the Vice President';
$pageDescription = 'Administrative and academic coordination role of the Office of the Vice President at Christian University College.';
$bodyClass = 'office-vice-president-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
    .office-vice-president-page .page-hero {
        padding: 40px 0 20px;
    }

    .office-vice-president-page .section {
        padding: 1.5rem 0;
    }

    .office-vice-president-page .section-heading {
        margin-bottom: 1rem;
        text-align: left;
    }

    .office-vice-president-page .section-heading h2 {
        font-size: clamp(1.3rem, 4vw, 1.6rem);
        margin-bottom: 8px;
    }

    .office-vice-president-page .section-heading p {
        font-size: 0.9rem;
    }

    .office-vice-president-page .about-stats-grid,
    .office-vice-president-page .split-layout,
    .office-vice-president-page .feature-grid,
    .office-vice-president-page .about-pillars-grid,
    .office-vice-president-page .president-grid {
        grid-template-columns: 1fr;
    }

    .office-vice-president-page .about-stat-card,
    .office-vice-president-page .feature-card,
    .office-vice-president-page .about-pillar-card,
    .office-vice-president-page .callout,
    .office-vice-president-page .president-message {
        padding: 1rem;
    }

    .office-vice-president-page .president-grid {
        gap: 1rem;
    }

    .office-vice-president-page .president-photo-wrap {
        max-width: 100%;
    }

    .office-vice-president-page .president-photo {
        min-height: 240px;
        height: auto;
    }

    .office-vice-president-page .btn-row {
        flex-direction: column;
        gap: 0.6rem;
    }

    .office-vice-president-page .btn-row .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .office-vice-president-page .page-hero {
        padding: 34px 0 18px;
    }

    .office-vice-president-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .office-vice-president-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .office-vice-president-page p,
    .office-vice-president-page li {
        font-size: 0.92rem;
    }

    .office-vice-president-page .about-stat-card strong {
        font-size: clamp(1.3rem, 7vw, 1.8rem);
    }

    .office-vice-president-page .president-photo {
        min-height: 200px;
    }

    .office-vice-president-page .feature-card h3,
    .office-vice-president-page .about-pillar-card h3,
    .office-vice-president-page .callout h2,
    .office-vice-president-page .president-message h2 {
        font-size: 1rem;
    }
}
</style>

<section
    class="page-hero office-vice-president-hero"
    style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.88), rgba(140, 21, 21, 0.82)), url('assets/images/VPAA.png') center/cover no-repeat;">
    <div class="container">
        <span class="eyebrow">Office of the Vice President</span>
        <h1>Operational Excellence and Institutional Coordination</h1>
        <p>
            The Office of the Vice President supports implementation of university strategy
            across academic and administrative functions.
        </p>
    </div>
</section>

<section class="section about-highlight-band">
    <div class="container about-stats-grid">
        <article class="about-stat-card">
            <strong>6</strong>
            <span>Operational Units Coordinated</span>
        </article>
        <article class="about-stat-card">
            <strong>2</strong>
            <span>Major Academic Terms Annually</span>
        </article>
        <article class="about-stat-card">
            <strong>100%</strong>
            <span>Policy Implementation Focus</span>
        </article>
        <article class="about-stat-card">
            <strong>24/7</strong>
            <span>Student Service Improvement Mindset</span>
        </article>
    </div>
</section>

<section class="section section-tinted">
    <div class="container split-layout">
        <article class="callout">
            <h2>Core Functions</h2>
            <ul class="clean-list">
                <li>Coordinate interdepartmental planning and execution</li>
                <li>Monitor institutional performance and service delivery</li>
                <li>Support academic administration and policy implementation</li>
                <li>Facilitate stakeholder communication and operational improvement</li>
            </ul>
        </article>
        <article class="callout">
            <h2>Student and Staff Support</h2>
            <p>
                This office ensures that student services, faculty support systems, and
                administrative processes operate efficiently and align with CUC's mission.
            </p>
            <p>
                It also drives continuous improvement to enhance student outcomes and institutional effectiveness.
            </p>
        </article>
    </div>
</section>

<section class="section president-section">
    <div class="container president-grid">
        <div class="president-photo-wrap">
            <img src="assets/images/President2.jpeg" alt="Portrait of the Vice President of Christian University College" class="president-photo">
        </div>
        <article class="president-message">
            <span class="eyebrow">Vice President's Message</span>
            <h2>Building Systems That Empower Student Success</h2>
            <p>
                At Christian University College, our commitment is to ensure that every student,
                lecturer, and department is supported by efficient systems and responsive administration.
                We believe excellence is achieved through coordination, discipline, and service.
            </p>
            <p>
                The Office of the Vice President remains focused on strengthening operations,
                improving institutional performance, and creating a campus environment where
                academic and personal growth can thrive.
            </p>
            <p class="president-signature">
                <strong>Dr. Benjamin T. Munford</strong><br>
                Vice President, Christian University College
            </p>
        </article>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Execution Framework</span>
            <h2>How the Vice President's Office Delivers Results</h2>
        </div>
        <div class="about-pillars-grid">
            <article class="about-pillar-card">
                <h3>Planning and Coordination</h3>
                <p>Aligns institutional plans with measurable timelines and shared accountability.</p>
            </article>
            <article class="about-pillar-card">
                <h3>Performance Monitoring</h3>
                <p>Tracks progress across departments to ensure service quality and efficiency.</p>
            </article>
            <article class="about-pillar-card">
                <h3>Policy Execution</h3>
                <p>Supports practical application of academic and administrative policies campus-wide.</p>
            </article>
            <article class="about-pillar-card">
                <h3>Continuous Improvement</h3>
                <p>Uses feedback and data insights to refine student and staff experience.</p>
            </article>
        </div>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Core Values</span>
            <h2>Values Guiding the Vice President's Office</h2>
        </div>
        <div class="feature-grid">
            <article class="feature-card">
                <h3>Accountability</h3>
                <p>We commit to transparent systems, measurable outcomes, and responsible stewardship.</p>
            </article>
            <article class="feature-card">
                <h3>Collaboration</h3>
                <p>We work across units to ensure coordinated planning and effective execution.</p>
            </article>
            <article class="feature-card">
                <h3>Service Excellence</h3>
                <p>We prioritize timely, student-centered, and solution-focused administrative support.</p>
            </article>
            <article class="feature-card">
                <h3>Continuous Improvement</h3>
                <p>We use feedback and innovation to strengthen institutional quality and impact.</p>
            </article>
        </div>
    </div>
</section>

<section class="cta about-cta">
    <div class="container cta-inner">
        <h2>Connect with the Vice President's Office</h2>
        <p>Reach out for institutional coordination, policy guidance, and operational support matters.</p>
        <div class="btn-row">
            <a href="contact.php" class="btn btn-primary">Contact the Office</a>
            <a href="academics.php" class="btn btn-light">View Academic Structure</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
