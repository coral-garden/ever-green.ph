  // ---- construction showcase lightbox (steps through every tile in order) ----
  const lb = document.getElementById('lightbox');
  if (lb) {
    const lbImg = document.getElementById('lbImg');
    const lbCap = document.getElementById('lbCap');
    const lbPrev = document.getElementById('lbPrev');
    const lbNext = document.getElementById('lbNext');

    const cards = Array.from(document.querySelectorAll('.cwork'));
    const photos = cards.map(c => c.dataset.full);
    const caps = cards.map(c => c.dataset.cap || '');
    let idx = 0;

    const render = () => {
      lbImg.src = photos[idx];
      lbImg.alt = caps[idx];
      lbCap.textContent = caps[idx];
      if (photos.length > 1) {
        const count = document.createElement('span');
        count.className = 'lb-count';
        count.textContent = ' ' + (idx + 1) + ' / ' + photos.length;
        lbCap.appendChild(count);
      }
    };
    const openLb = (i) => {
      idx = i;
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

    cards.forEach((card, i) => card.addEventListener('click', () => openLb(i)));
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
  }
