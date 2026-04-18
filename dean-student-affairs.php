<?php
$pageTitle = 'Department Deans';
$pageDescription = 'Office of Department Deans at Christian University College.';
$bodyClass = 'dean-student-affairs-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
    .dean-student-affairs-page .page-hero {
        padding: 40px 0 20px;
    }

    .dean-student-affairs-page .section {
        padding: 1.5rem 0;
    }

    .dean-student-affairs-page .section-heading {
        margin-bottom: 1rem;
        text-align: left;
    }

    .dean-student-affairs-page .section-heading h2 {
        font-size: clamp(1.3rem, 4vw, 1.6rem);
        margin-bottom: 8px;
    }

    .dean-student-affairs-page .section-heading p {
        font-size: 0.9rem;
    }

    .dean-student-affairs-page .split-layout,
    .dean-student-affairs-page .feature-grid,
    .dean-student-affairs-page .dean-profile-grid {
        grid-template-columns: 1fr;
    }

    .dean-student-affairs-page .callout,
    .dean-student-affairs-page .feature-card,
    .dean-student-affairs-page .dean-profile-card {
        padding: 1rem;
    }

    .dean-student-affairs-page .dean-profile-card {
        width: 100%;
    }

    .dean-student-affairs-page .dean-profile-image {
        width: 100%;
        min-height: 260px;
        height: auto;
    }

    .dean-student-affairs-page .btn-row {
        flex-direction: column;
        gap: 0.6rem;
    }

    .dean-student-affairs-page .btn-row .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .dean-student-affairs-page .page-hero {
        padding: 34px 0 18px;
    }

    .dean-student-affairs-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .dean-student-affairs-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .dean-student-affairs-page p,
    .dean-student-affairs-page li {
        font-size: 0.92rem;
    }

    .dean-student-affairs-page .dean-role-badge {
        font-size: 0.7rem;
    }

    .dean-student-affairs-page .dean-profile-image {
        min-height: 220px;
    }

    .dean-student-affairs-page .feature-card h3,
    .dean-student-affairs-page .callout h2,
    .dean-student-affairs-page .dean-profile-card h3 {
        font-size: 1rem;
    }
}
</style>

<section
    class="page-hero"
    style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.9), rgba(140, 21, 21, 0.82)), url('assets/images/slider3.jpeg') center/cover no-repeat;">
    <div class="container">
        <span class="eyebrow">Office of Department Deans</span>
        <h1>Academic Leadership for Health Sciences and Education</h1>
        <p>The Office of Department Deans provides strategic academic leadership, faculty guidance, and student-centered oversight across key departments.</p>
    </div>
</section>

<section class="section">
    <div class="container split-layout">
        <article class="callout">
            <h2>Dean Office Responsibilities</h2>
            <ul class="clean-list">
                <li>Academic planning and department quality assurance</li>
                <li>Faculty supervision, mentoring, and performance support</li>
                <li>Curriculum implementation and student outcome monitoring</li>
                <li>Department coordination with university leadership</li>
            </ul>
        </article>
        <article class="callout">
            <h2>Dean Office Contact</h2>
            <p>For department-level academic guidance, faculty coordination, and student support concerns, contact the dean office directly.</p>
            <p><strong>Email:</strong> deanoffice@cuc.edu.lr</p>
            <p><strong>Phone:</strong> +231 88 1846 653</p>
        </article>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Department Deans</span>
            <h2>Meet the Two Deans</h2>
            <p>Christian University College has two deans serving the Health Sciences and Education departments.</p>
        </div>
        <div class="department-photo-grid dean-profile-grid">
            <article class="department-photo-card dean-profile-card reveal-on-scroll">
                <img src="assets/images/Mark J. Zoegar.jpeg" alt="Portrait of Mark J. Zoegar, Dean for the Health Science Department" class="department-photo-image dean-profile-image">
                <p class="dean-role-badge">Health Science Department</p>
                <h3>Mark J. Zoegar</h3>
                <p class="faculty-degree">Dean</p>
                <p>Leads academic quality in health sciences programs, supports faculty in practical training delivery, and strengthens student readiness for healthcare service.</p>
                <a href="mailto:mark.zoegar@cuc.edu.lr" class="dean-email-link">mark.zoegar@cuc.edu.lr</a>
            </article>
            <article class="department-photo-card dean-profile-card reveal-on-scroll">
                <img src="assets/images/Benjamin V. Rivercess.jpeg" alt="Portrait of Benjamin V. Rivercess, Dean for the Education Department" class="department-photo-image dean-profile-image">
                <p class="dean-role-badge">Education Department</p>
                <h3>Benjamin V. Rivercess</h3>
                <p class="faculty-degree">Dean</p>
                <p>Oversees curriculum quality, teacher training standards, and faculty development to prepare graduates for effective leadership in education.</p>
                <a href="mailto:benjamin.rivercess@cuc.edu.lr" class="dean-email-link">benjamin.rivercess@cuc.edu.lr</a>
            </article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Role Highlights</span>
            <h2>How the Two Deans Support Students and Faculty</h2>
            <p>
                Each dean leads within a specialized academic field while working together to improve
                teaching quality, student success, and departmental outcomes.
            </p>
            <a href="assets/docs/student-handbook.pdf" class="btn btn-primary" download>Download Student Guide (PDF)</a>
        </div>
        <div class="feature-grid">
            <article class="feature-card">
                <h3>Health Science Department Dean Role</h3>
                <p>Coordinates lab and clinical expectations, ensures program relevance, and aligns student preparation with healthcare sector standards.</p>
            </article>
            <article class="feature-card">
                <h3>Education Department Dean Role</h3>
                <p>Guides teacher education quality, strengthens instructional practice, and supports future educators with practical and ethical leadership skills.</p>
            </article>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
