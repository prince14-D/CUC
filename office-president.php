<?php
$pageTitle = 'Office of the President';
$pageDescription = 'Leadership priorities and mandate of the Office of the President at Christian University College.';
$bodyClass = 'office-president-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
    .office-president-page .page-hero {
        padding: 40px 0 20px;
    }

    .office-president-page .section {
        padding: 1.5rem 0;
    }

    .office-president-page .section-heading {
        margin-bottom: 1rem;
        text-align: left;
    }

    .office-president-page .section-heading h2 {
        font-size: clamp(1.3rem, 4vw, 1.6rem);
        margin-bottom: 8px;
    }

    .office-president-page .section-heading p {
        font-size: 0.9rem;
    }

    .office-president-page .about-stats-grid,
    .office-president-page .split-layout,
    .office-president-page .feature-grid,
    .office-president-page .about-pillars-grid,
    .office-president-page .president-grid {
        grid-template-columns: 1fr;
    }

    .office-president-page .about-stat-card,
    .office-president-page .feature-card,
    .office-president-page .about-pillar-card,
    .office-president-page .callout,
    .office-president-page .president-message {
        padding: 1rem;
    }

    .office-president-page .president-grid {
        gap: 1rem;
    }

    .office-president-page .president-photo-wrap {
        max-width: 100%;
    }

    .office-president-page .president-photo {
        min-height: 240px;
        height: auto;
    }

    .office-president-page .btn-row {
        flex-direction: column;
        gap: 0.6rem;
    }

    .office-president-page .btn-row .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .office-president-page .page-hero {
        padding: 34px 0 18px;
    }

    .office-president-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .office-president-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .office-president-page p,
    .office-president-page li {
        font-size: 0.92rem;
    }

    .office-president-page .about-stat-card strong {
        font-size: clamp(1.3rem, 7vw, 1.8rem);
    }

    .office-president-page .president-photo {
        min-height: 200px;
    }

    .office-president-page .feature-card h3,
    .office-president-page .about-pillar-card h3,
    .office-president-page .callout h2,
    .office-president-page .president-message h2 {
        font-size: 1rem;
    }
}
</style>

<section
    class="page-hero office-president-hero"
    style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.88), rgba(140, 21, 21, 0.82)), url('assets/images/slider1.jpeg') center/cover no-repeat;">
    <div class="container">
        <span class="eyebrow">Office of the President</span>
        <h1>Strategic Leadership for Academic and Institutional Growth</h1>
        <p>
            The Office of the President provides vision, direction, and governance to advance
            Christian University College's mission.
        </p>
    </div>
</section>

<section class="section about-highlight-band">
    <div class="container about-stats-grid">
        <article class="about-stat-card">
            <strong>4</strong>
            <span>Strategic Priorities</span>
        </article>
        <article class="about-stat-card">
            <strong>25</strong>
            <span>Global Partnerships</span>
        </article>
        <article class="about-stat-card">
            <strong>40+</strong>
            <span>Academic Programs</span>
        </article>
        <article class="about-stat-card">
            <strong>3,500+</strong>
            <span>Students Served</span>
        </article>
    </div>
</section>

<section class="section">
    <div class="container split-layout">
        <article class="callout">
            <h2>Primary Responsibilities</h2>
            <ul class="clean-list">
                <li>Define institutional strategy and long-term priorities</li>
                <li>Strengthen academic excellence and quality assurance</li>
                <li>Oversee governance, partnerships, and resource mobilization</li>
                <li>Promote values-based leadership across all university units</li>
            </ul>
        </article>
        <article class="callout">
            <h2>Key Focus Areas</h2>
            <p>
                The office works closely with faculty, staff, students, and partners to ensure
                that CUC remains responsive to national development needs and global educational trends.
            </p>
            <p>
                Through collaborative leadership, the Office of the President drives innovation,
                accountability, and student-centered growth.
            </p>
        </article>
    </div>
</section>

<section class="section president-section">
    <div class="container president-grid">
        <div class="president-photo-wrap">
            <img src="assets/images/President1.jpeg" alt="Portrait of the President of Christian University College" class="president-photo">
        </div>
        <article class="president-message">
            <span class="eyebrow">President's Message</span>
            <h2>Leadership with Vision, Faith, and Service</h2>
            <p>
                At Christian University College, we are committed to cultivating graduates
                who are academically equipped, morally grounded, and prepared to serve society.
                Our focus is to build an institution where excellence and character grow together.
            </p>
            <p>
                I invite students, parents, faculty, alumni, and partners to join us in advancing
                a university community that values innovation, integrity, and transformative leadership.
            </p>
            <p class="president-signature">
                <strong>Rev. Dr. Daniel K. Mensah</strong><br>
                President, Christian University College
            </p>
        </article>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Core Values</span>
            <h2>Values That Guide the President's Office</h2>
        </div>
        <div class="feature-grid">
            <article class="feature-card">
                <h3>Integrity</h3>
                <p>We uphold transparency, accountability, and ethical leadership in every decision.</p>
            </article>
            <article class="feature-card">
                <h3>Excellence</h3>
                <p>We pursue the highest standards in governance, academics, and service delivery.</p>
            </article>
            <article class="feature-card">
                <h3>Innovation</h3>
                <p>We encourage forward-thinking solutions that improve learning and institutional growth.</p>
            </article>
            <article class="feature-card">
                <h3>Service</h3>
                <p>We lead with compassion and commitment to community and national development.</p>
            </article>
        </div>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Leadership Priorities</span>
            <h2>Current Focus of the President's Office</h2>
        </div>
        <div class="about-pillars-grid">
            <article class="about-pillar-card">
                <h3>Institutional Growth</h3>
                <p>Expand academic pathways and strengthen infrastructure for future-ready learning.</p>
            </article>
            <article class="about-pillar-card">
                <h3>Academic Quality</h3>
                <p>Promote robust teaching standards and measurable student learning outcomes.</p>
            </article>
            <article class="about-pillar-card">
                <h3>Partnership Development</h3>
                <p>Build local and international collaborations that broaden opportunities for students.</p>
            </article>
            <article class="about-pillar-card">
                <h3>Values and Governance</h3>
                <p>Strengthen accountability, integrity, and service-centered leadership culture.</p>
            </article>
        </div>
    </div>
</section>

<section class="cta about-cta">
    <div class="container cta-inner">
        <h2>Partner with the President's Office</h2>
        <p>Collaborate with CUC to support innovation, leadership development, and community transformation.</p>
        <div class="btn-row">
            <a href="contact.php" class="btn btn-primary">Contact Leadership Office</a>
            <a href="about-overview.php" class="btn btn-light">Back to About Overview</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
