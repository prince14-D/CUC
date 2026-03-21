<?php
$pageTitle = 'Home';
$pageDescription = 'Christian University College homepage with programs, admissions, events, and university highlights.';
include 'includes/header.php';
?>

<section class="hero-slider" aria-label="Featured university highlights">
    <article class="slide is-active" style="--bg: linear-gradient(115deg, rgba(140, 21, 21, 0.9), rgba(22, 28, 45, 0.9));">
        <div class="container slide-content">
            <span class="eyebrow">Admissions 2026</span>
            <h1>Learn with Purpose. Lead with Integrity.</h1>
            <p>
                Join a growing academic community where rigorous scholarship,
                Christian values, and practical training shape tomorrow's leaders.
            </p>
            <div class="btn-row">
                <a href="admissions.php" class="btn btn-primary">Apply Now</a>
                <a href="about.php" class="btn btn-light">Discover CUC</a>
            </div>
        </div>
    </article>

    <article class="slide" style="--bg: linear-gradient(120deg, rgba(44, 62, 80, 0.88), rgba(140, 21, 21, 0.85));">
        <div class="container slide-content">
            <span class="eyebrow">Academic Excellence</span>
            <h2>Programs Designed for Real-World Impact</h2>
            <p>
                From business and technology to public service and education,
                our courses are built for career readiness and community transformation.
            </p>
            <div class="btn-row">
                <a href="academics.php" class="btn btn-primary">Explore Programs</a>
                <a href="contact.php" class="btn btn-light">Schedule a Visit</a>
            </div>
        </div>
    </article>

    <article class="slide" style="--bg: linear-gradient(135deg, rgba(8, 20, 38, 0.9), rgba(109, 14, 14, 0.9));">
        <div class="container slide-content">
            <span class="eyebrow">Campus Life</span>
            <h2>A Vibrant Campus Rooted in Faith and Service</h2>
            <p>
                Student clubs, leadership development, and mentorship opportunities
                create a university experience that extends beyond the classroom.
            </p>
            <div class="btn-row">
                <a href="news.php" class="btn btn-primary">Read Campus Stories</a>
                <a href="contact.php" class="btn btn-light">Talk to Admissions</a>
            </div>
        </div>
    </article>

    <div class="slider-controls container" aria-hidden="true">
        <button class="slider-btn prev" aria-label="Previous slide">&#10094;</button>
        <button class="slider-btn next" aria-label="Next slide">&#10095;</button>
    </div>

    <div class="slider-dots" role="tablist" aria-label="Select slide"></div>
</section>

<section class="stats-band">
    <div class="container stats-grid">
        <div>
            <strong>40+</strong>
            <span>Programs and Certificates</span>
        </div>
        <div>
            <strong>3,500+</strong>
            <span>Students Enrolled</span>
        </div>
        <div>
            <strong>250+</strong>
            <span>Faculty and Staff</span>
        </div>
        <div>
            <strong>25</strong>
            <span>Partner Institutions</span>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Why CUC</span>
            <h2>Education That Blends Knowledge, Character, and Action</h2>
        </div>
        <div class="feature-grid">
            <article class="feature-card">
                <h3>Mission-Driven Learning</h3>
                <p>Academic programs shaped by ethics, service, and strong Christian values.</p>
            </article>
            <article class="feature-card">
                <h3>Experienced Faculty</h3>
                <p>Learn from lecturers and professionals with local and global expertise.</p>
            </article>
            <article class="feature-card">
                <h3>Career-Focused Curriculum</h3>
                <p>Gain practical skills through labs, projects, and internship pathways.</p>
            </article>
            <article class="feature-card">
                <h3>Inclusive Community</h3>
                <p>Students from diverse backgrounds thrive in a supportive campus environment.</p>
            </article>
        </div>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <div class="split-layout">
            <article>
                <span class="eyebrow">Featured Schools</span>
                <h2>Find the Program That Fits Your Future</h2>
                <p>
                    Our faculties offer stackable pathways from certificate to bachelor's degree,
                    helping students advance academically and professionally.
                </p>
                <a href="academics.php" class="btn btn-primary">View All Programs</a>
            </article>

            <div class="program-list">
                <div class="program-item">
                    <h3>School of Business and Management</h3>
                    <p>Accounting, Banking and Finance, Marketing, and Entrepreneurship.</p>
                </div>
                <div class="program-item">
                    <h3>School of Education and Theology</h3>
                    <p>Teacher training, educational leadership, ministry, and biblical studies.</p>
                </div>
                <div class="program-item">
                    <h3>School of Science and Technology</h3>
                    <p>Information systems, software fundamentals, and applied computing.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">News and Events</span>
            <h2>What's Happening at Christian University College</h2>
        </div>
        <div class="news-grid">
            <article class="news-card">
                <p class="meta">March 2026</p>
                <h3>Admissions Portal Opens for 2026 Intake</h3>
                <p>Prospective students can now begin applications for all undergraduate pathways.</p>
            </article>
            <article class="news-card">
                <p class="meta">February 2026</p>
                <h3>CUC Hosts National Youth Leadership Forum</h3>
                <p>Students engaged policy leaders, entrepreneurs, and educators in a two-day summit.</p>
            </article>
            <article class="news-card">
                <p class="meta">January 2026</p>
                <h3>New Digital Innovation Lab Commissioned</h3>
                <p>The lab expands hands-on technology learning and research opportunities.</p>
            </article>
        </div>
        <a href="news.php" class="text-link">Read more stories</a>
    </div>
</section>

<section class="cta">
    <div class="container cta-inner">
        <h2>Take the Next Step Toward Your Future</h2>
        <p>Applications are now open. Start your journey with Christian University College today.</p>
        <div class="btn-row">
            <a href="admissions.php" class="btn btn-primary">Begin Application</a>
            <a href="contact.php" class="btn btn-light">Speak with Admissions</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>