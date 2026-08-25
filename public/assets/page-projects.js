  // ---- lightbox with per-card photo and video stepping ----
  const lb = document.getElementById('lightbox');
  const lbImg = document.getElementById('lbImg');
  const lbVideo = document.getElementById('lbVideo');
  const lbCap = document.getElementById('lbCap');
  const lbPrev = document.getElementById('lbPrev');
  const lbNext = document.getElementById('lbNext');

  let media = [];
  let idx = 0;
  let cap = '';

  const isVideo = (src) => /\.(mp4|webm|ogg)(?:[?#].*)?$/i.test(src);

  const resetVideo = () => {
    lbVideo.pause();
    lbVideo.removeAttribute('src');
    lbVideo.load();
    lbVideo.hidden = true;
  };

  const render = () => {
    const src = media[idx];

    if (isVideo(src)) {
      lbImg.hidden = true;
      lbImg.removeAttribute('src');
      resetVideo();
      lbVideo.src = src;
      lbVideo.hidden = false;
      lbVideo.load();
    } else {
      resetVideo();
      lbImg.src = src;
      lbImg.alt = cap;
      lbImg.hidden = false;
    }

    lbCap.innerHTML = cap + (media.length > 1 ? ' <span class="lb-count">' + (idx + 1) + ' / ' + media.length + '</span>' : '');
  };

  const openLb = (card) => {
    const photos = (card.dataset.photos || '').split(',').filter(Boolean);
    const videos = (card.dataset.videos || '').split(',').filter(Boolean);
    const heroSrc = card.querySelector('img').src;
    media = photos.concat(videos);
    if (!media.length) media = [heroSrc];
    idx = Math.min(Number.parseInt(card.dataset.start || '0', 10), media.length - 1);
    cap = '<b>' + card.dataset.title + '</b> — ' + card.dataset.loc;
    lb.classList.toggle('single', media.length < 2);
    render();
    lb.classList.add('open');
    lb.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  };

  const closeLb = () => {
    resetVideo();
    lb.classList.remove('open');
    lb.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  };

  const step = (delta) => {
    if (media.length < 2) return;
    idx = (idx + delta + media.length) % media.length;
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
