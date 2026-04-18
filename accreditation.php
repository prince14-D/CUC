<?php
$pageTitle = 'Accreditation';
$pageDescription = 'Accreditation and quality assurance information for Christian University College.';
$bodyClass = 'accreditation-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
    .accreditation-page .page-hero {
        padding: 40px 0 20px;
    }

    .accreditation-page .section {
        padding: 1.5rem 0;
    }

    .accreditation-page .section-heading {
        margin-bottom: 1rem;
        text-align: left;
    }

    .accreditation-page .section-heading h2 {
        font-size: clamp(1.3rem, 4vw, 1.6rem);
        margin-bottom: 8px;
    }

    .accreditation-page .section-heading p {
        font-size: 0.9rem;
    }

    .accreditation-page .about-stats-grid,
    .accreditation-page .news-grid,
    .accreditation-page .feature-grid,
    .accreditation-page .split-layout {
        grid-template-columns: 1fr;
    }

    .accreditation-page .accreditation-spotlight {
        grid-template-columns: 1fr;
    }

    .accreditation-page .accreditation-copy-card {
        order: 1;
    }

    .accreditation-page .accreditation-photo-card {
        order: 2;
    }

    .accreditation-page .accreditation-photo-image {
        min-height: 220px;
    }

    .accreditation-page .callout,
    .accreditation-page .news-card,
    .accreditation-page .feature-card,
    .accreditation-page .about-stat-card {
        padding: 1rem;
    }
}

@media (max-width: 480px) {
    .accreditation-page .page-hero {
        padding: 34px 0 18px;
    }

    .accreditation-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .accreditation-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .accreditation-page p,
    .accreditation-page li {
        font-size: 0.92rem;
    }

    .accreditation-page .accreditation-photo-image {
        min-height: 180px;
    }
}
</style>

<section
    class="page-hero accreditation-hero"
    style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.9), rgba(140, 21, 21, 0.82)), url('assets/images/slider1.jpeg') center/cover no-repeat;">
    <div class="container">
        <span class="eyebrow">Accreditation</span>
        <h1>Committed to Quality and Academic Integrity</h1>
        <p>Christian University College upholds standards for excellence through continuous quality assurance and compliance.</p>
    </div>
</section>

<section class="section about-highlight-band accreditation-stats-section">
    <div class="container about-stats-grid">
        <article class="about-stat-card">
            <strong class="stat-number" data-target="1">1</strong>
            <span>National Regulatory Authority</span>
        </article>
        <article class="about-stat-card">
            <strong class="stat-number" data-target="40" data-suffix="+">40+</strong>
            <span>Programs Under Quality Review</span>
        </article>
        <article class="about-stat-card">
            <strong class="stat-number" data-target="2">2</strong>
            <span>Semester Monitoring Cycles</span>
        </article>
        <article class="about-stat-card">
            <strong class="stat-number" data-target="100" data-suffix="%">100%</strong>
            <span>Compliance Commitment</span>
        </article>
    </div>
</section>

<section class="section accreditation-spotlight-section">
    <div class="container split-layout accreditation-spotlight">
        <article class="callout reveal-on-scroll accreditation-photo-card">
            <img
                src="assets/images/certificateaccred.jpeg"
                alt="Accreditation and policy review at Christian University College"
                class="accreditation-photo-image">
        </article>
        <article class="callout reveal-on-scroll accreditation-copy-card">
            <h2>Accreditation with the Government of Liberia</h2>
            <p>
                Christian University College works within the national higher education framework
                of the Republic of Liberia through the <strong>National Commission on Higher Education (NCHE)</strong>.
            </p>
            <p>
                As Liberia's statutory regulator for higher education, NCHE oversees institutional
                standards, academic quality, and compliance with approved policy requirements.
            </p>
            <ul class="clean-list">
                <li>Alignment with NCHE institutional and program standards</li>
                <li>Periodic quality checks and evidence-based compliance review</li>
                <li>Continuous improvement based on government quality expectations</li>
            </ul>
        </article>
    </div>
