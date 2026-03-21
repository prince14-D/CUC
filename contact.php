<?php
$pageTitle = 'Contact';
$pageDescription = 'Contact Christian University College admissions, offices, and support services.';
include 'includes/header.php';
?>

<section class="page-hero">
	<div class="container">
		<span class="eyebrow">Contact Us</span>
		<h1>We Are Here to Support You</h1>
		<p>Reach our admissions office, registrar, and student services for personalized guidance.</p>
	</div>
</section>

<section class="section">
	<div class="container news-grid">
		<article class="news-card">
			<h3>Main Campus</h3>
			<p>Paynesville City, Montserrado County, Liberia</p>
			<p><strong>Hours:</strong> Mon-Fri, 8:00 AM to 5:00 PM</p>
		</article>
		<article class="news-card">
			<h3>Admissions Office</h3>
			<p>admissions@cuc.edu.lr</p>
			<p>+231 77 000 0000</p>
		</article>
		<article class="news-card">
			<h3>Student Affairs</h3>
			<p>studentsupport@cuc.edu.lr</p>
			<p>+231 88 000 0000</p>
		</article>
	</div>
</section>

<section class="section section-tinted">
	<div class="container split-layout">
		<article>
			<div class="section-heading left">
				<span class="eyebrow">Send a Message</span>
				<h2>Request Information</h2>
			</div>
			<form class="contact-form" action="#" method="post">
				<label for="full-name">Full Name</label>
				<input type="text" id="full-name" name="full_name" placeholder="Your full name" required>

				<label for="email">Email Address</label>
				<input type="email" id="email" name="email" placeholder="you@example.com" required>

				<label for="program">Program of Interest</label>
				<select id="program" name="program" required>
					<option value="">Select a program</option>
					<option value="business">Business and Management</option>
					<option value="education">Education and Theology</option>
					<option value="technology">Science and Technology</option>
					<option value="public-admin">Public Administration</option>
				</select>

				<label for="message">Message</label>
				<textarea id="message" name="message" rows="5" placeholder="Tell us what you need"></textarea>

				<button type="submit" class="btn btn-primary">Submit Inquiry</button>
			</form>
		</article>

		<article class="callout">
			<h3>Campus Visit</h3>
			<p>
				Prospective students can book guided campus visits, classroom previews,
				and one-on-one meetings with advisors.
			</p>
			<p><strong>Email:</strong> visit@cuc.edu.lr</p>
			<p><strong>Phone:</strong> +231 55 000 0000</p>
			<a href="admissions.php" class="btn btn-light">Plan Your Visit</a>
		</article>
	</div>
</section>

<?php include 'includes/footer.php'; ?>
