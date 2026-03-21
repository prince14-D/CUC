document.addEventListener('DOMContentLoaded', function () {
	var menuToggle = document.querySelector('.menu-toggle');
	var mainNav = document.querySelector('.main-nav');

	if (menuToggle && mainNav) {
		menuToggle.addEventListener('click', function () {
			var expanded = menuToggle.getAttribute('aria-expanded') === 'true';
			menuToggle.setAttribute('aria-expanded', String(!expanded));
			mainNav.classList.toggle('is-open');
		});

		mainNav.querySelectorAll('a').forEach(function (link) {
			link.addEventListener('click', function () {
				mainNav.classList.remove('is-open');
				menuToggle.setAttribute('aria-expanded', 'false');
			});
		});
	}

	var slider = document.querySelector('.hero-slider');
	if (!slider) {
		return;
	}

	var slides = Array.prototype.slice.call(slider.querySelectorAll('.slide'));
	var prevBtn = slider.querySelector('.slider-btn.prev');
	var nextBtn = slider.querySelector('.slider-btn.next');
	var dotsWrap = slider.querySelector('.slider-dots');
	var current = 0;
	var timer;

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
		}, 6500);
	}

	if (prevBtn) {
		prevBtn.addEventListener('click', function () {
			showSlide(current - 1);
			startAuto();
		});
	}

	if (nextBtn) {
		nextBtn.addEventListener('click', function () {
			showSlide(current + 1);
			startAuto();
		});
	}

	slider.addEventListener('mouseenter', function () {
		clearInterval(timer);
	});

	slider.addEventListener('mouseleave', function () {
		startAuto();
	});

	createDots();
	showSlide(0);
	startAuto();
});
