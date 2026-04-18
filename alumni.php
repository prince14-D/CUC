<?php
session_start();

require_once __DIR__ . '/includes/news_storage.php';

$pageTitle = 'Alumni';
$pageDescription = 'Alumni network and engagement opportunities at Christian University College.';
$bodyClass = 'alumni-page';

$alumniJoinUrl = 'https://wa.me/231881846653?text=I%20want%20to%20join%20the%20CUC%20Alumni%20WhatsApp%20group';
$alumniEmail = 'alumni@cuc.edu.lr';
$formStatus = '';
$formMessage = '';
$formData = [
    'full_name' => '',
    'email' => '',
    'graduation_year' => '',
    'program' => '',
    'current_role' => '',
    'message' => '',
];

$publishedHonors = cuc_get_published_alumni_honors();

if (isset($_SESSION['alumni_join_success']) && $_SESSION['alumni_join_success'] === true) {
    unset($_SESSION['alumni_join_success']);
    $formStatus = 'success';
    $formMessage = 'Thank you. Your alumni registration was sent successfully. Joining the WhatsApp group will open automatically.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData['full_name'] = trim((string)($_POST['full_name'] ?? ''));
    $formData['email'] = trim((string)($_POST['email'] ?? ''));
    $formData['graduation_year'] = trim((string)($_POST['graduation_year'] ?? ''));
    $formData['program'] = trim((string)($_POST['program'] ?? ''));
    $formData['current_role'] = trim((string)($_POST['current_role'] ?? ''));
    $formData['message'] = trim((string)($_POST['message'] ?? ''));

    if (
        $formData['full_name'] === '' ||
        $formData['email'] === '' ||
        $formData['graduation_year'] === '' ||
        $formData['program'] === '' ||
        !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)
    ) {
        $formStatus = 'error';
        $formMessage = 'Please fill in your name, valid email, graduation year, and program before submitting.';
    } else {
        $subject = 'New Alumni Registration - ' . $formData['full_name'];
        $emailBody = "A new alumni registration was submitted from the CUC alumni page.\n\n";
        $emailBody .= 'Full Name: ' . $formData['full_name'] . "\n";
        $emailBody .= 'Email: ' . $formData['email'] . "\n";
        $emailBody .= 'Graduation Year: ' . $formData['graduation_year'] . "\n";
        $emailBody .= 'Program: ' . $formData['program'] . "\n";
        $emailBody .= 'Current Role: ' . ($formData['current_role'] !== '' ? $formData['current_role'] : 'Not provided') . "\n";
        $emailBody .= 'Submitted: ' . date('Y-m-d H:i:s') . "\n\n";
        $emailBody .= 'Message:' . "\n" . ($formData['message'] !== '' ? $formData['message'] : 'No message provided.') . "\n";

        $headers = [
            'From: CUC Website <no-reply@cuc.edu.lr>',
            'Reply-To: ' . $formData['email'],
            'Content-Type: text/plain; charset=UTF-8',
        ];

        $mailSent = mail($alumniEmail, $subject, $emailBody, implode("\r\n", $headers));

        if ($mailSent) {
            $_SESSION['alumni_join_success'] = true;
            header('Location: alumni.php#alumni-registration');
            exit;
        }

        $formStatus = 'error';
        $formMessage = 'We could not send your registration right now. Please try again or email alumni@cuc.edu.lr directly.';
    }
}

