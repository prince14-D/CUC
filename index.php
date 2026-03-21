<?php
$pageTitle = 'Home';
$pageDescription = 'Christian University College homepage with programs, admissions, events, and university highlights.';
include 'includes/header.php';
?>

<section class="hero-slider" aria-label="Featured university highlights" data-autoplay-ms="5000">
    <article class="slide is-active">
        <img class="slide-media" src="assets/images/slider1.jpeg" alt="Christian University College campus highlight">
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

    <article class="slide">
        <img class="slide-media" src="assets/images/slider2.jpeg" alt="Academic activity at Christian University College">
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

    <article class="slide">
        <img class="slide-media" src="assets/images/slider3.jpeg" alt="Students enjoying campus life at Christian University College">
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

    <div class="slider-dots" role="tablist" aria-label="Select slide"></div>
</section>

<section class="stats-band">
    <div class="container stats-grid">
        <div class="stat-card">
            <strong class="stat-number" data-target="40" data-suffix="+">0</strong>
            <span>Programs and Certificates</span>
        </div>
        <div class="stat-card">
            <strong class="stat-number" data-target="3500" data-suffix="+">0</strong>
            <span>Students Enrolled</span>
        </div>
        <div class="stat-card">
            <strong class="stat-number" data-target="250" data-suffix="+">0</strong>
            <span>Faculty and Staff</span>
        </div>
        <div class="stat-card">
            <strong class="stat-number" data-target="25">0</strong>
            <span>Global Partner Institutions</span>
        </div>
    </div>
</section>

<section class="section president-section">
    <div class="container president-grid">
        <div class="president-photo-wrap">
            <img src="assets/images/President1.jpeg" alt="Portrait of the President of Christian University College" class="president-photo">
        </div>
        <article class="president-message">
            <span class="eyebrow">President's Message</span>
            <h2>Welcome to Christian University College</h2>
            <p>
                Christian University College is committed to raising a generation of graduates
                who combine academic excellence with integrity, compassion, and service.
                Our mission is not only to educate minds, but also to shape character and purpose.
            </p>
            <p>
                As President, I invite you to become part of a university community where faith,
                leadership, and innovation work together to transform lives and communities.
                We look forward to walking this journey with you.
            </p>
            <p class="president-signature">
                <strong>Rev. Dr. Daniel K. Mensah</strong><br>
                President, Christian University College
            </p>
        </article>
    </div>
</section>

<section class="section section-tinted campus-life-section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Campus Life</span>
            <h2>Experience a Vibrant and Supportive Student Community</h2>
        </div>

        <div class="campus-life-grid">
            <article class="campus-life-media">
                <img src="assets/images/slider1.jpeg" alt="Students participating in campus life activities at Christian University College">
            </article>

            <article class="campus-life-content">
                <p>
                    Life at Christian University College extends beyond lectures. Students build
                    leadership, confidence, and lifelong friendships through clubs, worship,
                    sports, and community outreach projects.
                </p>

                <div class="campus-life-highlights">
                    <div class="campus-item">
                        <h3>Student Clubs and Societies</h3>
                        <p>Join academic, cultural, entrepreneurship, and service-focused organizations.</p>
                    </div>
                    <div class="campus-item">
                        <h3>Sports and Wellness</h3>
                        <p>Engage in football, volleyball, fitness activities, and wellness programs.</p>
                    </div>
                    <div class="campus-item">
                        <h3>Spiritual Growth</h3>
                        <p>Participate in weekly chapel, mentorship circles, and faith-based initiatives.</p>
                    </div>
                    <div class="campus-item">
                        <h3>Community Engagement</h3>
                        <p>Contribute through outreach projects and practical service learning opportunities.</p>
                    </div>
                </div>

                <div class="btn-row">
                    <a href="news.php" class="btn btn-primary">See Campus Events</a>
                    <a href="contact.php" class="btn btn-light">Visit Our Campus</a>
                </div>
            </article>
        </div>
    </div>
</section>

