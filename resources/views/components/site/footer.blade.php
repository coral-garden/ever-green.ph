@props(['division' => 'group'])

  <!-- ===================== FOOTER ===================== -->
  <footer class="footer">
    <div class="shell">
      <div class="foot-grid">
        <div class="foot-brand">
          @include('partials.brand', ['division' => $division])
          <p>An island group — solar power, steel-frame construction, and building materials, engineered for life across Siargao.</p>
        </div>
        @verbatim
        <div class="foot-col">
          <h3>Evergreen</h3>
          <a href="/solar">Solar</a>
          <a href="/construction">Frame Construction</a>
          <a href="/hardware">Hardware Supply</a>
          <a href="/about">About</a>
          <a href="/contact">Contact</a>
        </div>
        <div class="foot-col">
          <h3>Offices</h3>
          <a href="https://maps.app.goo.gl/td1LZpCJpKA7Vks69" target="_blank" rel="noopener">Burgos, Siargao</a>
          <p>Nova Tierra, Davao City</p>
          <a href="tel:+639663051461">0966 305 1461</a>
          <a href="tel:+639771275822">0977 127 5822</a>
          <a href="mailto:simonphconsult@gmail.com">simonphconsult@gmail.com</a>
        </div>
        <div class="foot-col">
          <h3>Follow us</h3>
          <a href="https://www.facebook.com/evergreen.solar.mindanao/" target="_blank" rel="noopener">Facebook</a>
          <a href="https://www.instagram.com/evergreensolar.siargao/" target="_blank" rel="noopener">Instagram</a>
          <a href="https://api.whatsapp.com/send?phone=639663051461" target="_blank" rel="noopener">WhatsApp</a>
        </div>
      </div>
      <div class="foot-bottom">
        <span>© 2026 Evergreen</span>
        <div class="legal">
          <a href="/terms">Terms &amp; Conditions</a>
          <a href="/privacy">Privacy Policy</a>
          <a href="/accessibility">Accessibility</a>
          <span class="credit">Site by <a href="https://coralgardensoftware.com/" target="_blank" rel="noopener">CGS</a></span>
        </div>
      </div>
      @endverbatim
    </div>
  </footer>