include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
    .alumni-page .page-hero {
        padding: 40px 0 20px;
    }

    .alumni-page .section {
        padding: 1.5rem 0;
    }

    .alumni-page .section-heading {
        margin-bottom: 1rem;
        text-align: left;
    }

    .alumni-page .section-heading h2 {
        font-size: clamp(1.3rem, 4vw, 1.6rem);
        margin-bottom: 8px;
    }

    .alumni-page .section-heading p {
        font-size: 0.9rem;
    }

    .alumni-page .about-stats-grid,
    .alumni-page .split-layout,
    .alumni-page .news-grid,
    .alumni-page .feature-grid,
    .alumni-page .honor-graduate-grid {
        grid-template-columns: 1fr;
    }

    .alumni-page .about-stat-card,
    .alumni-page .news-card,
    .alumni-page .feature-card,
    .alumni-page .callout,
    .alumni-page .honor-graduate-card {
        padding: 1rem;
    }

    .alumni-page #alumni-registration .container > div[style] {
        max-width: 100% !important;
    }

    .alumni-page .honor-graduate-image {
        width: 100%;
        height: auto;
        aspect-ratio: 4 / 3;
        object-fit: cover;
    }

    .alumni-page .btn-row {
        flex-direction: column;
        gap: 0.6rem;
    }

    .alumni-page .btn-row .btn,
    .alumni-page .contact-form button,
    .alumni-page .callout .btn,
    .alumni-page .page-hero .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .alumni-page .page-hero {
        padding: 34px 0 18px;
    }

    .alumni-page h1 {
        font-size: clamp(1.75rem, 8vw, 2.15rem);
    }

    .alumni-page h2 {
        font-size: clamp(1.35rem, 6vw, 1.7rem);
    }

    .alumni-page p,
    .alumni-page li,
    .alumni-page label,
    .alumni-page input,
    .alumni-page textarea {
        font-size: 0.92rem;
    }

    .alumni-page .about-stat-card strong {
        font-size: clamp(1.3rem, 7vw, 1.8rem);
    }

    .alumni-page .news-card h3,
    .alumni-page .feature-card h3,
    .alumni-page .callout h2,
    .alumni-page .callout h3,
    .alumni-page .honor-graduate-card h3,
    .alumni-page .cta-inner h2 {
        font-size: 1rem;
    }
}
</style>

<section
    class="page-hero"
    style="background: linear-gradient(120deg, rgba(140, 21, 21, 0.9), rgba(20, 27, 45, 0.82)), url('assets/images/slider3.jpeg') center/cover no-repeat;">
    <div class="container">
        <span class="eyebrow">Alumni Community</span>
        <h1>A Lifelong Community Beyond Graduation</h1>
        <p>CUC alumni continue to lead in business, education, ministry, public service, and technology across Liberia and the world.</p>
        <a href="https://wa.me/231881846653?text=I%20want%20to%20join%20the%20CUC%20Alumni%20WhatsApp%20group" class="btn btn-light" style="margin-top: 1.5rem;">
            <i class="bi bi-whatsapp"></i> Join Alumni WhatsApp Group
        </a>
    </div>
</section>

<section class="section about-highlight-band">
    <div class="container about-stats-grid">
        <article class="about-stat-card">
            <strong>5,000+</strong>
            <span>Active Alumni</span>
        </article>
        <article class="about-stat-card">
            <strong>15+</strong>
            <span>Countries Represented</span>
        </article>
        <article class="about-stat-card">
            <strong>40%</strong>
            <span>in Leadership Roles</span>
        </article>
        <article class="about-stat-card">
            <strong>25+</strong>
            <span>Years of Impact</span>
        </article>
    </div>
</section>

<section class="section section-tinted">
    <div class="container split-layout">
        <article class="callout reveal-on-scroll">
            <h2>Stay Connected with Your Community</h2>
            <p>
                Join the alumni network to receive university updates, mentorship opportunities,
                and invitations to career and leadership events.
            </p>
            <p>
                Network with fellow graduates, share career insights, and help shape the future
                of Christian University College.
            </p>
            <a href="#alumni-registration" class="btn btn-primary">Complete Registration</a>
        </article>
        <article class="callout reveal-on-scroll">
            <h2>Alumni Engagement and Benefits</h2>
            <ul class="clean-list">
                <li>Professional networking and career referrals</li>
                <li>Guest lectures and mentorship sessions</li>
                <li>Community service and outreach events</li>
                <li>Scholarships and endowment opportunities</li>
                <li>Exclusive alumni events and reunions</li>
                <li>Job board and career resources</li>
            </ul>
        </article>
    </div>
</section>

