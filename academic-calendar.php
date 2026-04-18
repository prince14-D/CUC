<?php
$pageTitle = 'Academic Calendar';
$pageDescription = 'Academic calendar and key dates at Christian University College.';
$bodyClass = 'academic-calendar-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
    .academic-calendar-page .page-hero {
        padding: 40px 0 20px;
    }

    .academic-calendar-page .section {
        padding: 1.5rem 0;
    }

    .academic-calendar-page .section-heading {
        margin-bottom: 1rem;
        text-align: left;
    }

    .academic-calendar-page .section-heading h2 {
        font-size: clamp(1.3rem, 4vw, 1.6rem);
        margin-bottom: 8px;
    }

    .academic-calendar-page .section-heading p {
        font-size: 0.9rem;
    }

    .academic-calendar-page .about-stats-grid,
    .academic-calendar-page .news-grid,
    .academic-calendar-page .split-layout {
        grid-template-columns: 1fr;
    }

    .academic-calendar-page .about-stat-card,
    .academic-calendar-page .news-card,
    .academic-calendar-page .callout,
    .academic-calendar-page .event-list article {
        padding: 1rem;
    }

    .academic-calendar-page .btn-row {
        flex-direction: column;
        gap: 0.6rem;
    }

    .academic-calendar-page .btn-row .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .academic-calendar-page .page-hero {
        padding: 34px 0 18px;
    }

    .academic-calendar-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .academic-calendar-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .academic-calendar-page p,
    .academic-calendar-page li {
        font-size: 0.92rem;
    }

    .academic-calendar-page .about-stat-card strong {
        font-size: clamp(1.3rem, 7vw, 1.8rem);
    }

    .academic-calendar-page .event-list article h3,
    .academic-calendar-page .news-card h3,
    .academic-calendar-page .callout h2 {
        font-size: 1rem;
    }
}
</style>

<section
    class="page-hero"
    style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.9), rgba(140, 21, 21, 0.82)), url('assets/images/slider2.jpeg') center/cover no-repeat;">
    <div class="container">
        <span class="eyebrow">Academic Calendar</span>
        <h1>Important Academic Dates and Sessions</h1>
        <p>Plan your academic year with key semester timelines, registration windows, assessment periods, and major university events.</p>
    </div>
</section>

<section class="section about-highlight-band">
    <div class="container about-stats-grid">
        <article class="about-stat-card">
            <strong>2</strong>
            <span>Regular Semesters</span>
        </article>
        <article class="about-stat-card">
            <strong>1</strong>
            <span>Summer Session</span>
        </article>
        <article class="about-stat-card">
            <strong>4+</strong>
            <span>Major Academic Milestones</span>
        </article>
        <article class="about-stat-card">
            <strong>100%</strong>
            <span>Calendar Compliance Focus</span>
        </article>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Session Overview</span>
            <h2>Annual Academic Structure</h2>
            <p>CUC follows a structured calendar to ensure smooth progression, timely assessments, and coordinated student support.</p>
        </div>
        <div class="event-list">
            <article class="reveal-on-scroll">
                <h3>Semester One</h3>
                <p><strong>September - January:</strong> Registration, lectures, mid-semester assessments, final examinations.</p>
            </article>
            <article class="reveal-on-scroll">
                <h3>Semester Two</h3>
                <p><strong>February - June:</strong> Course registration, full instruction period, revision, final examinations.</p>
            </article>
            <article class="reveal-on-scroll">
                <h3>Summer Session</h3>
                <p><strong>July - August:</strong> Intensive courses, carry-over classes, and special academic support.</p>
            </article>
            <article class="reveal-on-scroll">
                <h3>Academic Milestones</h3>
                <p>Orientation, matriculation, leadership week, and graduation are scheduled annually.</p>
            </article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Key Dates</span>
            <h2>Critical Deadlines for Students</h2>
        </div>
        <div class="news-grid">
            <article class="news-card reveal-on-scroll">
                <p class="meta">Week 1-2</p>
                <h3>Registration and Add/Drop Window</h3>
                <p>All students are expected to complete registration and course adjustments within the approved timeline.</p>
            </article>
            <article class="news-card reveal-on-scroll">
                <p class="meta">Mid-Semester</p>
                <h3>Continuous Assessment Period</h3>
                <p>Departments conduct coursework evaluations, practical assessments, and progress monitoring.</p>
            </article>
            <article class="news-card reveal-on-scroll">
                <p class="meta">Final Weeks</p>
                <h3>Revision and Final Examinations</h3>
                <p>Students prepare through revision sessions followed by supervised end-of-semester examinations.</p>
            </article>
        </div>
    </div>
</section>

<section class="section section-tinted">
    <div class="container split-layout">
        <article class="callout reveal-on-scroll">
            <h2>Calendar Compliance and Policy</h2>
            <p>
                Students should track calendar updates from Academic Affairs and departmental offices.
                Missed deadlines for registration, fee clearance, or examinations may affect academic standing.
            </p>
            <p>
                In exceptional situations, adjustments are communicated through official university channels.
            </p>
        </article>
        <article class="callout reveal-on-scroll">
            <h2>Download Full Academic Calendar</h2>
            <p>Access the official CUC calendar in PDF format for complete term dates, events, and examination windows.</p>
            <a href="assets/docs/academic-calendar.pdf" class="btn btn-primary" download>Download Academic Calendar (PDF)</a>
        </article>
    </div>
</section>

<section class="cta">
    <div class="container cta-inner">
        <h2>Stay Ahead of Your Semester Plan</h2>
        <p>Use the calendar to prepare early, meet deadlines, and stay on track academically.</p>
        <div class="btn-row">
            <a href="academics.php" class="btn btn-primary">Explore Academics</a>
            <a href="contact.php" class="btn btn-light">Contact Academic Affairs</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
