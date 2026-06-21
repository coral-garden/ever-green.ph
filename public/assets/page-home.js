  // ---- hero sun travels the path arc on load (the signature) ----
  (function sunPath() {
    const dot = document.getElementById('sunDot');
    const lit = document.getElementById('arcLit');
    if (!dot) return;
    // quadratic bezier matching the SVG arc: P0(-40,600) P1(600,-120) P2(1240,600)
    const P0 = [-40, 600], P1 = [600, -120], P2 = [1240, 600];
    const at = (t) => {
      const u = 1 - t;
      return [
        u*u*P0[0] + 2*u*t*P1[0] + t*t*P2[0],
        u*u*P0[1] + 2*u*t*P1[1] + t*t*P2[1]
      ];
    };
    if (reduce) { const [x,y] = at(0.5); dot.setAttribute('cx', x); dot.setAttribute('cy', y); return; }

    const start = 0.16, end = 0.84;     // sunrise-ish to sunset-ish, keep on-screen
    const dur = 2600;
    let t0 = null;
    const ease = (p) => 1 - Math.pow(1 - p, 3);
    function frame(ts) {
      if (t0 === null) t0 = ts;
      const p = Math.min((ts - t0) / dur, 1);
      const t = start + (end - start) * ease(p);
      const [x, y] = at(t);
      dot.setAttribute('cx', x); dot.setAttribute('cy', y);
      // lit portion of arc grows behind the sun
      lit.setAttribute('stroke-dashoffset', String(100 - t * 100));
      if (p < 1) requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
  })();
