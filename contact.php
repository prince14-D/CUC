<?php
$pageTitle = 'Contact';
$pageDescription = 'Contact Christian University College admissions, offices, and support services.';

$formData = [
	'full_name' => '',
	'email' => '',
	'program' => '',
	'message' => ''
];
$formStatus = '';
$formMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$formData['full_name'] = trim($_POST['full_name'] ?? '');
	$formData['email'] = trim($_POST['email'] ?? '');
	$formData['program'] = trim($_POST['program'] ?? '');
	$formData['message'] = trim($_POST['message'] ?? '');

	$programLabels = [
		'business' => 'Business and Management',
		'education' => 'Education and Theology',
		'technology' => 'Science and Technology',
		'public-admin' => 'Public Administration'
	];

	if (
		$formData['full_name'] === '' ||
		$formData['email'] === '' ||
		$formData['program'] === '' ||
		!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)
	) {
		$formStatus = 'error';
		$formMessage = 'Please fill in your name, a valid email, and select a program before submitting.';
	} else {
		$to = 'admissions@cuc.edu.lr';
		$programText = $programLabels[$formData['program']] ?? 'Other';
		$subject = 'New Contact Inquiry - ' . $programText;
		$emailBody = "A new inquiry was submitted from the CUC contact page.\n\n";
		$emailBody .= "Full Name: {$formData['full_name']}\n";
		$emailBody .= "Email: {$formData['email']}\n";
		$emailBody .= "Program of Interest: {$programText}\n";
		$emailBody .= "Submitted: " . date('Y-m-d H:i:s') . "\n\n";
		$emailBody .= "Message:\n" . ($formData['message'] !== '' ? $formData['message'] : 'No message provided.') . "\n";

		$headers = [
			'From: CUC Website <no-reply@cuc.edu.lr>',
			'Reply-To: ' . $formData['email'],
			'Content-Type: text/plain; charset=UTF-8'
		];

		$mailSent = mail($to, $subject, $emailBody, implode("\r\n", $headers));

		if ($mailSent) {
			$formStatus = 'success';
			$formMessage = 'Thank you. Your message has been sent successfully. Our team will contact you soon.';
			$formData = [
				'full_name' => '',
				'email' => '',
				'program' => '',
				'message' => ''
			];
		} else {
			$formStatus = 'error';
			$formMessage = 'We could not send your message right now. Please try again or email admissions@cuc.edu.lr directly.';
		}
	}
}

include 'includes/header.php';
?>

<section
	class="page-hero"
	style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.9), rgba(140, 21, 21, 0.82)), url('assets/images/slider2.jpeg') center/cover no-repeat;">
	<div class="container">
		<span class="eyebrow">Contact Us</span>
		<h1>We Are Here to Support You</h1>
		<p>Reach our admissions office, registrar, and student services for personalized guidance and timely support.</p>
		<div class="btn-row contact-hero-actions">
			<a href="tel:+231770000000" class="btn btn-light">Call Admissions</a>
			<a href="https://wa.me/231770000000" class="btn btn-primary">WhatsApp Us</a>
		</div>
	</div>
</section>

<section class="section about-highlight-band">
	<div class="container about-stats-grid">
		<article class="about-stat-card">
			<strong>8:00 AM - 5:00 PM</strong>
			<span>Office Hours</span>
		</article>
		<article class="about-stat-card">
			<strong>Mon - Fri</strong>
			<span>Support Availability</span>
		</article>
		<article class="about-stat-card">
			<strong>24h</strong>
			<span>Email Response Window</span>
		</article>
		<article class="about-stat-card">
			<strong>3+</strong>
			<span>Direct Support Offices</span>
		</article>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-heading">
			<span class="eyebrow">Quick Contact</span>
			<h2>Reach the Right Office Fast</h2>
			<p>Use the contacts below for admissions, student services, and campus visits.</p>
		</div>
		<div class="news-grid">
		<article class="news-card reveal-on-scroll">
			<h3>Main Campus</h3>
			<p>Paynesville City, Montserrado County, Liberia</p>
			<p><strong>Hours:</strong> Mon-Fri, 8:00 AM to 5:00 PM</p>
			<a href="https://maps.google.com/?q=Paynesville+City+Montserrado+Liberia" class="link-arrow" target="_blank" rel="noopener">Open in Google Maps</a>
		</article>
		<article class="news-card reveal-on-scroll">
			<h3>Admissions Office</h3>
			<p>admissions@cuc.edu.lr</p>
			<p>+231 77 000 0000</p>
			<a href="mailto:admissions@cuc.edu.lr" class="link-arrow">Email Admissions</a>
		</article>
		<article class="news-card reveal-on-scroll">
			<h3>Student Affairs</h3>
			<p>studentsupport@cuc.edu.lr</p>
			<p>+231 88 000 0000</p>
			<a href="mailto:studentsupport@cuc.edu.lr" class="link-arrow">Email Student Affairs</a>
		</article>
		</div>
	</div>
</section>

