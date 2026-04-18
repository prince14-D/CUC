<?php
$pageTitle = 'Academics';
$pageDescription = 'Explore programs, faculties, and academic pathways at Christian University College.';
$bodyClass = 'academics-page';
include 'includes/header.php';
?>

<style>
@media (max-width: 720px) {
	.academics-page .page-hero {
		padding: 40px 0 20px;
	}

	.academics-page .section {
		padding: 1.5rem 0;
	}

	.academics-page .section-heading {
		margin-bottom: 1rem;
		text-align: left;
	}

	.academics-page .section-heading h2 {
		font-size: clamp(1.3rem, 4vw, 1.6rem);
		margin-bottom: 8px;
	}

	.academics-page .section-heading p {
		font-size: 0.9rem;
	}

	.academics-page .about-stats-grid,
	.academics-page .news-grid,
	.academics-page .split-layout,
	.academics-page .academic-delivery-grid,
	.academics-page .academic-pillars-grid,
	.academics-page .academic-downloads-grid {
		grid-template-columns: 1fr;
	}

	.academics-page .about-stat-card,
	.academics-page .news-card,
	.academics-page .academic-delivery-card,
	.academics-page .about-pillar-card,
	.academics-page .download-card,
	.academics-page .callout {
		padding: 1rem;
	}

	.academics-page .btn-row,
	.academics-page .academic-cta-actions {
		flex-direction: column;
		gap: 0.6rem;
	}

	.academics-page .btn-row .btn,
	.academics-page .academic-cta-actions .btn {
		width: 100%;
	}
}

@media (max-width: 480px) {
	.academics-page .page-hero {
		padding: 34px 0 18px;
	}

	.academics-page h1 {
		font-size: clamp(1.75rem, 8vw, 2.15rem);
	}

	.academics-page h2 {
		font-size: clamp(1.35rem, 6vw, 1.7rem);
	}

	.academics-page p,
	.academics-page li {
		font-size: 0.92rem;
	}

	.academics-page .about-stat-card .stat-number {
		font-size: clamp(1.3rem, 7vw, 1.8rem);
	}

	.academics-page .news-card h3,
	.academics-page .academic-delivery-card h3,
	.academics-page .about-pillar-card h3,
	.academics-page .download-card h3,
	.academics-page .callout h3,
	.academics-page .callout h2 {
		font-size: 1rem;
	}
}
</style>


<section class="page-hero">
    <div class="container">
		<span class="eyebrow">Academics</span>
        <h1>Rigorous Programs for Purposeful Careers</h1>
		<p>CUC offers diploma, associate, and bachelor-level pathways aligned with
			national priorities and global standards. Develop expertise in your chosen field
			with world-class faculty and industry-relevant curricula.</p>
    </div>
</section>

<section class="section about-highlight-band">
	<div class="container">
		<div class="about-stats-grid">
			<div class="about-stat-card reveal-on-scroll">
				<div class="stat-number" data-target="6">6</div>
				<div class="stat-label">Academic Schools</div>
				<p>Spanning business, science, education, health, and more</p>
			</div>
			<div class="about-stat-card reveal-on-scroll">
				<div class="stat-number" data-target="28">28</div>
				<div class="stat-label">Degree Programs</div>
				<p>From certificates to bachelor's level qualifications</p>
			</div>
			<div class="about-stat-card reveal-on-scroll">
				<div class="stat-number" data-target="150">150</div>
				<div class="stat-label">Expert Faculty</div>
				<p>Dedicated instructors with industry and academic excellence</p>
			</div>
			<div class="about-stat-card reveal-on-scroll">
				<div class="stat-number" data-target="95">95</div>
				<div class="stat-label">Graduate Employment %</div>
				<p>Successful placement in relevant fields within 6 months</p>
			</div>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-heading reveal-on-scroll">
			<span class="eyebrow">Schools and Departments</span>
			<h2>Six Excellence Pathways</h2>
			<p>Each school combines rigorous coursework with practical experience to prepare graduates for meaningful impact.</p>
		</div>
		<div class="news-grid">
			<article class="news-card reveal-on-scroll">
				<h3>Business and Management</h3>
				<p>Accounting, Finance, Economics, Procurement, and Entrepreneurship. Build foundational business acumen and specialized expertise.</p>
				<a href="departments-a-z.php" class="btn btn-ghost">Learn More</a>
			</article>
			<article class="news-card reveal-on-scroll">
				<h3>Science and Technology</h3>
				<p>Information Systems, Computer Applications, and Data Fundamentals. Master digital transformation and tech innovation.</p>
				<a href="departments-a-z.php" class="btn btn-ghost">Learn More</a>
			</article>
			<article class="news-card reveal-on-scroll">
				<h3>Education and Theology</h3>
				<p>Primary and Secondary Education, Theology, and Ministry Leadership. Transform lives through teaching and spiritual guidance.</p>
				<a href="departments-a-z.php" class="btn btn-ghost">Learn More</a>
			</article>
			<article class="news-card reveal-on-scroll">
				<h3>Public Administration</h3>
				<p>Policy, governance, social development, and project administration. Lead sustainable development initiatives.</p>
				<a href="departments-a-z.php" class="btn btn-ghost">Learn More</a>
			</article>
			<article class="news-card reveal-on-scroll">
				<h3>Health and Community Studies</h3>
				<p>Public health awareness, community engagement, and social welfare practice. Advance wellbeing in your community.</p>
				<a href="departments-a-z.php" class="btn btn-ghost">Learn More</a>
			</article>
			<article class="news-card reveal-on-scroll">
				<h3>Professional Certifications</h3>
				<p>Short-term certifications for upskilling and continuing education. Stay competitive in your career journey.</p>
				<a href="departments-a-z.php" class="btn btn-ghost">Explore Programs</a>
			</article>
		</div>
	</div>
