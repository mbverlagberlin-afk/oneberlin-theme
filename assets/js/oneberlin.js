/**
 * OneBerlin – kleine Komfortfunktionen im Frontend.
 * Kein jQuery, keine externen Abhängigkeiten.
 */
(function () {
	'use strict';

	var d = document;
	var root = d.documentElement;

	/* Höhe der Infoleiste messen, damit nur die Hauptleiste oben klebt. */
	function measureTopbar() {
		var tb = d.querySelector('.ogs-topbar');
		var h = tb && tb.offsetParent !== null ? tb.offsetHeight : 0;
		root.style.setProperty('--ob-topbar-h', h + 'px');
	}

	/* Schatten/Kompaktmodus beim Scrollen + Nach-oben-Knopf. */
	var toTop = d.createElement('button');
	toTop.type = 'button';
	toTop.className = 'ob-backtotop';
	toTop.setAttribute('aria-label', 'Nach oben');
	toTop.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 5l7 7-1.4 1.4L13 8.8V20h-2V8.8l-4.6 4.6L5 12z"/></svg>';
	toTop.addEventListener('click', function () {
		window.scrollTo({ top: 0, behavior: 'smooth' });
	});

	var ticking = false;
	function onScroll() {
		if (ticking) { return; }
		ticking = true;
		window.requestAnimationFrame(function () {
			var y = window.scrollY || window.pageYOffset;
			root.classList.toggle('ob-scrolled', y > 60);
			toTop.classList.toggle('is-visible', y > 700);
			ticking = false;
		});
	}

	/* Filter im Shop auf dem Handy ein-/ausklappen. */
	function initFilterToggle() {
		var btn = d.getElementById('filter-toggle');
		if (!btn) { return; }
		var wrap = btn.closest('.archive-product') || d.querySelector('.archive-product');
		if (!wrap) { return; }
		btn.setAttribute('aria-expanded', 'false');
		btn.addEventListener('click', function (e) {
			e.preventDefault();
			var open = wrap.classList.toggle('ob-filters-open');
			btn.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
	}

	function init() {
		measureTopbar();
		d.body.appendChild(toTop);
		initFilterToggle();
		onScroll();
		window.addEventListener('scroll', onScroll, { passive: true });
		window.addEventListener('resize', measureTopbar);
	}

	if (d.readyState === 'loading') {
		d.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
