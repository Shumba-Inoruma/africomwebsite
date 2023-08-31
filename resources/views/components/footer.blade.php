 <div>
  @if (session()->has("sucess"))

  <div x-data="{ show: true }" x-init='setTimeout(()=>show=false,4000)'x-show='show'>
  <div class="alert alert-success" role="alert" style="text-align: center;width:60%;margin-left:20%;">
  {{session()->get("sucess")}}
  
  </div>
      </span>
  </div>
  {{$succ=""}}
  
  
  @endif
  @livewireStyles
 <!-- ======= Footer ======= -->
 <footer id="footer" class="footer">

    <div class="footer-content">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Africom</h3>
              <p>
                1st Floor SSC Building, NSSA Building,<br>
                Cnr JNyerere & Sam Mujoma, Harare <br><br>
                <strong>Phone:</strong>08644 000096<br>
                <strong>Email:</strong>customerquiries@afri-com.net<br>
              </p>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#home">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#about">About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#services">Services</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#faq">FAQs</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Products</a></li>

            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="serviceVoice">Voice</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="/serviceMaswerasei">Maswerasei</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="/serviceGuroo">Guroo</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="/serviceCommunication">Communication Solutions</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="/serviceIctConsultancy">ICT Consultancy</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="/serviceHealthy">Africom Health</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>To get the latest news from Africom Team, register your email below</p>
            <livewire:newsletters>

          </div>

        </div>
      </div>
    </div>
    @livewireScripts

    <div class="footer-legal text-center">
      <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">

        <div class="d-flex flex-column align-items-center align-items-lg-start">
          <div class="copyright">
            &copy; Copyright 2023. All rights reserved  <strong>Africom</strong>.  All Rights Reserved
          </div>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
            Designed by <a href="https://www.africom.co.zw/">Africom</a>
          </div>
        </div>

        <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
          <a href="https://twitter.com/africomzim" class="twitter"><i class="bi bi-twitter"></i></a>
          <a href="https://www.facebook.com/search/top?q=africom" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/africom8644/" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="https://www.linkedin.com/company/africom-holdings/?originalSubdomain=zw" class="linkedin"><i class="bi bi-linkedin"></i></a>
          
        </div>

      </div>
    </div>

  </footer><!-- End Footer -->
  <script src="//unpkg.com/alpinejs" defer></script>
</div>