<section class="section" id="alumni-registration">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Alumni Registration</span>
            <h2>Register to Join the Alumni Network</h2>
            <p>Fill in the form below to send your details to the alumni office and join the WhatsApp group.</p>
        </div>

        <div style="max-width: 760px; margin: 0 auto;">
            <article class="callout reveal-on-scroll">
                <h2>Alumni Registration Form</h2>
                <p>Send your details and we will keep you updated with alumni news, events, and opportunities.</p>

                <?php if ($formStatus !== ''): ?>
                    <div class="form-alert <?= $formStatus === 'success' ? 'form-alert-success' : 'form-alert-error' ?>">
                        <?= htmlspecialchars($formMessage, ENT_QUOTES, 'UTF-8') ?>
                    </div>
                <?php endif; ?>

                <form class="contact-form" action="" method="post">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($formData['full_name'], ENT_QUOTES, 'UTF-8') ?>" required>

                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($formData['email'], ENT_QUOTES, 'UTF-8') ?>" required>

                    <label for="graduation_year">Graduation Year</label>
                    <input type="text" id="graduation_year" name="graduation_year" value="<?= htmlspecialchars($formData['graduation_year'], ENT_QUOTES, 'UTF-8') ?>" placeholder="2024" required>

                    <label for="program">Program / Major</label>
                    <input type="text" id="program" name="program" value="<?= htmlspecialchars($formData['program'], ENT_QUOTES, 'UTF-8') ?>" placeholder="Business Administration" required>

                    <label for="current_role">Current Job / Role</label>
                    <input type="text" id="current_role" name="current_role" value="<?= htmlspecialchars($formData['current_role'], ENT_QUOTES, 'UTF-8') ?>" placeholder="Teacher, Accountant, Pastor, etc.">

                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" placeholder="Share an update, interest, or request"><?= htmlspecialchars($formData['message'], ENT_QUOTES, 'UTF-8') ?></textarea>

                    <button type="submit" class="btn btn-primary">Send Registration</button>
                </form>
            </article>

            <article class="callout reveal-on-scroll" style="margin-top: 1.25rem;">
                <h2>Join the WhatsApp Group</h2>
                <p>After you submit the form successfully, a new WhatsApp join page will open automatically.</p>
                <p>You can also join directly using the button below.</p>
                <a href="<?= htmlspecialchars($alumniJoinUrl, ENT_QUOTES, 'UTF-8') ?>" class="btn btn-light" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-whatsapp"></i> Join WhatsApp Group
                </a>
            </article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Alumni Impact</span>
            <h2>Where Are CUC Graduates Today?</h2>
            <p>Our alumni serve in diverse sectors, making meaningful contributions to their communities and professions.</p>
        </div>
        <div class="news-grid">
            <article class="news-card reveal-on-scroll">
                <h3>Business and Finance</h3>
                <p>Entrepreneurs, accountants, and financial leaders managing enterprises and organizations.</p>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>Education and Academia</h3>
                <p>Teachers, trainers, and academic administrators advancing quality education across Liberia.</p>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>Ministry and Service</h3>
                <p>Pastors, counselors, and community workers providing spiritual and social support.</p>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>Technology and Digital</h3>
                <p>Software developers, IT professionals, and digital innovators building the tech economy.</p>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>Government and NGOs</h3>
                <p>Policy makers, administrators, and development professionals serving in public institutions.</p>
            </article>
            <article class="news-card reveal-on-scroll">
                <h3>Healthcare and Wellness</h3>
                <p>Medical professionals and wellness advocates improving health outcomes in communities.</p>
            </article>
        </div>
    </div>
</section>

