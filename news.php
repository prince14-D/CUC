<?php
require_once __DIR__ . '/includes/news_storage.php';

$publishedPosts = cuc_get_published_news();
$upcomingEvents = cuc_get_upcoming_events();
$latestMonthLabel = cuc_latest_news_month_label($publishedPosts);
$latestStories = [];

if ($latestMonthLabel !== null) {
	$latestStories = array_values(
		array_filter(
			$publishedPosts,
			static fn(array $post): bool => (string)$post['month_label'] === $latestMonthLabel
		)
	);
}

if (empty($latestStories)) {
	$latestStories = array_slice($publishedPosts, 0, 6);
}

$pageTitle = 'News';
$pageDescription = 'Latest news, research updates, and upcoming events from Christian University College.';
$bodyClass = 'news-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
	.news-page .page-hero {
		padding: 40px 0 20px;
	}

	.news-page .section {
		padding: 1.5rem 0;
	}

	.news-page .section-heading {
		margin-bottom: 1rem;
		text-align: left;
	}

	.news-page .section-heading h2 {
		font-size: clamp(1.3rem, 4vw, 1.6rem);
		margin-bottom: 8px;
	}

	.news-page .section-heading p {
		font-size: 0.9rem;
	}

	.news-page .about-stats-grid,
	.news-page .news-grid,
	.news-page .feature-grid,
	.news-page .split-layout {
		grid-template-columns: 1fr;
	}

	.news-page .about-stat-card,
	.news-page .news-card,
	.news-page .feature-card,
	.news-page .callout,
	.news-page .event-list article {
		padding: 1rem;
	}

	.news-page .news-card-image,
	.news-page .event-card-image {
		width: 100%;
		height: auto;
		aspect-ratio: 4 / 3;
		object-fit: cover;
	}

	.news-page .btn-row {
		flex-direction: column;
		gap: 0.6rem;
	}

	.news-page .btn-row .btn,
	.news-page .cta-inner .btn,
	.news-page .callout .btn {
		width: 100%;
	}
}

@media (max-width: 480px) {
	.news-page .page-hero {
		padding: 34px 0 18px;
	}

	.news-page h1 {
		font-size: clamp(1.75rem, 8vw, 2.15rem);
	}

	.news-page h2 {
		font-size: clamp(1.35rem, 6vw, 1.7rem);
	}

	.news-page p,
	.news-page li,
	.news-page input,
	.news-page button {
		font-size: 0.92rem;
	}

	.news-page .about-stat-card strong {
		font-size: clamp(1.3rem, 7vw, 1.8rem);
	}

	.news-page .news-card h3,
	.news-page .feature-card h3,
	.news-page .event-list article h3,
	.news-page .callout h2,
	.news-page .cta-inner h2 {
		font-size: 1rem;
	}
}
</style>

<section
	class="page-hero"
	style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.9), rgba(140, 21, 21, 0.82)), url('assets/images/slider1.jpeg') center/cover no-repeat;">
	<div class="container">
		<span class="eyebrow">Newsroom</span>
		<h1>University News, Events, and Announcements</h1>
		<p>Stay informed about major milestones, student achievements, faculty research, and important campus updates happening at CUC.</p>
	</div>
</section>

