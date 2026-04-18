<?php
require_once __DIR__ . '/includes/news_storage.php';

$homeNewsPosts = array_slice(cuc_get_published_news(), 0, 3);

$pageTitle = 'Home';
$pageDescription = 'Christian University College homepage with programs, admissions, events, and university highlights.';
$bodyClass = 'home-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
    .home-page .page-hero {
        padding: 40px 0 20px;
    }

    .home-page .slide-content {
        min-height: 320px;
        max-width: 100%;
        padding: 32px 0 48px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .home-page .slide-content h1,
    .home-page .slide-content h2 {
        font-size: clamp(1.45rem, 5.4vw, 1.95rem);
        line-height: 1.28;
        margin: 8px 0;
    }

    .home-page .slide-content p {
        max-width: 100%;
        font-size: 0.96rem;
        line-height: 1.6;
        margin: 10px 0;
    }

    .home-page .hero-slider {
        min-height: 360px;
    }

    .home-page .btn-row {
        flex-direction: column;
        gap: 0.6rem;
    }

    .home-page .btn-row .btn {
        width: 100%;
    }

    .home-page .section {
        padding: 1.5rem 0;
    }

    .home-page .section-heading {
        margin-bottom: 1rem;
        text-align: left;
    }

    .home-page .section-heading h2 {
        font-size: clamp(1.3rem, 4vw, 1.6rem);
        margin-bottom: 8px;
    }

    .home-page .section-heading p {
        font-size: 0.9rem;
    }

    .home-page .stats-grid,
    .home-page .president-grid,
    .home-page .campus-life-grid,
    .home-page .why-video-grid,
    .home-page .split-layout,
    .home-page .partners-grid,
    .home-page .testimonial-slider,
    .home-page .news-grid,
    .home-page .downloads-grid {
        grid-template-columns: 1fr;
    }

    .home-page .stats-grid,
    .home-page .about-stats-grid,
    .home-page .campus-life-highlights,
    .home-page .why-points-grid,
    .home-page .feature-grid {
        grid-template-columns: 1fr;
    }

    .home-page .president-grid,
    .home-page .campus-life-grid,
    .home-page .why-video-grid,
    .home-page .partner-card--liberia {
        gap: 1rem;
    }

    .home-page .partner-brand {
        flex-direction: column;
        align-items: flex-start;
    }

    .home-page .partner-card--liberia {
        grid-template-columns: 1fr;
    }

    .home-page .partner-photo-left,
    .home-page .partner-logo {
        width: 100%;
        height: auto;
        max-width: 100%;
    }

    .home-page .campus-life-media img,
    .home-page .president-photo,
    .home-page .testimonial-avatar,
    .home-page .news-card-image {
        height: auto;
    }

    .home-page .testimonial-slider {
        display: grid;
        gap: 1rem;
        max-width: 100%;
        min-height: auto;
    }

    .home-page .testimonial-card {
        position: relative;
        inset: auto;
        opacity: 1;
        transform: none;
        pointer-events: auto;
    }

    .home-page .testimonial-dots {
        position: static;
        margin-top: 0.75rem;
        justify-content: center;
        transform: none;
    }

    .home-page .callout,
    .home-page .news-card,
    .home-page .feature-card,
    .home-page .program-item,
    .home-page .download-card,
    .home-page .partner-card,
    .home-page .campus-item,
    .home-page .why-point,
    .home-page .about-stat-card,
    .home-page .stat-card {
        padding: 1rem;
    }

    .home-page .testimonial-card {
        padding: 1rem;
        min-height: auto;
    }

    .home-page .testimonial-person {
        align-items: flex-start;
    }
}

@media (max-width: 480px) {
    .home-page .page-hero {
        padding: 34px 0 18px;
    }

    .home-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .home-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .home-page p,
    .home-page li {
        font-size: 0.92rem;
    }

    .home-page .slide-content {
        min-height: 280px;
        padding: 28px 0 44px;
    }

    .home-page .campus-life-media img {
        min-height: 240px;
    }

    .home-page .partner-logo {
        width: 44px;
        height: 44px;
    }

    .home-page .partner-photo-left {
        min-height: 180px;
        object-fit: cover;
    }

    .home-page .youtube-embed iframe {
        min-height: 220px;
    }

    .home-page .testimonial-card {
        min-height: auto;
    }

    .home-page .slider-dots {
        bottom: 18px;
        gap: 6px;
    }

    .home-page .slider-dots button {
        width: 9px;
        height: 9px;
    }
}
</style>

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
                <h4>Dear Incoming Students,</h4> <br>

