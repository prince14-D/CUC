<?php
$pageTitle = 'Academic Affairs';
$pageDescription = 'Academic Affairs at Christian University College.';
$bodyClass = 'academic-affairs-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
    .academic-affairs-page .page-hero {
        padding: 40px 0 20px;
    }

    .academic-affairs-page .section {
        padding: 1.5rem 0;
    }

    .academic-affairs-page .section-heading {
        margin-bottom: 1rem;
        text-align: left;
    }

    .academic-affairs-page .section-heading h2 {
        font-size: clamp(1.3rem, 4vw, 1.6rem);
        margin-bottom: 8px;
    }

    .academic-affairs-page .section-heading p {
        font-size: 0.9rem;
    }

    .academic-affairs-page .about-stats-grid,
    .academic-affairs-page .split-layout,
    .academic-affairs-page .feature-grid {
        grid-template-columns: 1fr;
    }

    .academic-affairs-page .about-stat-card,
    .academic-affairs-page .feature-card,
    .academic-affairs-page .callout,
    .academic-affairs-page .president-message {
        padding: 1rem;
    }

    .academic-affairs-page .president-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .academic-affairs-page .president-photo-wrap {
        max-width: 100%;
    }

    .academic-affairs-page .president-photo {
        min-height: 240px;
        height: auto;
    }

    .academic-affairs-page .btn-row {
        flex-direction: column;
        gap: 0.6rem;
    }

    .academic-affairs-page .btn-row .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .academic-affairs-page .page-hero {
        padding: 34px 0 18px;
    }

    .academic-affairs-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .academic-affairs-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .academic-affairs-page p,
    .academic-affairs-page li {
        font-size: 0.92rem;
    }

    .academic-affairs-page .about-stat-card strong {
        font-size: clamp(1.3rem, 7vw, 1.8rem);
    }

    .academic-affairs-page .president-photo {
        min-height: 200px;
    }

    .academic-affairs-page .feature-card h3,
    .academic-affairs-page .callout h2,
    .academic-affairs-page .president-message h2 {
        font-size: 1rem;
    }
}
</style>

<section
    class="page-hero"
    style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.9), rgba(140, 21, 21, 0.82)), url('assets/images/slider2.jpeg') center/cover no-repeat;">
    <div class="container">
        <span class="eyebrow">Academic Affairs</span>
        <h1>Driving Excellence in Teaching and Learning</h1>
        <p>The Division of Academic Affairs oversees curriculum quality, faculty support, and academic standards across the university.</p>
    </div>
</section>

<section class="section about-highlight-band">
    <div class="container about-stats-grid">
        <article class="about-stat-card">
            <strong>40+</strong>
            <span>Academic Programs</span>
        </article>
        <article class="about-stat-card">
            <strong>250+</strong>
            <span>Faculty and Staff</span>
        </article>
        <article class="about-stat-card">
            <strong>6</strong>
            <span>Academic Colleges</span>
        </article>
        <article class="about-stat-card">
            <strong>100%</strong>
            <span>Quality Assurance Commitment</span>
        </article>
    </div>
</section>

<section class="section section-tinted">
    <div class="container split-layout">
        <article class="callout reveal-on-scroll">
            <h2>Mandate</h2>
            <ul class="clean-list">
                <li>Curriculum planning and academic policy implementation</li>
                <li>Faculty development and teaching quality enhancement</li>
                <li>Academic records and progression standards</li>
                <li>Program approval and review coordination</li>
            </ul>
        </article>
        <article class="callout reveal-on-scroll">
            <h2>Commitment</h2>
            <p>Academic Affairs works with all colleges and departments to ensure every student receives a rigorous, relevant, and ethical education.</p>
            <p>We continuously strengthen teaching standards, student assessment systems, and learning outcomes through evidence-based academic planning.</p>
        </article>
    </div>
</section>

<section class="section president-section">
    <div class="container president-grid">
        <div class="president-photo-wrap">
            <img src="assets/images/President1.jpeg" alt="Portrait of the Academic Affairs leadership" class="president-photo">
        </div>
        <article class="president-message">
            <span class="eyebrow">Academic Affairs Message</span>
            <h2>Academic Standards That Prepare Students for Impact</h2>
            <p>
                Our focus is to ensure that every course, department, and program aligns with national standards
                and global best practices. We work closely with faculty to strengthen teaching quality,
                curriculum relevance, and student-centered learning.
            </p>
            <p>
                Through collaboration with colleges and support units, Academic Affairs promotes innovation,
                accountability, and continuous improvement in all teaching and learning processes.
            </p>
            <p class="president-signature">
                <strong>Office of Academic Affairs</strong><br>
                Christian University College
            </p>
        </article>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Academic Activities</span>
            <h2>Key Activities Led by Academic Affairs</h2>
            <p>Academic Affairs coordinates initiatives that improve quality, progression, and overall student success.</p>
        </div>
        <div class="feature-grid">
            <article class="feature-card reveal-on-scroll">
                <h3>Curriculum Review Cycles</h3>
                <p>Programs are periodically reviewed to ensure relevance, rigor, and alignment with emerging industry needs.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Faculty Capacity Development</h3>
                <p>Lecturers receive training in pedagogy, assessment design, and student engagement methods.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Examination and Assessment Oversight</h3>
                <p>Academic policies and exam processes are managed to preserve fairness, integrity, and consistency.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Academic Advising Framework</h3>
                <p>Students are guided on course selection, progression pathways, and academic planning milestones.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Quality Assurance Monitoring</h3>
                <p>Learning outcomes, teaching effectiveness, and program performance are tracked for improvement.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Research and Innovation Support</h3>
                <p>Academic units receive support to integrate applied research and innovation into program delivery.</p>
            </article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container split-layout">
        <article class="callout reveal-on-scroll">
            <h2>Academic Resources</h2>
            <p>Download important references on standards, program pathways, and academic quality support.</p>
            <a href="assets/docs/academic-quality-assurance.pdf" class="btn btn-primary" download>Download Academic Quality Guide (PDF)</a>
        </article>
        <article class="callout reveal-on-scroll">
            <h2>Need Immediate Help?</h2>
            <p>Contact the Academic Affairs office directly for advising, records clarification, or curriculum support.</p>
            <p><strong>Email:</strong> academicaffairs@cuc.edu.lr</p>
            <p><strong>Phone:</strong> +231 88 1846 653</p>
        </article>
    </div>
</section>

<section class="cta">
    <div class="container cta-inner">
        <h2>Connect with Academic Affairs</h2>
        <p>Get guidance on programs, progression, and academic planning today.</p>
        <div class="btn-row">
            <a href="contact.php" class="btn btn-primary">Contact Office</a>
            <a href="academics.php" class="btn btn-light">Explore Programs</a>
        </div>
    </div>
</section>



<?php include 'includes/footer.php'; ?>
