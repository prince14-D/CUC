<?php
$pageTitle = 'Faculty and Staff';
$pageDescription = 'Meet the faculty and staff of Christian University College.';
$bodyClass = 'faculty-staff-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
    .faculty-staff-page .page-hero {
        padding: 40px 0 20px;
    }

    .faculty-staff-page .section {
        padding: 1.5rem 0;
    }

    .faculty-staff-page .section-heading {
        margin-bottom: 1rem;
        text-align: left;
    }

    .faculty-staff-page .section-heading h2 {
        font-size: clamp(1.3rem, 4vw, 1.6rem);
        margin-bottom: 8px;
    }

    .faculty-staff-page .section-heading p {
        font-size: 0.9rem;
    }

    .faculty-staff-page .about-stats-grid,
    .faculty-staff-page .news-grid,
    .faculty-staff-page .feature-grid,
    .faculty-staff-page .split-layout,
    .faculty-staff-page .department-photo-grid {
        grid-template-columns: 1fr;
    }

    .faculty-staff-page .about-stat-card,
    .faculty-staff-page .news-card,
    .faculty-staff-page .feature-card,
    .faculty-staff-page .callout,
    .faculty-staff-page .department-photo-card {
        padding: 1rem;
    }

    .faculty-staff-page .department-photo-image {
        width: 100%;
        height: auto;
        aspect-ratio: 4 / 3;
        object-fit: cover;
    }

    .faculty-staff-page .btn-row {
        flex-direction: column;
        gap: 0.6rem;
    }

    .faculty-staff-page .btn-row .btn,
    .faculty-staff-page .callout .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .faculty-staff-page .page-hero {
        padding: 34px 0 18px;
    }

    .faculty-staff-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .faculty-staff-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .faculty-staff-page p,
    .faculty-staff-page li {
        font-size: 0.92rem;
    }

    .faculty-staff-page .about-stat-card strong,
    .faculty-staff-page .stat-number {
        font-size: clamp(1.3rem, 7vw, 1.8rem);
    }

    .faculty-staff-page .news-card h3,
    .faculty-staff-page .feature-card h3,
    .faculty-staff-page .callout h2,
    .faculty-staff-page .department-photo-card h3,
    .faculty-staff-page .cta-inner h2 {
        font-size: 1rem;
    }
}
</style>

<section
    class="page-hero"
    style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.9), rgba(140, 21, 21, 0.82)), url('assets/images/slider2.jpeg') center/cover no-repeat;">
    <div class="container">
        <span class="eyebrow">Faculty and Staff</span>
        <h1>Dedicated Professionals Serving Learning and Growth</h1>
        <p>Our faculty and staff provide mentorship, expertise, and support to help students thrive academically and personally.</p>
    </div>
</section>

<section class="section about-highlight-band">
    <div class="container about-stats-grid">
        <article class="about-stat-card">
            <strong class="stat-number" data-target="250" data-suffix="+">250+</strong>
            <span>Faculty and Staff</span>
        </article>
        <article class="about-stat-card">
            <strong class="stat-number" data-target="6">6</strong>
            <span>Academic Colleges</span>
        </article>
        <article class="about-stat-card">
            <strong class="stat-number" data-target="40" data-suffix="+">40+</strong>
            <span>Programs Supported</span>
        </article>
        <article class="about-stat-card">
            <strong class="stat-number" data-target="3500" data-suffix="+">3,500+</strong>
            <span>Students Served</span>
        </article>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Team Structure</span>
            <h2>Who Supports the CUC Learning Experience</h2>
            <p>Our people work together across academics, administration, and student services to create a high-impact campus environment.</p>
        </div>
        <div class="news-grid">
            <article class="news-card reveal-on-scroll">
                <h3>Academic Faculty</h3>
                <p>Lecturers and researchers with practical and scholarly experience across key disciplines.</p>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>Administrative Team</h3>
                <p>Offices that coordinate admissions, records, finance, student support, and campus operations.</p>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>Student Services</h3>
                <p>Advising, counseling, mentorship, and career guidance throughout your university journey.</p>
            </article>
        </div>
    </div>
</section>

