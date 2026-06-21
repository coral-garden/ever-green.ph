  // ---- lightbox ----
  const lb = document.getElementById('lightbox');
  const lbImg = document.getElementById('lbImg');
  const lbCap = document.getElementById('lbCap');
  const openLb = (card) => {
    const img = card.querySelector('img');
    lbImg.src = img.src;
    lbImg.alt = img.alt;
    lbCap.innerHTML = '<b>' + card.dataset.title + '</b> — ' + card.dataset.loc;
    lb.classList.add('open');
    lb.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  };
  const closeLb = () => {
    lb.classList.remove('open');
    lb.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  };
  document.querySelectorAll('.pcard').forEach(card => card.addEventListener('click', () => openLb(card)));
  document.getElementById('lbClose').addEventListener('click', closeLb);
  lb.addEventListener('click', (e) => { if (e.target === lb) closeLb(); });
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && lb.classList.contains('open')) closeLb(); });