<section class="section about-highlight-band">
	<div class="container about-stats-grid">
		<article class="about-stat-card">
			<strong>150+</strong>
			<span>Annual News Stories</span>
		</article>
		<article class="about-stat-card">
			<strong>40+</strong>
			<span>Yearly Events</span>
		</article>
		<article class="about-stat-card">
			<strong>500+</strong>
			<span>Email Subscribers</span>
		</article>
		<article class="about-stat-card">
			<strong>2,000+</strong>
			<span>Social Media Followers</span>
		</article>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-heading">
			<span class="eyebrow">Latest Stories</span>
			<h2>
				<?= $latestMonthLabel !== null
					? 'Latest Updates for ' . htmlspecialchars($latestMonthLabel, ENT_QUOTES, 'UTF-8')
					: 'Recent News from Campus' ?>
			</h2>
			<p>Discover recent achievements, announcements, and major campus developments posted by the school admin team.</p>
		</div>
		<div class="news-grid">
			<?php if (empty($latestStories)): ?>
				<article class="news-card reveal-on-scroll">
					<p class="meta"><?= htmlspecialchars(date('F j, Y'), ENT_QUOTES, 'UTF-8') ?></p>
					<h3>No monthly updates posted yet</h3>
					<p>The news admin can post the latest school updates and they will automatically appear here.</p>
					<a href="contact.php" class="link-arrow">Contact Office for Updates -&gt;</a>
				</article>
			<?php else: ?>
				<?php foreach (array_slice($latestStories, 0, 6) as $post): ?>
					<article class="news-card reveal-on-scroll">
						<?php if ((string)($post['image_path'] ?? '') !== ''): ?>
							<img
								class="news-card-image"
								src="<?= htmlspecialchars((string)$post['image_path'], ENT_QUOTES, 'UTF-8') ?>"
								alt="<?= htmlspecialchars((string)$post['title'], ENT_QUOTES, 'UTF-8') ?>">
						<?php endif; ?>
						<p class="meta">
							<?= htmlspecialchars(date('F j, Y', strtotime((string)$post['publish_date'])), ENT_QUOTES, 'UTF-8') ?>
							|
							<?= htmlspecialchars((string)$post['month_label'], ENT_QUOTES, 'UTF-8') ?>
						</p>
						<h3><?= htmlspecialchars((string)$post['title'], ENT_QUOTES, 'UTF-8') ?></h3>
						<p><?= htmlspecialchars((string)$post['summary'], ENT_QUOTES, 'UTF-8') ?></p>
						<a href="<?= htmlspecialchars((string)$post['url'], ENT_QUOTES, 'UTF-8') ?>" class="link-arrow">
							<?= ((string)$post['url'] === '#' ? 'Update Coming Soon' : 'Read More') ?> -&gt;
						</a>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="section section-tinted">
	<div class="container">
		<div class="section-heading">
			<span class="eyebrow">Upcoming Events</span>
			<h2>Mark Your Calendar</h2>
			<p>Join us for important campus events, academic forums, and community engagement opportunities.</p>
		</div>
		<div class="event-list">
			<?php if (empty($upcomingEvents)): ?>
				<article class="reveal-on-scroll">
					<h3>No upcoming events posted yet</h3>
					<p>Admins can post future events from the News Admin page and they will appear here automatically.</p>
					<a href="news-admin.php" class="btn btn-sm btn-primary">Open Admin</a>
				</article>
			<?php else: ?>
				<?php foreach (array_slice($upcomingEvents, 0, 3) as $event): ?>
					<article class="reveal-on-scroll">
						<?php if ((string)($event['image_path'] ?? '') !== ''): ?>
							<img class="event-card-image" src="<?= htmlspecialchars((string)$event['image_path'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars((string)$event['title'], ENT_QUOTES, 'UTF-8') ?>">
						<?php endif; ?>
						<h3><?= htmlspecialchars((string)$event['title'], ENT_QUOTES, 'UTF-8') ?></h3>
						<p><strong>Date:</strong> <?= htmlspecialchars(date('F j, Y', strtotime((string)$event['event_date'])), ENT_QUOTES, 'UTF-8') ?><?= (string)($event['event_time'] ?? '') !== '' ? ' at ' . htmlspecialchars((string)$event['event_time'], ENT_QUOTES, 'UTF-8') : '' ?></p>
						<p><strong>Location:</strong> <?= htmlspecialchars((string)$event['location'], ENT_QUOTES, 'UTF-8') ?></p>
						<p><?= htmlspecialchars((string)$event['summary'], ENT_QUOTES, 'UTF-8') ?></p>
						<a href="<?= htmlspecialchars((string)$event['url'], ENT_QUOTES, 'UTF-8') ?>" class="btn btn-sm btn-primary">
							<?= ((string)$event['url'] === '#' ? 'Learn More' : 'Register / Learn More') ?>
						</a>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-heading">
			<span class="eyebrow">Achievements Spotlight</span>
			<h2>Student and Faculty Milestones</h2>
			<p>Celebrating the success stories and accomplishments of our CUC community.</p>
		</div>
		<div class="feature-grid">
			<article class="feature-card reveal-on-scroll">
				<h3>Award Recognition</h3>
				<p>CUC students recognized for excellence in national competitions, service leadership, and academic achievements across multiple disciplines.</p>
			</article>
			<article class="feature-card reveal-on-scroll">
				<h3>Faculty Research</h3>
				<p>CUC faculty conducting groundbreaking research in education, business development, theology, technology, and social innovation.</p>
			</article>
			<article class="feature-card reveal-on-scroll">
				<h3>Community Engagement</h3>
				<p>Students and staff actively participating in community projects, mentorship, and social responsibility initiatives across Liberia.</p>
			</article>
			<article class="feature-card reveal-on-scroll">
				<h3>International Partnerships</h3>
				<p>Strategic collaborations with universities and organizations globally, expanding opportunities for student exchange and research.</p>
			</article>
			<article class="feature-card reveal-on-scroll">
				<h3>Career Placements</h3>
				<p>Graduates successfully employed in competitive positions within private sector, NGOs, government agencies, and educational institutions.</p>
			</article>
			<article class="feature-card reveal-on-scroll">
				<h3>Program Expansion</h3>
				<p>New academic programs and certifications launched to meet market demands and support professional development in emerging fields.</p>
			</article>
		</div>
	</div>
