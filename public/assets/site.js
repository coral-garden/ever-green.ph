// Shared site chrome: JS-available flag, nav scroll state, mobile menu, scroll reveal.
document.documentElement.classList.add('js');

// ---- nav: solid background after scroll ----
const nav = document.getElementById('nav');
const onScroll = () => nav.classList.toggle('scrolled', window.scrollY > 40);
onScroll();
window.addEventListener('scroll', onScroll, { passive: true });

// ---- mobile menu ----
const menu = document.getElementById('mobileMenu');
const toggle = document.getElementById('navToggle');
const open = () => { menu.classList.add('open'); toggle.setAttribute('aria-expanded', 'true'); };
const close = () => { menu.classList.remove('open'); toggle.setAttribute('aria-expanded', 'false'); };
toggle.addEventListener('click', open);
document.getElementById('mmClose').addEventListener('click', close);
menu.querySelectorAll('a').forEach(a => a.addEventListener('click', close));

// ---- scroll reveal ----
const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
if (reduce) {
  document.querySelectorAll('.reveal').forEach(el => el.classList.add('in'));
} else {
  const io = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (e.isIntersecting) {
        // small stagger within a group
        const sibs = [...e.target.parentElement.children].filter(c => c.classList.contains('reveal'));
        const idx = Math.max(0, sibs.indexOf(e.target));
        e.target.style.transitionDelay = Math.min(idx * 70, 280) + 'ms';
        e.target.classList.add('in');
        io.unobserve(e.target);
      }
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });
  document.querySelectorAll('.reveal').forEach(el => io.observe(el));
}