It is with great joy that I welcome you to our Christian University College. You are beginning an important journey that will shape your academic, professional, and spiritual life.
            </p>
            <p>
            Our institution is more than a place of learning—it is a Christ-centered community committed to excellence, character development, and service. Here, you will grow not only in knowledge but also in faith, integrity, and leadership.
            </p>
            <p>
                I encourage you to embrace every opportunity—engage in your studies, participate in campus life, build meaningful relationships, and allow your faith to guide your path. Our faculty and staff are here to support and guide you every step of the way.
            </p>

            <p>
                Remember, you are here for a purpose. Let your education inspire you to serve others, make a positive impact, and honor God in all you do.
            </p>

            <p>Welcome to your new home. We are excited to walk this journey with you.</p>
            <p class="president-signature">
                <strong>Dr. Henry T. B. Mulbah</strong><br>
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

<section class="section section-tinted programs-section">
    <div class="container">
        <div class="split-layout">
            <article class="programs-intro reveal-on-scroll">
                <span class="eyebrow">Featured Schools</span>
                <h2>Find the Program That Fits Your Future</h2>
                <p>
                    We offer <strong>Diploma, Associate, and Bachelor</strong> programs. Our faculties provide stackable pathways to help you advance academically and professionally.
                </p>
                <a href="academics.php" class="btn btn-primary">View All Programs</a>
            </article>

            <div class="program-list">
                <article class="program-item reveal-on-scroll">
                    <h3>School of Business and Management</h3>
                    <p>
                        <strong>Diploma, Associate & Bachelor programs:</strong>
                        Accounting, Banking and Finance, Marketing, and Entrepreneurship.
                    </p>
                </article>
                <article class="program-item reveal-on-scroll">
                    <h3>School of Education and Theology</h3>
                    <p>
                        <strong>Diploma, Associate & Bachelor programs:</strong>
                        Teacher training, educational leadership, ministry, and biblical studies.
                    </p>
                </article>
                <article class="program-item reveal-on-scroll">
                    <h3>School of Science and Technology</h3>
                    <p>
                        <strong>Diploma, Associate & Bachelor programs:</strong>
                        Information systems, software fundamentals, and applied computing.
                    </p>
                </article>
            </div>
        </div>
    </div>
</section>

<section class="section global-partners-section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Global Partners</span>
            <h2>University Partners, International Affiliations, and Accreditation</h2>
            <p>
                CUC maintains strategic collaborations and recognition relationships with institutions
                and accreditation bodies across the world.
            </p>
        </div>

        <div class="partners-grid">
            <article class="partner-card">
                <div class="partner-brand">
                    <img src="assets/images/logo.jpg" alt="University partners" class="partner-logo">
                    <div>
                        <span class="partner-kicker">Academic Collaboration</span>
                        <h3>University Partners</h3>
                    </div>
                </div>
                <ul class="partner-list" aria-label="University Partners">
                    <li>Iowa University (USA)</li>
                    <li>Fort Hays State University (USA)</li>
                    <li>University of Albany (USA)</li>
                </ul>
            </article>

            <article class="partner-card">
                <div class="partner-brand">
                    <img src="assets/images/logo.jpg" alt="International affiliations" class="partner-logo">
                    <div>
                        <span class="partner-kicker">Global Network</span>
                        <h3>International Affiliations</h3>
                    </div>
                </div>
                <ul class="partner-list" aria-label="International Affiliations">
                    <li>India University</li>
                    <li>Korea University (affiliation)</li>
                    <li>UCIS University</li>
                    <li>Kanda University (Japan)</li>
                    <li>Pentecostal University of West Africa (Ghana)</li>
                    <li>Great Commission Bible College (Liberia &amp; USA)</li>
                </ul>
            </article>

            <article class="partner-card">
                <div class="partner-brand">
                    <img src="assets/images/logo.jpg" alt="Accreditation and recognition bodies" class="partner-logo">
                    <div>
                        <span class="partner-kicker">Quality Assurance</span>
                        <h3>Accreditation and Recognition Bodies</h3>
                    </div>
                </div>
                <p class="partner-note">CUC is recognized by the following international accreditation organizations:</p>
                <ul class="partner-list" aria-label="Accreditation and Recognition Bodies">
                    <li>IAO - International Accreditation Organization (USA)</li>
                    <li>EDU - Educational Commission Accreditation Standards (USA)</li>
                    <li>EAECHE - European Accreditation Equivalency Council for Higher Education (Europe)</li>
                    <li>ACEN - Accreditation Commission for Education in Nursing (USA)</li>
                    <li>NABH - National Accreditation Board for Hospitals &amp; Healthcare Providers (India)</li>
                    <li>QAHE - Quality Assurance in Higher Education (USA)</li>
                    <li>HLACT - International UAS</li>
                </ul>
            </article>

            <article class="partner-card partner-card--liberia">
                <img src="assets/images/logo.jpg" alt="CUC accreditation recognition in Liberia" class="partner-photo-left">
                <div>
                    <div class="partner-brand partner-brand--liberia">
                        <div>
                            <span class="partner-kicker">Liberia Government</span>
                            <h3>CUC Government Accreditation</h3>
                        </div>
                    </div>
                    <p class="partner-note">
                        Christian University College (CUC) is accredited by the Government of Liberia through the
                        National Commission on Higher Education (NCHE).
                    </p>
                    <ul class="partner-list" aria-label="Liberia Government Accreditation Details">
                        <li>Recognized by the National Commission on Higher Education (NCHE), Liberia</li>
                        <li>Authorized to operate as a higher education institution in Liberia</li>
                        <li>Committed to national academic quality and regulatory standards</li>
                    </ul>
                </div>
            </article>
        </div>

        <div class="partners-cta">
            <a href="contact.php" class="btn btn-primary">Partner With CUC</a>
            <a href="about.php" class="btn btn-light">Learn About CUC</a>
        </div>
    </div>
