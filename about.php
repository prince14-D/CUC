<?php
$pageTitle = 'About';
$pageDescription = 'Learn about Christian University College, our mission, values, leadership, and campus life.';
$bodyClass = 'about-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
	.about-page .page-hero {
		padding: 40px 0 20px;
	}

	.about-page .section {
		padding: 1.5rem 0;
	}

	.about-page .section-heading {
		margin-bottom: 1rem;
		text-align: left;
	}

	.about-page .section-heading h2 {
		font-size: clamp(1.3rem, 4vw, 1.6rem);
		margin-bottom: 8px;
	}

	.about-page .section-heading p {
		font-size: 0.9rem;
	}

	.about-page .split-layout,
	.about-page .feature-grid,
	.about-page .news-grid {
		grid-template-columns: 1fr;
	}

	.about-page .feature-card,
	.about-page .news-card,
	.about-page .callout {
		padding: 1rem;
	}

	.about-page .btn-row {
		flex-direction: column;
		gap: 0.6rem;
	}

	.about-page .btn-row .btn {
		width: 100%;
	}
}

@media (max-width: 480px) {
	.about-page .page-hero {
		padding: 34px 0 18px;
	}

	.about-page h1 {
		font-size: clamp(1.75rem, 8vw, 2.15rem);
	}

	.about-page h2 {
		font-size: clamp(1.35rem, 6vw, 1.7rem);
	}

	.about-page p,
	.about-page li {
		font-size: 0.92rem;
	}

	.about-page .feature-card h3,
	.about-page .news-card h3,
	.about-page .callout h3 {
		font-size: 1rem;
	}
}
</style>

<section class="page-hero">
	<div class="container">
		<span class="eyebrow">About Christian University College</span>
		<h1>A University Built to Transform Lives and Communities</h1>
		<p>
			Since 2019, Christian University College has provided quality higher education
			rooted in faith, academic excellence, and social responsibility.
		</p>
	</div>
</section>

<section class="section">
	<div class="container split-layout">
		<article>
			<h2>Who We Are</h2>
			<p>
				Christian University College (CUC), located in Paynesville City, Liberia,
				is a private institution dedicated to developing principled graduates equipped
				for leadership in business, education, ministry, technology, and public service.
			</p>
			<p>
				Our educational approach combines critical thinking, practical learning,
				and spiritual formation so students can contribute meaningfully to society.
			</p>
		</article>
		<article class="callout">
			<h3>Our Mission</h3>
			<p>
				To foster wisdom, faith, and service through excellent academic programs
				in a Christ-centered community.
			</p>
			<h3>Our Vision</h3>
			<p>
				To be a leading institution recognized for academic distinction,
				innovation, and transformative leadership in Africa.
			</p>
		</article>
	</div>
</section>

<section class="section section-tinted">
	<div class="container">
		<div class="section-heading">
			<span class="eyebrow">Core Values</span>
			<h2>What Defines the CUC Experience</h2>
		</div>
		<div class="feature-grid">
			<article class="feature-card"><h3>Integrity</h3><p>We uphold honesty, accountability, and ethical conduct.</p></article>
			<article class="feature-card"><h3>Excellence</h3><p>We pursue high standards in teaching, research, and service.</p></article>
			<article class="feature-card"><h3>Innovation</h3><p>We encourage creative thinking and practical problem solving.</p></article>
			<article class="feature-card"><h3>Diversity</h3><p>We embrace people, ideas, and cultures from all backgrounds.</p></article>
			<article class="feature-card"><h3>Service</h3><p>We use knowledge and skills to improve communities.</p></article>
			<article class="feature-card"><h3>Faith</h3><p>We cultivate spiritual growth and character development.</p></article>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-heading">
			<span class="eyebrow">Leadership</span>
			<h2>Guided by Visionary Administration</h2>
		</div>
		<div class="news-grid">
			<article class="news-card">
				<h3>Office of the President</h3>
				<p>Provides strategic leadership and institutional direction for long-term impact.</p>
			</article>
			<article class="news-card">
				<h3>Academic Affairs</h3>
				<p>Oversees curriculum quality, faculty development, and academic standards.</p>
			</article>
			<article class="news-card">
				<h3>Student Affairs</h3>
				<p>Supports wellbeing, mentorship, clubs, and leadership development programs.</p>
			</article>
		</div>
	</div>
</section>

<?php include 'includes/footer.php'; ?>