<section class="section section-tinted">
	<div class="container split-layout">
		<article class="reveal-on-scroll">
			<div class="section-heading left">
				<span class="eyebrow">Send a Message</span>
				<h2>Request Information</h2>
				<p>Complete this form and our team will guide you on admissions, programs, and campus life.</p>
			</div>
			<?php if ($formStatus !== ''): ?>
				<div class="form-alert <?= $formStatus === 'success' ? 'form-alert-success' : 'form-alert-error' ?>">
					<?= htmlspecialchars($formMessage, ENT_QUOTES, 'UTF-8') ?>
				</div>
			<?php endif; ?>

			<form class="contact-form" action="" method="post">
				<label for="full-name">Full Name</label>
				<input type="text" id="full-name" name="full_name" placeholder="Your full name" value="<?= htmlspecialchars($formData['full_name'], ENT_QUOTES, 'UTF-8') ?>" required>

				<label for="email">Email Address</label>
				<input type="email" id="email" name="email" placeholder="you@example.com" value="<?= htmlspecialchars($formData['email'], ENT_QUOTES, 'UTF-8') ?>" required>

				<label for="program">Program of Interest</label>
				<select id="program" name="program" required>
					<option value="">Select a program</option>
					<option value="business" <?= $formData['program'] === 'business' ? 'selected' : '' ?>>Business and Management</option>
					<option value="education" <?= $formData['program'] === 'education' ? 'selected' : '' ?>>Education and Theology</option>
					<option value="technology" <?= $formData['program'] === 'technology' ? 'selected' : '' ?>>Science and Technology</option>
					<option value="public-admin" <?= $formData['program'] === 'public-admin' ? 'selected' : '' ?>>Public Administration</option>
				</select>

				<label for="message">Message</label>
				<textarea id="message" name="message" rows="5" placeholder="Tell us what you need"><?= htmlspecialchars($formData['message'], ENT_QUOTES, 'UTF-8') ?></textarea>

				<button type="submit" class="btn btn-primary">Submit Inquiry</button>
			</form>
		</article>

		<article class="callout reveal-on-scroll">
			<h3>Campus Visit</h3>
			<p>
				Prospective students can book guided campus visits, classroom previews,
				and one-on-one meetings with advisors.
			</p>
			<p><strong>Email:</strong> visit@cuc.edu.lr</p>
			<p><strong>Phone:</strong> +231 55 000 0000</p>
			<div class="btn-row contact-visit-actions">
				<a href="admissions.php" class="btn btn-light">Plan Your Visit</a>
				<a href="tel:+231550000000" class="btn btn-primary">Call Visit Desk</a>
			</div>
		</article>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-heading">
			<span class="eyebrow">Find Us</span>
			<h2>Campus Location on Google Map</h2>
			<p>Use the live map for route planning, transport guidance, and easy campus navigation.</p>
		</div>
		<div class="contact-map-wrap reveal-on-scroll">
			<iframe
				class="contact-map"
				title="Christian University College Location"
				src="https://www.google.com/maps?q=Paynesville%20City%2C%20Montserrado%2C%20Liberia&output=embed"
				loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"
				allowfullscreen></iframe>
		</div>
		<div class="split-layout map-detail-layout">
			<article class="callout reveal-on-scroll">
				<h3>Directions and Transport</h3>
				<ul class="clean-list">
					<li>Accessible via major roads in Paynesville</li>
					<li>Public transport drop-off points within walking distance</li>
					<li>Secure parking available for campus visitors</li>
					<li>Call the visit desk for gate entry support</li>
				</ul>
			</article>
			<article class="callout reveal-on-scroll">
				<h3>Map Support</h3>
				<p>If you need help finding campus, contact our front desk before your trip.</p>
				<p><strong>Front Desk:</strong> +231 77 111 1111</p>
				<a href="https://maps.google.com/?q=Paynesville+City+Montserrado+Liberia" class="btn btn-primary" target="_blank" rel="noopener">Open Full Map</a>
			</article>
		</div>
	</div>
</section>

<section class="section section-tinted">
	<div class="container">
		<div class="section-heading">
			<span class="eyebrow">Office Directory</span>
			<h2>Support Units and Contact Channels</h2>
		</div>
		<div class="feature-grid">
			<article class="feature-card reveal-on-scroll">
				<h3>Academic Affairs</h3>
				<p>For course standards, curriculum concerns, and academic policy support.</p>
				<p><strong>Email:</strong> academics@cuc.edu.lr</p>
			</article>
			<article class="feature-card reveal-on-scroll">
				<h3>Admissions and Records</h3>
				<p>For applications, transcript requests, registration, and verification.</p>
				<p><strong>Email:</strong> admissions@cuc.edu.lr</p>
			</article>
			<article class="feature-card reveal-on-scroll">
				<h3>Student Affairs</h3>
				<p>For counseling, student welfare, campus conduct, and clubs.</p>
				<p><strong>Email:</strong> studentsupport@cuc.edu.lr</p>
			</article>
			<article class="feature-card reveal-on-scroll">
				<h3>Finance Office</h3>
				<p>For tuition payment plans, receipts, and billing clarification.</p>
				<p><strong>Email:</strong> finance@cuc.edu.lr</p>
			</article>
			<article class="feature-card reveal-on-scroll">
				<h3>ICT Help Desk</h3>
				<p>For portal login issues, email access, and digital learning support.</p>
				<p><strong>Email:</strong> ictsupport@cuc.edu.lr</p>
			</article>
			<article class="feature-card reveal-on-scroll">
				<h3>Alumni Relations</h3>
				<p>For alumni records, engagement events, and networking opportunities.</p>
				<p><strong>Email:</strong> alumni@cuc.edu.lr</p>
			</article>
		</div>
	</div>
</section>

<section class="cta">
	<div class="container cta-inner">
		<h2>Talk to the CUC Team Today</h2>
		<p>Our team is ready to answer your questions and help you take the next step.</p>
		<div class="btn-row">
			<a href="mailto:admissions@cuc.edu.lr" class="btn btn-light">Email Us</a>
			<a href="tel:+231770000000" class="btn btn-primary">Call Now</a>
		</div>
	</div>
</section>

<?php include 'includes/footer.php'; ?>