</section>

<section class="section accreditation-recognition-section">
    <div class="container split-layout">
        <article class="callout reveal-on-scroll">
            <h2>Institutional Recognition</h2>
            <p>
                CUC is dedicated to meeting national regulatory requirements and international best practices
                in teaching, curriculum design, and student support.
            </p>
            <p>
                Christian University College is accredited by the <strong>National Commission on Higher Education (NCHE), Liberia</strong>,
                the statutory higher education authority in Liberia.
            </p>
        </article>
        <article class="callout reveal-on-scroll">
            <h2>Quality Assurance</h2>
            <ul class="clean-list">
                <li>Regular program review and curriculum updates</li>
                <li>Faculty development and teaching evaluations</li>
                <li>Student feedback integration and service improvement</li>
                <li>Transparent governance and academic oversight</li>
            </ul>
        </article>
    </div>
</section>

<section class="section section-tinted accreditation-status-section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Accreditation Status</span>
            <h2>Regulatory Compliance in Liberia</h2>
            <p>CUC aligns institutional operations with the standards and expectations of higher education in Liberia.</p>
        </div>
        <div class="news-grid">
            <article class="news-card reveal-on-scroll">
                <h3>National Recognition</h3>
                <p>Programs and institutional operations are structured to comply with NCHE quality and governance expectations.</p>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>Academic Standards</h3>
                <p>Curriculum structure, assessment integrity, and faculty oversight follow approved academic quality frameworks.</p>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>Continuous Improvement</h3>
                <p>Review outcomes are used to improve teaching quality, student support, and institutional performance.</p>
            </article>
        </div>
    </div>
</section>

<section class="section accreditation-monitoring-section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Quality Monitoring Cycle</span>
            <h2>How Accreditation Standards Are Sustained</h2>
        </div>
        <div class="feature-grid">
            <article class="feature-card reveal-on-scroll">
                <h3>Policy Alignment</h3>
                <p>Institutional policies are aligned with national higher education regulations and quality benchmarks.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Program Evaluation</h3>
                <p>Academic programs undergo periodic internal review for relevance, outcomes, and delivery effectiveness.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Assessment Moderation</h3>
                <p>Assessment and grading processes are monitored for fairness, transparency, and consistency.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Stakeholder Feedback</h3>
                <p>Input from students, faculty, and partners informs targeted improvements and support actions.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Compliance Reporting</h3>
                <p>Academic and administrative units submit evidence-based reports to track quality indicators.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Action Planning</h3>
                <p>Quality findings are translated into improvement plans with timelines and accountability measures.</p>
            </article>
        </div>
    </div>
</section>

<section class="section section-tinted accreditation-docs-section">
    <div class="container split-layout">
        <article class="callout reveal-on-scroll">
            <h2>Accreditation and Quality Documents</h2>
            <p>Download the academic quality reference document for policy guidance and institutional standards.</p>
            <a href="assets/docs/academic-quality-assurance.pdf" class="btn btn-primary" download>Download Quality Assurance PDF</a>
        </article>
        <article class="callout reveal-on-scroll">
            <h2>Need Verification or Clarification?</h2>
            <p>For accreditation inquiries, policy interpretation, or institutional compliance details, contact Academic Affairs.</p>
            <p><strong>Email:</strong> academicaffairs@cuc.edu.lr</p>
            <p><strong>Phone:</strong> +231 88 1846 653</p>
        </article>
    </div>
</section>

<section class="cta">
    <div class="container cta-inner">
        <h2>Quality You Can Trust</h2>
        <p>CUC remains committed to accredited, transparent, and student-focused higher education in Liberia.</p>
        <div class="btn-row">
            <a href="academic-quality-assurance.php" class="btn btn-primary">Quality Assurance</a>
            <a href="contact.php" class="btn btn-light">Contact Office</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
