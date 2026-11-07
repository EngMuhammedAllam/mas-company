  <!-- ===== Footer Start ===== -->
  <footer dir="rtl">
    <div class="bb ze ki xn 2xl:ud-px-0">
      <!-- Footer Bottom -->
      <div class="bh ch pm tc uf sf yo wf xf ap cg fp bj">
        <div class="animate_top">
          <ul class="tc wf gg">
            <li><a href="{{ route('landing') }}" class="xl">الرئيسية</a></li>
            <li><a href="#!" class="xl">سياسة الخصوصية</a></li>
            <li><a href="#!" class="xl">الدعم</a></li>
          </ul>
        </div>

        <div class="animate_top">
          <p>&copy; 2023 جميع الحقوق محفوظة MASS COMPANY</p>
        </div>
      </div>
      <!-- Footer Bottom -->
    </div>
  </footer>

  <!-- Alpine JS & Intersect -->
  <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.10.3/dist/cdn.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.3/dist/cdn.min.js"></script>

  <!-- Non-critical libraries -->
  <script>
    (function() {
      var loaded = false;
      var scripts = [
        'https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js'
      ];

      function loadScripts() {
        if (loaded) return;
        loaded = true;
        scripts.forEach(function(src) {
          var s = document.createElement('script');
          s.src = src;
          s.async = true;
          document.body.appendChild(s);
        });
        // Load custom.js after libraries
        setTimeout(function() {
          var c = document.createElement('script');
          c.src = '{{ secure_asset("land/js/custom.js") }}';
          document.body.appendChild(c);
        }, 100);
      }
      ['scroll', 'click', 'touchstart', 'mousemove'].forEach(function(e) {
        window.addEventListener(e, loadScripts, {
          once: true,
          passive: true
        });
      });
      setTimeout(loadScripts, 3000);
    })();
  </script>

  </body>

  </html>