</section>

<section class="section section-tinted testimonial-section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Student Testimony</span>
            <h2>What Our Students Say About Life at CUC</h2>
            <p>Real voices from students who are growing in faith, leadership, and professional preparation.</p>
        </div>

        <div class="testimonial-slider" aria-label="Student testimonies" data-autoplay-ms="6000">
            <article class="testimonial-card is-active">
                <div class="testimonial-person">
                    <img class="testimonial-avatar" src="assets/images/slider1.jpeg" alt="Photo of Sarah K. Johnson">
                    <div class="testimonial-meta">
                        <strong>Sarah K. Johnson</strong>
                        <span>Public Administration, Level 300</span>
                    </div>
                </div>
                <p class="testimonial-quote">"CUC helped me become more confident as a student leader. I found mentors who challenged me academically and supported my personal growth."</p>
            </article>

            <article class="testimonial-card">
                <div class="testimonial-person">
                    <img class="testimonial-avatar" src="assets/images/slider2.jpeg" alt="Photo of Daniel T. Cooper">
                    <div class="testimonial-meta">
                        <strong>Daniel T. Cooper</strong>
                        <span>Business Administration, Level 400</span>
                    </div>
                </div>
                <p class="testimonial-quote">"The practical approach in our classes made learning relevant. I now feel prepared for internships and real career opportunities."</p>
            </article>

            <article class="testimonial-card">
                <div class="testimonial-person">
                    <img class="testimonial-avatar" src="assets/images/slider3.jpeg" alt="Photo of Mercy L. Brown">
                    <div class="testimonial-meta">
                        <strong>Mercy L. Brown</strong>
                        <span>Education and Theology, Level 200</span>
                    </div>
                </div>
                <p class="testimonial-quote">"Beyond academics, CUC gave me a strong community. Through clubs and chapel, I developed discipline, values, and purpose."</p>
            </article>

            <div class="testimonial-dots" role="tablist" aria-label="Select testimony"></div>
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
            <?php if (empty($homeNewsPosts)): ?>
                <article class="news-card">
                    <p class="meta"><?= htmlspecialchars(date('F Y'), ENT_QUOTES, 'UTF-8') ?></p>
                    <h3>Fresh updates will appear here</h3>
                    <p>The latest school updates from the News Admin panel will automatically show on this homepage section.</p>
                </article>
            <?php else: ?>
                <?php foreach ($homeNewsPosts as $post): ?>
                    <article class="news-card">
                        <?php if ((string)($post['image_path'] ?? '') !== ''): ?>
                            <img
                                class="news-card-image"
                                src="<?= htmlspecialchars((string)$post['image_path'], ENT_QUOTES, 'UTF-8') ?>"
                                alt="<?= htmlspecialchars((string)$post['title'], ENT_QUOTES, 'UTF-8') ?>">
                        <?php endif; ?>
                        <p class="meta">
                            <?= htmlspecialchars(date('F j, Y', strtotime((string)$post['publish_date'])), ENT_QUOTES, 'UTF-8') ?>
                        </p>
                        <h3><?= htmlspecialchars((string)$post['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <p><?= htmlspecialchars((string)$post['summary'], ENT_QUOTES, 'UTF-8') ?></p>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
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
                <a href="assets/docs/CHRISTIAN UNIVERSITY COLLEGE APPLICATION FORM.pdf" class="btn btn-primary" download>Download PDF</a>
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