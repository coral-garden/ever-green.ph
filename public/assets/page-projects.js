  // ---- lightbox with per-card photo stepping ----
  const lb = document.getElementById('lightbox');
  const lbImg = document.getElementById('lbImg');
  const lbCap = document.getElementById('lbCap');
  const lbPrev = document.getElementById('lbPrev');
  const lbNext = document.getElementById('lbNext');

  let photos = [];
  let idx = 0;
  let cap = '';

  const render = () => {
    lbImg.src = photos[idx];
    lbImg.alt = cap;
    lbCap.innerHTML = cap + (photos.length > 1 ? ' <span class="lb-count">' + (idx + 1) + ' / ' + photos.length + '</span>' : '');
  };

  const openLb = (card) => {
    const list = (card.dataset.photos || '').split(',').filter(Boolean);
    const heroSrc = card.querySelector('img').src;
    photos = list.length ? list : [heroSrc];
    idx = 0;
    cap = '<b>' + card.dataset.title + '</b> — ' + card.dataset.loc;
    lb.classList.toggle('single', photos.length < 2);
    render();
    lb.classList.add('open');
    lb.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  };

  const closeLb = () => {
    lb.classList.remove('open');
    lb.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  };

  const step = (delta) => {
    if (photos.length < 2) return;
    idx = (idx + delta + photos.length) % photos.length;
    render();
  };

  document.querySelectorAll('.pcard').forEach(card => card.addEventListener('click', () => openLb(card)));
  document.getElementById('lbClose').addEventListener('click', closeLb);
  lbPrev.addEventListener('click', (e) => { e.stopPropagation(); step(-1); });
  lbNext.addEventListener('click', (e) => { e.stopPropagation(); step(1); });
  lb.addEventListener('click', (e) => { if (e.target === lb) closeLb(); });
  document.addEventListener('keydown', (e) => {
    if (!lb.classList.contains('open')) return;
    if (e.key === 'Escape') closeLb();
    else if (e.key === 'ArrowLeft') step(-1);
    else if (e.key === 'ArrowRight') step(1);
  });