<section class="section section-tinted">
    <div class="container split-layout">
        <article class="callout reveal-on-scroll">
            <h2>Academic Leadership and Faculty Roles</h2>
            <ul class="clean-list">
                <li>Dean-level coordination for curriculum quality and delivery</li>
                <li>Department heads guiding teaching, mentoring, and outcomes</li>
                <li>Full-time and adjunct faculty with professional expertise</li>
                <li>Research and project supervision across programs</li>
            </ul>
        </article>
        <article class="callout reveal-on-scroll">
            <h2>Professional and Administrative Support</h2>
            <p>
                Administrative staff ensure that admissions, registration, records, scheduling,
                and financial services run efficiently to support both students and faculty.
            </p>
            <p>
                Their work helps sustain smooth academic operations and reliable student service delivery.
            </p>
        </article>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Faculty Focus Areas</span>
            <h2>Academic Expertise Across Colleges</h2>
        </div>
        <div class="feature-grid">
            <article class="feature-card reveal-on-scroll">
                <h3>Business and Management Faculty</h3>
                <p>Experts in accounting, entrepreneurship, finance, and strategic management.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Education and Theology Faculty</h3>
                <p>Educators and ministry leaders focused on pedagogy, ethics, and leadership formation.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Science and Technology Faculty</h3>
                <p>Instructors in computing, digital systems, and applied innovation learning pathways.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Academic Advising Teams</h3>
                <p>Faculty advisors support course planning, progression, and student academic decision-making.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Research and Project Mentors</h3>
                <p>Supervisors guiding student research, capstone work, and practical industry-linked projects.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Assessment and Quality Moderators</h3>
                <p>Teams ensuring fairness, integrity, and consistency in student assessment processes.</p>
            </article>
        </div>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Department Photos</span>
            <h2>Faculty and Staff by Department</h2>
            <p>Meet representative faculty and staff teams across key departments. You can replace these with official department photos anytime.</p>
        </div>
        <div class="department-photo-grid">
            <article class="department-photo-card reveal-on-scroll">
                <img src="assets/images/President1.jpeg" alt="Dr. James Whitmore, Business and Management" class="department-photo-image">
                <h3>Dr. James Whitmore</h3>
                <p class="faculty-degree">Ph.D. in Business Administration</p>
                <p class="faculty-department">Business and Management</p>
            </article>
            <article class="department-photo-card reveal-on-scroll">
                <img src="assets/images/President2.jpeg" alt="Rev. Dr. Mary Koroma, Education and Theology" class="department-photo-image">
                <h3>Rev. Dr. Mary Koroma</h3>
                <p class="faculty-degree">Ph.D. in Theology and Education</p>
                <p class="faculty-department">Education and Theology</p>
            </article>
            <article class="department-photo-card reveal-on-scroll">
                <img src="assets/images/slider1.jpeg" alt="Dr. Ibrahim Conteh, Science and Technology" class="department-photo-image">
                <h3>Dr. Ibrahim Conteh</h3>
                <p class="faculty-degree">M.Sc. in Computer Science</p>
                <p class="faculty-department">Science and Technology</p>
            </article>
            <article class="department-photo-card reveal-on-scroll">
                <img src="assets/images/slider2.jpeg" alt="Ms. Ama Johnson, Admissions and Records" class="department-photo-image">
                <h3>Ms. Ama Johnson</h3>
                <p class="faculty-degree">B.A. in Education Administration</p>
                <p class="faculty-department">Admissions and Records</p>
            </article>
            <article class="department-photo-card reveal-on-scroll">
                <img src="assets/images/slider3.jpeg" alt="Dr. Samuel Gborie, Dean of Student Affairs" class="department-photo-image">
                <h3>Dr. Samuel Gborie</h3>
                <p class="faculty-degree">M.A. in Student Affairs and Development</p>
                <p class="faculty-department">Dean of Student Affairs</p>
            </article>
            <article class="department-photo-card reveal-on-scroll">
                <img src="assets/images/logo.jpg" alt="Dr. Patricia Thompson, Academic Affairs" class="department-photo-image">
                <h3>Dr. Patricia Thompson</h3>
                <p class="faculty-degree">Ph.D. in Higher Education Administration</p>
                <p class="faculty-department">Academic Affairs</p>
            </article>
        </div>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Student Support Units</span>
            <h2>Offices Students Interact With Most</h2>
        </div>
        <div class="news-grid">
            <article class="news-card reveal-on-scroll">
                <h3>Admissions and Records</h3>
                <p>Handles entry processing, registration records, and official student documentation.</p>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>Dean of Student Affairs</h3>
                <p>Supports student welfare, leadership development, and campus conduct guidance.</p>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>Academic Affairs</h3>
                <p>Coordinates standards, course quality, and academic policy implementation.</p>
            </article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container split-layout">
        <article class="callout reveal-on-scroll">
            <h2>Faculty Development and Growth</h2>
            <p>
                CUC invests in continuous professional development through training,
                quality workshops, and collaborative peer-learning opportunities.
            </p>
            <p>
                This ensures faculty and staff remain current, effective, and student-centered in their work.
            </p>
        </article>
        <article class="callout reveal-on-scroll">
            <h2>Connect with Faculty and Staff Offices</h2>
            <p>For office-specific inquiries, guidance, or appointments, contact the university support teams.</p>
            <p><strong>Email:</strong> admissions@cuc.edu.lr</p>
            <p><strong>Phone:</strong> +231 88 1846 653</p>
            <a href="contact.php" class="btn btn-primary">Contact Our Team</a>
        </article>
    </div>
</section>

<section class="cta">
    <div class="container cta-inner">
        <h2>Learn from Faculty Committed to Your Success</h2>
        <p>Join a supportive academic community where experienced educators and staff help you grow with confidence.</p>
        <div class="btn-row">
            <a href="academics.php" class="btn btn-primary">Explore Programs</a>
            <a href="admissions.php" class="btn btn-light">Apply Now</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
