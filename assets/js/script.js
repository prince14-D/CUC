document.addEventListener('DOMContentLoaded', function () {
	document.documentElement.classList.add('js-animate');
	window.requestAnimationFrame(function () {
		document.body.classList.add('is-ready');
	});

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
		revealTargets.forEach(function (item, index) {
			item.classList.add('reveal-on-scroll');
			item.style.setProperty('--reveal-delay', String(Math.min((index % 8) * 55, 385)) + 'ms');
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

	var statContainers = document.querySelectorAll('.stats-band, .about-highlight-band');
	if (statContainers.length) {
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

		function startStatsAnimation(container) {
			if (container.getAttribute('data-stats-animated') === 'true') {
				return;
			}

			container.setAttribute('data-stats-animated', 'true');
			container.classList.add('is-visible');
			container.querySelectorAll('.stat-number').forEach(function (item) {
				animateValue(item);
			});
		}

		if ('IntersectionObserver' in window) {
			var statObserver = new IntersectionObserver(function (entries, observer) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						startStatsAnimation(entry.target);
						observer.unobserve(entry.target);
					}
				});
			}, { threshold: 0.35 });

			statContainers.forEach(function (container) {
				statObserver.observe(container);
			});
		} else {
			statContainers.forEach(function (container) {
				startStatsAnimation(container);
			});
		}
	}

	var floatingContactWidget = document.querySelector('.floating-contact-widget');
	if (floatingContactWidget) {
		var floatingContactMain = floatingContactWidget.querySelector('.floating-contact-main');
		var floatingContactActions = floatingContactWidget.querySelector('.floating-contact-actions');

		if (floatingContactMain && floatingContactActions) {
			floatingContactMain.addEventListener('click', function () {
				var isOpen = floatingContactWidget.classList.toggle('is-open');
				floatingContactMain.setAttribute('aria-expanded', String(isOpen));
			});

			document.addEventListener('click', function (event) {
				if (!floatingContactWidget.contains(event.target)) {
					floatingContactWidget.classList.remove('is-open');
					floatingContactMain.setAttribute('aria-expanded', 'false');
				}
			});

			floatingContactActions.querySelectorAll('a').forEach(function (link) {
				link.addEventListener('click', function () {
					floatingContactWidget.classList.remove('is-open');
					floatingContactMain.setAttribute('aria-expanded', 'false');
				});
			});
		}
	}

	var testimonialSlider = document.querySelector('.testimonial-slider');
	if (testimonialSlider) {
		var testimonialCards = Array.prototype.slice.call(testimonialSlider.querySelectorAll('.testimonial-card'));
		var testimonialDotsWrap = testimonialSlider.querySelector('.testimonial-dots');
		var testimonialAutoplayMs = parseInt(testimonialSlider.getAttribute('data-autoplay-ms'), 10);
		var testimonialCurrent = 0;
		var testimonialTimer;

		if (Number.isNaN(testimonialAutoplayMs) || testimonialAutoplayMs < 2500) {
			testimonialAutoplayMs = 6000;
		}

		function createTestimonialDots() {
			if (!testimonialDotsWrap) {
				return;
			}

			testimonialCards.forEach(function (_, index) {
				var dot = document.createElement('button');
				dot.type = 'button';
				dot.setAttribute('aria-label', 'Go to testimony ' + (index + 1));
				dot.addEventListener('click', function () {
					showTestimonial(index);
					startTestimonialAuto();
				});
				testimonialDotsWrap.appendChild(dot);
			});
		}

		function updateTestimonialDots() {
			if (!testimonialDotsWrap) {
				return;
			}

			Array.prototype.slice.call(testimonialDotsWrap.children).forEach(function (dot, index) {
				dot.classList.toggle('is-active', index === testimonialCurrent);
			});
		}

		function showTestimonial(index) {
			testimonialCards[testimonialCurrent].classList.remove('is-active');
			testimonialCurrent = (index + testimonialCards.length) % testimonialCards.length;
			testimonialCards[testimonialCurrent].classList.add('is-active');
			updateTestimonialDots();
		}

		function startTestimonialAuto() {
			clearInterval(testimonialTimer);
			testimonialTimer = setInterval(function () {
				showTestimonial(testimonialCurrent + 1);
			}, testimonialAutoplayMs);
		}

		testimonialSlider.addEventListener('mouseenter', function () {
			clearInterval(testimonialTimer);
		});

		testimonialSlider.addEventListener('mouseleave', function () {
			startTestimonialAuto();
		});

		createTestimonialDots();
		showTestimonial(0);
		startTestimonialAuto();
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