</section>

<section class="section section-tinted">
	<div class="container">
		<div class="section-heading reveal-on-scroll">
			<span class="eyebrow">Flexible Learning Model</span>
			<h2>Study Pathways and Delivery Modes</h2>
			<p>Choose learning options that match your schedule, background, and long-term goals.</p>
		</div>
		<div class="academic-delivery-grid">
			<article class="academic-delivery-card reveal-on-scroll">
				<span class="delivery-tag">Full-Time</span>
				<h3>On-Campus Degree Study</h3>
				<p>Structured weekday classes with direct faculty engagement, lab sessions, and peer collaboration.</p>
			</article>
			<article class="academic-delivery-card reveal-on-scroll">
				<span class="delivery-tag">Part-Time</span>
				<h3>Evening and Weekend Routes</h3>
				<p>Designed for working professionals seeking to earn recognized qualifications while maintaining employment.</p>
			</article>
			<article class="academic-delivery-card reveal-on-scroll">
				<span class="delivery-tag">Blended</span>
				<h3>Hybrid Learning Experience</h3>
				<p>Combine online coursework with in-person sessions for flexibility without losing practical engagement.</p>
			</article>
			<article class="academic-delivery-card reveal-on-scroll">
				<span class="delivery-tag">Progression</span>
				<h3>Certificate to Degree Ladder</h3>
				<p>Start with a certificate or diploma and transition into higher academic levels through clear pathways.</p>
			</article>
		</div>
	</div>
</section>

<section class="section section-tinted">
	<div class="container split-layout">
		<article class="reveal-on-scroll">
			<h2>Academic Calendar & Structure</h2>
			<p>CUC operates on a flexible semester-based calendar designed to maximize learning and support student success.</p>
			<ul class="clean-list">
				<li><strong>Semester 1:</strong> September to January (18 weeks)</li>
				<li><strong>Semester 2:</strong> February to June (18 weeks)</li>
				<li><strong>Summer Session:</strong> July to August (8 weeks)</li>
				<li><strong>Intersession:</strong> Flexible online learning periods</li>
			</ul>
		</article>
		<article class="reveal-on-scroll">
			<h2>World-Class Learning Resources</h2>
			<p>Every student has access to comprehensive support systems and state-of-the-art facilities.</p>
			<ul class="clean-list">
				<li>Modern lecture halls with multimedia integration</li>
				<li>Digital library with 50,000+ e-resources</li>
				<li>24/7 e-learning platform access</li>
				<li>One-on-one academic advising and tutoring</li>
				<li>Career coaching and internship placement services</li>
				<li>Research labs and technology centers</li>
			</ul>
		</article>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-heading reveal-on-scroll">
			<span class="eyebrow">Student Support Services</span>
			<h2>Your Success is Our Mission</h2>
			<p>Beyond the classroom, we provide comprehensive student services to support your personal and professional growth.</p>
		</div>
		<div class="split-layout">
			<div class="callout reveal-on-scroll">
				<h3>📚 Academic Support</h3>
				<p>Writing centers, peer tutoring, study groups, and exam preparation workshops ensure you master course content and build strong foundational skills for success.</p>
			</div>
			<div class="callout reveal-on-scroll">
				<h3>💼 Career Development</h3>
				<p>Resume building, interview coaching, job placement assistance, and employer networking events connect you with opportunities aligned to your qualifications.</p>
			</div>
			<div class="callout reveal-on-scroll">
				<h3>🎯 Personal Growth</h3>
				<p>Counseling services, mentorship programs, leadership development, and spiritual care support your holistic development as a person and professional.</p>
			</div>
			<div class="callout reveal-on-scroll">
				<h3>🌍 Global Engagement</h3>
				<p>Study abroad opportunities, international partnerships, cultural exchange programs, and collaborative research initiatives broaden your perspective globally.</p>
			</div>
		</div>
	</div>
</section>

