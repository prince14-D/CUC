document.addEventListener('DOMContentLoaded', function () {
	var menuToggle = document.querySelector('.menu-toggle');
	var mainNav = document.querySelector('.main-nav');

	if (menuToggle && mainNav) {
		menuToggle.addEventListener('click', function () {
			var expanded = menuToggle.getAttribute('aria-expanded') === 'true';
			menuToggle.setAttribute('aria-expanded', String(!expanded));
			mainNav.classList.toggle('is-open');
		});

		var dropdowns = mainNav.querySelectorAll('.nav-dropdown');
		dropdowns.forEach(function (dropdown) {
			var toggle = dropdown.querySelector('.dropdown-toggle');
			if (!toggle) {
				return;
			}

			toggle.addEventListener('click', function (event) {
				event.preventDefault();
				event.stopPropagation();
				var expanded = toggle.getAttribute('aria-expanded') === 'true';
				dropdowns.forEach(function (otherDropdown) {
					if (otherDropdown !== dropdown) {
						otherDropdown.classList.remove('is-open');
						var otherToggle = otherDropdown.querySelector('.dropdown-toggle');
						if (otherToggle) {
							otherToggle.setAttribute('aria-expanded', 'false');
						}
					}
				});
				toggle.setAttribute('aria-expanded', String(!expanded));
				dropdown.classList.toggle('is-open');
			});
		});

		document.addEventListener('click', function () {
			dropdowns.forEach(function (dropdown) {
				dropdown.classList.remove('is-open');
				var toggle = dropdown.querySelector('.dropdown-toggle');
				if (toggle) {
					toggle.setAttribute('aria-expanded', 'false');
				}
			});
		});

		mainNav.querySelectorAll('a').forEach(function (link) {
			link.addEventListener('click', function () {
				mainNav.classList.remove('is-open');
				menuToggle.setAttribute('aria-expanded', 'false');
				dropdowns.forEach(function (dropdown) {
					dropdown.classList.remove('is-open');
					var toggle = dropdown.querySelector('.dropdown-toggle');
					if (toggle) {
						toggle.setAttribute('aria-expanded', 'false');
					}
				});
			});
		});
	}

	var revealTargets = document.querySelectorAll(
		'.reveal-on-scroll, .section-heading, .callout, .feature-card, .news-card, .program-item, .campus-item, .about-pillar-card, .about-stat-card, .event-list article, .partner-card, .download-card, .cta-inner'
	);

	if (revealTargets.length) {
		revealTargets.forEach(function (item) {
			item.classList.add('reveal-on-scroll');
		});

		if ('IntersectionObserver' in window) {
			var revealObserver = new IntersectionObserver(function (entries, observer) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-revealed');
						observer.unobserve(entry.target);
					}
				});
			}, {
				threshold: 0.18,
				rootMargin: '0px 0px -40px 0px'
			});

			revealTargets.forEach(function (item) {
				revealObserver.observe(item);
			});
		} else {
			revealTargets.forEach(function (item) {
				item.classList.add('is-revealed');
			});
		}
	}

	var statsBand = document.querySelector('.stats-band');
	if (statsBand) {
		var statNumbers = statsBand.querySelectorAll('.stat-number');
		var hasAnimated = false;

		function formatStat(value) {
			return value.toLocaleString();
		}

		function animateValue(element) {
			var target = parseInt(element.getAttribute('data-target'), 10);
			var suffix = element.getAttribute('data-suffix') || '';
			if (Number.isNaN(target)) {
				return;
			}

			var duration = 1400;
			var startTime;

			function tick(timestamp) {
				if (!startTime) {
					startTime = timestamp;
				}

				var progress = Math.min((timestamp - startTime) / duration, 1);
				var eased = 1 - Math.pow(1 - progress, 3);
				var currentValue = Math.floor(target * eased);
				element.textContent = formatStat(currentValue) + suffix;

				if (progress < 1) {
					window.requestAnimationFrame(tick);
				}
			}

			window.requestAnimationFrame(tick);
		}

		function startStatsAnimation() {
			if (hasAnimated) {
				return;
			}
			hasAnimated = true;
			statsBand.classList.add('is-visible');
			statNumbers.forEach(function (item) {
				animateValue(item);
			});
		}

		if ('IntersectionObserver' in window) {
			var observer = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						startStatsAnimation();
						observer.disconnect();
					}
				});
			}, { threshold: 0.35 });

			observer.observe(statsBand);
		} else {
			startStatsAnimation();
		}
	}

	var slider = document.querySelector('.hero-slider');
	if (!slider) {
		return;
	}

	var slides = Array.prototype.slice.call(slider.querySelectorAll('.slide'));
	var dotsWrap = slider.querySelector('.slider-dots');
	var autoplayMs = parseInt(slider.getAttribute('data-autoplay-ms'), 10);
	if (Number.isNaN(autoplayMs) || autoplayMs < 2500) {
		autoplayMs = 5000;
	}
	var current = 0;
	var timer;
	var touchStartX = 0;
	var touchEndX = 0;

	function createDots() {
		if (!dotsWrap) {
			return;
		}

		slides.forEach(function (_, index) {
			var dot = document.createElement('button');
			dot.type = 'button';
			dot.setAttribute('aria-label', 'Go to slide ' + (index + 1));
			dot.addEventListener('click', function () {
				showSlide(index);
				startAuto();
			});
			dotsWrap.appendChild(dot);
		});
	}

	function updateDots() {
		if (!dotsWrap) {
			return;
		}

		Array.prototype.slice.call(dotsWrap.children).forEach(function (dot, index) {
			dot.classList.toggle('is-active', index === current);
		});
	}

	function showSlide(index) {
		slides[current].classList.remove('is-active');
		current = (index + slides.length) % slides.length;
		slides[current].classList.add('is-active');
		updateDots();
	}

	function startAuto() {
		clearInterval(timer);
		timer = setInterval(function () {
			showSlide(current + 1);
		}, autoplayMs);
	}

	slider.addEventListener('mouseenter', function () {
		clearInterval(timer);
	});

	slider.addEventListener('mouseleave', function () {
		startAuto();
	});

	slider.addEventListener('touchstart', function (event) {
		touchStartX = event.changedTouches[0].clientX;
	}, { passive: true });

	slider.addEventListener('touchend', function (event) {
		touchEndX = event.changedTouches[0].clientX;
		if (Math.abs(touchEndX - touchStartX) < 40) {
			return;
		}

		if (touchEndX < touchStartX) {
			showSlide(current + 1);
		} else {
			showSlide(current - 1);
		}
		startAuto();
	}, { passive: true });

	createDots();
	showSlide(0);
	startAuto();
});