</section>

<section class="section section-tinted">
	<div class="container">
		<div class="section-heading">
			<span class="eyebrow">News Categories</span>
			<h2>Browse by Topic</h2>
			<p>Filter news stories and updates by your areas of interest.</p>
		</div>
		<div class="news-grid">
			<article class="news-card reveal-on-scroll">
				<h3>📚 Academic Updates</h3>
				<p>Program enhancements, curriculum changes, academic calendars, and educational initiatives across all colleges.</p>
			</article>
			<article class="news-card reveal-on-scroll">
				<h3>🎓 Admissions</h3>
				<p>Application deadlines, scholarship announcements, intake periods, and admission requirements for prospective students.</p>
			</article>
			<article class="news-card reveal-on-scroll">
				<h3>⭐ Student Life</h3>
				<p>Student achievements, campus events, clubs and organizations, sports, and student-focused announcements and celebrations.</p>
			</article>
			<article class="news-card reveal-on-scroll">
				<h3>🔬 Research and Innovation</h3>
				<p>Faculty research projects, partnerships, publications, and innovations in various academic and professional fields.</p>
			</article>
			<article class="news-card reveal-on-scroll">
				<h3>👥 Institutional News</h3>
				<p>Campus improvements, staff announcements, organizational updates, and major institutional milestones and changes.</p>
			</article>
			<article class="news-card reveal-on-scroll">
				<h3>🔗 Community Partnerships</h3>
				<p>Collaborations with external organizations, community service initiatives, and partnerships supporting mutual growth and impact.</p>
			</article>
		</div>
	</div>
</section>

<section class="section">
	<div class="container split-layout">
		<article class="callout reveal-on-scroll">
			<h2>Subscribe to CUC News</h2>
			<p>
				Get the latest news, event invitations, and announcements delivered straight to your inbox.
				Stay connected with the CUC community.
			</p>
			<form class="newsletter-form" style="margin-top: 1.25rem;">
				<input type="email" placeholder="Enter your email address" required style="width: 100%; padding: 10px 12px; border: 1px solid var(--color-border); border-radius: 8px; margin-bottom: 0.75rem; font-size: 0.95rem;">
				<button type="submit" class="btn btn-primary" style="width: 100%;">Subscribe</button>
			</form>
		</article>
		<article class="callout reveal-on-scroll">
			<h2>Media Kit and Press Inquiries</h2>
			<ul class="clean-list">
				<li>Official university logo and brand guidelines available</li>
				<li>High-resolution campus and event photographs for media use</li>
				<li>University fact sheet and institutional information</li>
				<li>Faculty and staff interview availability</li>
				<li>Press release archives and publication submissions</li>
				<li>Contact information for media and journalist inquiries</li>
			</ul>
			<div class="btn-row" style="margin-top: 1rem;">
				<a href="contact.php" class="btn btn-primary">Request Media Kit</a>
				<a href="news-admin.php" class="btn btn-light">News Admin</a>
			</div>
		</article>
	</div>
</section>

<section class="cta">
	<div class="container cta-inner">
		<h2>Stay Informed with CUC News</h2>
		<p>Be the first to know about campus events, achievement highlights, and institutional updates.</p>
		<div class="btn-row">
			<a href="contact.php" class="btn btn-primary">Contact Newsroom</a>
			<a href="#" class="btn btn-light">Follow on Social Media</a>
		</div>
	</div>
</section>

<?php include 'includes/footer.php'; ?>