<section class="section section-tinted">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">University Validation and Accreditation</span>
            <h2>Quality Assurance and Institutional Recognition</h2>
            <p>CUC credentials are recognized by national and international education standards bodies.</p>
        </div>
        <div class="feature-grid">
            <article class="feature-card reveal-on-scroll">
                <h3>NCHE Accreditation</h3>
                <p>Accredited by the National Commission on Higher Education (NCHE), Liberia, ensuring quality standards.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Program Recognition</h3>
                <p>All CUC degree programs meet national curriculum standards and professional requirements.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Degree Authenticity</h3>
                <p>Graduates receive recognized diplomas verifiable through the Office of Admissions and Records.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>International Equivalent</h3>
                <p>CUC credentials are recognized by international education systems and employer networks.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Quality Assurance Process</h3>
                <p>Continuous assessment and improvement ensure CUC maintains educational excellence.</p>
            </article>
            <article class="feature-card reveal-on-scroll">
                <h3>Credential Verification</h3>
                <p>Alumni can request official transcripts and degree verification through Academic Affairs.</p>
            </article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Academic Excellence</span>
            <h2>Honor Graduates and Distinguished Scholars</h2>
            <p>Celebrating graduates who achieved academic excellence and high cumulative GPAs.</p>
        </div>
        <?php if (empty($publishedHonors)): ?>
            <article class="callout reveal-on-scroll" style="max-width: 860px; margin: 0 auto;">
                <h3>No honor graduate profiles posted yet</h3>
                <p>Admin can publish honor graduate entries from the News Admin page, and they will appear here automatically.</p>
                <a href="news-admin.php" class="btn btn-primary">Open Admin</a>
            </article>
        <?php else: ?>
            <div class="honor-graduate-grid">
                <?php foreach ($publishedHonors as $honor): ?>
                    <article class="honor-graduate-card reveal-on-scroll">
                        <?php if ((string)($honor['image_path'] ?? '') !== ''): ?>
                            <img src="<?= htmlspecialchars((string)$honor['image_path'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars((string)$honor['title'], ENT_QUOTES, 'UTF-8') ?>" class="honor-graduate-image">
                        <?php else: ?>
                            <img src="assets/images/logo.jpg" alt="<?= htmlspecialchars((string)$honor['title'], ENT_QUOTES, 'UTF-8') ?>" class="honor-graduate-image">
                        <?php endif; ?>
                        <div class="honor-badge">
                            <span class="honor-icon">★</span>
                            <span class="honor-text"><?= htmlspecialchars((string)$honor['honor_level'], ENT_QUOTES, 'UTF-8') ?></span>
                        </div>
                        <h3><?= htmlspecialchars((string)$honor['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <p class="honor-gpa">GPA: <?= htmlspecialchars((string)$honor['gpa'], ENT_QUOTES, 'UTF-8') ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="section section-tinted">
    <div class="container split-layout">
        <article class="callout reveal-on-scroll">
            <h2>Support the Next Generation</h2>
            <p>
                Alumni play a vital role in developing the leaders of tomorrow through mentorship,
                donations, and community engagement.
            </p>
            <p>
                Your contribution—whether financial or in-kind—directly impacts student success
                and institutional growth.
            </p>
            <a href="donation.php" class="btn btn-primary">Make a Donation</a>
        </article>
        <article class="callout reveal-on-scroll">
            <h2>Alumni Resources</h2>
            <ul class="clean-list">
                <li>Career services and job postings</li>
                <li>Mentorship program matching</li>
                <li>Continuing education opportunities</li>
                <li>Alumni reunion planning</li>
                <li>Directory and networking access</li>
                <li>University news and updates</li>
            </ul>
        </article>
    </div>
</section>

<section class="cta">
    <div class="container cta-inner">
        <h2>Connect with Your CUC Family</h2>
        <p>Join thousands of alumni making a difference in education, business, ministry, and service.</p>
        <div class="btn-row">
            <a href="<?= htmlspecialchars($alumniJoinUrl, ENT_QUOTES, 'UTF-8') ?>" class="btn btn-light" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-whatsapp"></i> Join WhatsApp Group
            </a>
            <a href="contact.php" class="btn btn-primary">Contact Alumni Office</a>
        </div>
    </div>
</section>

<?php if ($formStatus === 'success'): ?>
<script>
(function () {
    var joinUrl = <?= json_encode($alumniJoinUrl) ?>;
    window.setTimeout(function () {
        window.open(joinUrl, '_blank', 'noopener');
    }, 150);
})();
</script>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