<section class="section academic-framework-section">
	<div class="container">
		<div class="section-heading reveal-on-scroll">
			<span class="eyebrow">Academic Excellence Framework</span>
			<h2>Our Educational Pillars</h2>
			<p>Our teaching model combines academic rigor, mentorship, practical learning, and student-centered support for lasting success.</p>
		</div>
		<div class="academic-pillars-grid">
			<article class="about-pillar-card reveal-on-scroll academic-pillar-card">
				<span class="pillar-kicker">Pillar 01</span>
				<h3>Rigorous Curriculum</h3>
				<p>Evidence-based curricula aligned with national standards and international best practices. Continuously updated to reflect industry demands and emerging knowledge.</p>
			</article>
			<article class="about-pillar-card reveal-on-scroll academic-pillar-card">
				<span class="pillar-kicker">Pillar 02</span>
				<h3>Expert Instruction</h3>
				<p>Faculty with advanced degrees and professional experience. Committed to scholarly excellence, student mentorship, and continuous professional development.</p>
			</article>
			<article class="about-pillar-card reveal-on-scroll academic-pillar-card">
				<span class="pillar-kicker">Pillar 03</span>
				<h3>Active Learning</h3>
				<p>Hands-on projects, case studies, internships, and community engagement. Students apply theory in real-world contexts for deeper retention and skills mastery.</p>
			</article>
			<article class="about-pillar-card reveal-on-scroll academic-pillar-card">
				<span class="pillar-kicker">Pillar 04</span>
				<h3>Student-Centered Support</h3>
				<p>Personalized academic advising, adaptive learning resources, and wellness services. Every student receives individualized attention for academic success.</p>
			</article>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-heading reveal-on-scroll">
			<span class="eyebrow">Academic Quality Assurance</span>
			<h2>Maintaining Excellence Standards</h2>
			<p>CUC is committed to continuous improvement through rigorous quality assurance processes, regular curriculum review, and stakeholder feedback integration.</p>
		</div>
		<div class="split-layout">
			<article class="reveal-on-scroll">
				<h3>Program Accreditation</h3>
				<p>All degree programs maintain accreditation with national and international bodies. Regular accreditation reviews ensure ongoing compliance with quality standards and learning outcome achievements.</p>
				<ul class="clean-list">
					<li>National accreditation by Higher Education Authority</li>
					<li>International partnership certifications</li>
					<li>Professional body recognitions</li>
				</ul>
			</article>
			<article class="reveal-on-scroll">
				<h3>Learning Outcomes Assessment</h3>
				<p>Continuous assessment of student learning through comprehensive evaluation frameworks. Data-driven insights inform curriculum adjustments and pedagogical improvements.</p>
				<ul class="clean-list">
					<li>Course-level and program-level assessments</li>
					<li>Student portfolio analysis</li>
					<li>Employer feedback surveys</li>
					<li>Graduate tracking studies</li>
				</ul>
			</article>
		</div>
	</div>
</section>

<section class="section section-tinted academic-downloads-section">
	<div class="container">
		<div class="section-heading reveal-on-scroll">
			<span class="eyebrow">Academic Documents & Downloads</span>
			<h2>Important Resources</h2>
			<p>Download key academic documents to plan your studies and understand CUC's academic policies and requirements.</p>
		</div>
		<div class="academic-downloads-grid">
			<article class="download-card reveal-on-scroll academic-download-item">
				<div class="academic-download-icon">📅</div>
				<h3>Academic Calendar</h3>
				<p>Semester dates, holidays, and key academic dates for the year.</p>
				<a href="assets/docs/academic-calendar.pdf" download class="btn btn-primary">
					📥 Download PDF
				</a>
			</article>
			<article class="download-card reveal-on-scroll academic-download-item">
				<div class="academic-download-icon">📖</div>
				<h3>Student Handbook</h3>
				<p>Complete guide to academic policies, conduct standards, and student rights.</p>
				<a href="assets/docs/student-handbook.pdf" download class="btn btn-primary">
					📥 Download PDF
				</a>
			</article>
			<article class="download-card reveal-on-scroll academic-download-item">
				<div class="academic-download-icon">✅</div>
				<h3>Quality Assurance Report</h3>
				<p>CUC's latest academic quality assurance and assessment outcomes report.</p>
				<a href="assets/docs/academic-quality-assurance.pdf" download class="btn btn-primary">
					📥 Download PDF
				</a>
			</article>
			<article class="download-card reveal-on-scroll academic-download-item">
				<div class="academic-download-icon">📚</div>
				<h3>Program Catalog</h3>
				<p>Complete listing of all degree programs, courses, and degree requirements.</p>
				<a href="assets/docs/program-catalog.pdf" download class="btn btn-primary">
					📥 Download PDF
				</a>
			</article>
		</div>
	</div>
</section>

<section class="cta about-cta">
	<div class="container">
		<div class="reveal-on-scroll">
			<h2>Ready to Start Your Academic Journey?</h2>
			<p>Join CUC and discover a community committed to academic excellence and your personal growth.</p>
			<div class="academic-cta-actions">
				<a href="contact.php" class="btn btn-primary btn-large">Apply Now →</a>
				<a href="admissions.php" class="btn btn-secondary btn-large">Learn About Admissions →</a>
			</div>
		</div>
	</div>
</section>

<?php include 'includes/footer.php'; ?>
