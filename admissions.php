<?php
$pageTitle = 'Admissions';
$pageDescription = 'Admissions requirements, tuition guidance, and application steps for Christian University College.';
$bodyClass = 'admissions-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
    .admissions-page .page-hero {
        padding: 40px 0 20px;
    }

    .admissions-page .section {
        padding: 1.5rem 0;
    }

    .admissions-page .section-heading {
        margin-bottom: 1rem;
        text-align: left;
    }

    .admissions-page .section-heading h2 {
        font-size: clamp(1.3rem, 4vw, 1.6rem);
        margin-bottom: 8px;
    }

    .admissions-page .section-heading p {
        font-size: 0.9rem;
    }

    .admissions-page .about-stats-grid,
    .admissions-page .split-layout,
    .admissions-page .feature-grid,
    .admissions-page .news-grid {
        grid-template-columns: 1fr;
    }

    .admissions-page .about-stat-card,
    .admissions-page .feature-card,
    .admissions-page .news-card,
    .admissions-page .callout {
        padding: 1rem;
    }

    .admissions-page .btn-row {
        flex-direction: column;
        gap: 0.6rem;
    }

    .admissions-page .btn-row .btn,
    .admissions-page .cta-inner .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .admissions-page .page-hero {
        padding: 34px 0 18px;
    }

    .admissions-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .admissions-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .admissions-page p,
    .admissions-page li {
        font-size: 0.92rem;
    }

    .admissions-page .about-stat-card strong {
        font-size: clamp(1.3rem, 7vw, 1.8rem);
    }

    .admissions-page .feature-card h3,
    .admissions-page .news-card h3,
    .admissions-page .callout h2,
    .admissions-page .callout h3,
    .admissions-page .cta-inner h2 {
        font-size: 1rem;
    }
}
</style>

<section
    class="page-hero"
    style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.9), rgba(140, 21, 21, 0.82)), url('assets/images/slider1.jpeg') center/cover no-repeat;">
    <div class="container">
        <span class="eyebrow">Admissions</span>
        <h1>Begin Your Journey at Christian University College</h1>
        <p>
            Applications are open for diploma, associate, and bachelor pathways.
            Our admissions team is ready to help you at every step.
        </p>
    </div>
</section>

<section class="section about-highlight-band">
    <div class="container about-stats-grid">
        <article class="about-stat-card">
            <strong>40+</strong>
            <span>Programs and Certificates</span>
        </article>
        <article class="about-stat-card">
            <strong>6</strong>
            <span>Academic Colleges</span>
        </article>
        <article class="about-stat-card">
            <strong>3,500+</strong>
            <span>Students Enrolled</span>
        </article>
        <article class="about-stat-card">
            <strong>250+</strong>
            <span>Faculty and Staff</span>
        </article>
    </div>
</section>

<section class="section">
    <div class="container split-layout">
        <article class="callout reveal-on-scroll">
            <h2>Application Process</h2>
            <ol class="clean-list ordered">
                <li>Complete and submit the online or in-person application form.</li>
                <li>Submit all required supporting documents.</li>
                <li>Receive admissions review decision from the Registrar.</li>
                <li>Accept offer and complete registration with payment plan.</li>
            </ol>
        </article>
        <article class="callout reveal-on-scroll">
            <h3>Application Timeline</h3>
            <p><strong>Early Review:</strong> January to March</p>
            <p><strong>Main Intake:</strong> April to August</p>
            <p><strong>Late Admissions:</strong> Subject to available spaces</p>
            <div class="btn-row">
                <a href="https://portal.yourschool.com" class="btn btn-primary">Start Online Application</a>
                <a href="admission-interest.php" class="btn btn-light">Register Interest</a>
            </div>
        </article>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Requirements</span>
            <h2>Documents Needed</h2>
            <p>Prepare the following documents before submitting your application to avoid delays in processing.</p>
        </div>
        <div class="feature-grid">
            <article class="feature-card reveal-on-scroll"><h3>WAEC Certificate</h3><p>Official and verifiable senior secondary exam record.</p></article>
            <article class="feature-card reveal-on-scroll"><h3>Academic Transcript</h3><p>Previous institution transcript or high school record.</p></article>
            <article class="feature-card reveal-on-scroll"><h3>Medical Report</h3><p>Recent medical clearance from accredited health provider.</p></article>
            <article class="feature-card reveal-on-scroll"><h3>Passport Photos</h3><p>Two recent passport-size photographs.</p></article>
            <article class="feature-card reveal-on-scroll"><h3>Birth Certificate or ID</h3><p>National identification or birth record for identity verification.</p></article>
            <article class="feature-card reveal-on-scroll"><h3>Recommendation (Optional)</h3><p>Academic or character recommendation to strengthen your application profile.</p></article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Eligibility and Placement</span>
            <h2>Admission Pathways</h2>
        </div>
        <div class="news-grid">
            <article class="news-card reveal-on-scroll">
                <h3>First-Year Applicants</h3>
                <p>Students applying after secondary school are admitted based on results, documentation, and program fit.</p>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>Transfer Students</h3>
                <p>Applicants with prior tertiary credits may be considered for transfer after transcript evaluation.</p>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>Mature Entry</h3>
                <p>Qualified applicants with professional experience may be considered through approved mature-entry criteria.</p>
            </article>
        </div>
    </div>
</section>

<section class="section section-tinted">
    <div class="container split-layout">
        <article class="callout reveal-on-scroll">
            <h2>Tuition and Aid</h2>
            <p>
                CUC provides flexible tuition payment structures and a limited number
                of merit and need-informed scholarships each year.
            </p>
            <a href="contact.php" class="btn btn-primary">Speak to Financial Aid</a>
        </article>
        <article class="callout reveal-on-scroll">
            <h2>Admissions Resource Downloads</h2>
            <p>Download key resources to plan your program and registration journey effectively.</p>
            <div class="btn-row">
                <a href="assets/docs/program-catalog.pdf" class="btn btn-primary" download>Program Catalog (PDF)</a>
                <a href="assets/docs/student-handbook.pdf" class="btn btn-light" download>Student Handbook (PDF)</a>
            </div>
        </article>
    </div>
</section>

<section class="section">
    <div class="container split-layout">
        <article class="callout reveal-on-scroll">
            <h2>Need Help?</h2>
            <p>Our admissions team is available to guide you through application, documentation, and next steps.</p>
            <p><strong>Email:</strong> admissions@cuc.edu.lr</p>
            <p><strong>Phone:</strong> +231 88 1846 653</p>
        </article>
        <article class="callout reveal-on-scroll">
            <h2>Visit Campus Before Applying</h2>
            <p>Schedule a campus visit to meet advisors, explore learning spaces, and choose your best-fit pathway.</p>
            <a href="contact.php" class="btn btn-primary">Book a Campus Visit</a>
        </article>
    </div>
</section>

<section class="cta">
    <div class="container cta-inner">
        <h2>Ready to Apply to Christian University College?</h2>
        <p>Start your admission process today and take the next step toward your academic future.</p>
        <div class="btn-row">
            <a href="https://portal.yourschool.com" class="btn btn-primary">Apply Online</a>
            <a href="admission-interest.php" class="btn btn-light">Admission Interest Form</a>
            <a href="contact.php" class="btn btn-light">Talk to Admissions</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
