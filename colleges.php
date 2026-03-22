<?php
$pageTitle = 'Colleges';
$pageDescription = 'Explore the colleges within Christian University College.';
include 'includes/header.php';
?>

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
            <strong>3</strong>
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
                <h3>College of Business and Management</h3>
                <p>Accounting, Finance, Marketing, and entrepreneurship-driven programs that prepare graduates for the private and public sectors.</p>
                <ul class="clean-list">
                    <li>Accounting and Finance</li>
                    <li>Marketing and Entrepreneurship</li>
                    <li>Business Leadership and Management</li>
                </ul>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>College of Education and Theology</h3>
                <p>Teacher education, ministry studies, and values-based leadership formation for impact in schools, churches, and communities.</p>
                <ul class="clean-list">
                    <li>Teacher Education</li>
                    <li>Educational Leadership</li>
                    <li>Theology and Ministry Studies</li>
                </ul>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>College of Science and Technology</h3>
                <p>Applied computing, digital systems, and innovation-oriented technical education designed for modern career pathways.</p>
                <ul class="clean-list">
                    <li>Information Systems and Computing</li>
                    <li>Digital Innovation and Technology</li>
                    <li>Practical Lab-Based Learning</li>
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