<section class="section why-video-section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Why Students Choose CUC</span>
            <h2>Explore Our Campus Story and Student Experience</h2>
        </div>

        <div class="why-video-grid">
            <article class="youtube-card">
                <h3>Watch CUC on YouTube</h3>
                <div class="youtube-embed">
                    <iframe
                        src="https://www.youtube.com/embed/ysz5S6PUM-U"
                        title="Christian University College YouTube Video"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen>
                    </iframe>
                </div>
                <p class="video-note">You can replace this link with your official CUC YouTube video anytime.</p>
            </article>

            <article class="why-choose-card">
                <h3>Why Students Choose CUC</h3>
                <div class="why-points-grid">
                    <div class="why-point">
                        <h4>Faith and Character</h4>
                        <p>Students grow in spiritual values, ethics, and responsible leadership.</p>
                    </div>
                    <div class="why-point">
                        <h4>Career-Ready Programs</h4>
                        <p>Programs are practical, market-aligned, and focused on employability.</p>
                    </div>
                    <div class="why-point">
                        <h4>Supportive Lecturers</h4>
                        <p>Faculty provide mentoring, guidance, and personalized academic support.</p>
                    </div>
                    <div class="why-point">
                        <h4>Vibrant Campus Community</h4>
                        <p>Students benefit from clubs, outreach, sports, and leadership opportunities.</p>
                    </div>
                </div>
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

<section class="section global-partners-section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Global Partners</span>
            <h2>Collaborating with Institutions Around the World</h2>
            <p>
                CUC works with international universities, research centers, and professional bodies
                to expand learning opportunities, joint projects, and global exposure for students.
            </p>
        </div>

        <div class="partners-grid">
            <article class="partner-card">
                <div class="partner-brand">
                    <img src="assets/images/logo.jpg" alt="Westbridge University logo" class="partner-logo">
                    <h3>Westbridge University, UK</h3>
                </div>
                <p>Faculty exchange and curriculum development in business and public policy.</p>
            </article>
            <article class="partner-card">
                <div class="partner-brand">
                    <img src="assets/images/logo.jpg" alt="Nordic Institute of Technology logo" class="partner-logo">
                    <h3>Nordic Institute of Technology, Sweden</h3>
                </div>
                <p>Joint digital innovation projects and practical technology bootcamps.</p>
            </article>
            <article class="partner-card">
                <div class="partner-brand">
                    <img src="assets/images/logo.jpg" alt="Faith and Leadership Consortium logo" class="partner-logo">
                    <h3>Faith and Leadership Consortium, USA</h3>
                </div>
                <p>Leadership fellowships and ethics-focused student mentorship initiatives.</p>
            </article>
            <article class="partner-card">
                <div class="partner-brand">
                    <img src="assets/images/logo.jpg" alt="Pan-African Higher Education Network logo" class="partner-logo">
                    <h3>Pan-African Higher Education Network</h3>
                </div>
                <p>Regional research collaboration, conferences, and student mobility programs.</p>
            </article>
        </div>

        <div class="partners-cta">
            <a href="contact.php" class="btn btn-primary">Become a Partner</a>
            <a href="about.php" class="btn btn-light">Learn About CUC</a>
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

<section class="section section-tinted downloads-section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Downloads</span>
            <h2>Admission and Event Information (PDF)</h2>
            <p>Download official documents for new admissions and upcoming university events.</p>
        </div>

        <div class="downloads-grid">
            <article class="download-card">
                <h3>New Admission Information</h3>
                <p>Get admission requirements, application steps, tuition guidance, and important contacts.</p>
                <a href="assets/docs/new-admission-info.pdf" class="btn btn-primary" download>Download PDF</a>
            </article>

            <article class="download-card">
                <h3>Calendar of Events</h3>
                <p>Access the latest schedule for orientation, semester activities, ceremonies, and major events.</p>
                <a href="assets/docs/calendar-of-events.pdf" class="btn btn-primary" download>Download PDF</a>
            </article>
        </div>
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