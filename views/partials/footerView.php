<!-- Footer Start -->
<div class="container-fluid bg-secondary text-white mt-5 py-5 px-sm-3 px-md-5">
  <div class="row pt-5">
    <div class="col-lg-4 col-md-6 mb-5 text-center">
      <a href="" class="navbar-brand font-weight-bold text-primary m-0 mb-4 p-0" style="font-size: 40px; line-height: 40px">
        <i class="flaticon-043-teddy-bear"></i>
        <span class="text-white">ABCademy</span>
      </a>
      <p>
        Labore dolor amet ipsum ea, erat sit ipsum duo eos. Volup amet ea
        dolor et magna dolor, elitr rebum duo est sed diam elitr. Stet elitr
        stet diam duo eos rebum ipsum diam ipsum elitr.
      </p>
      <div class="d-flex justify-content-center mt-4">
        <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px" href="#"><i class="fab fa-twitter"></i></a>
        <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px" href="#"><i class="fab fa-facebook-f"></i></a>
        <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px" href="#"><i class="fab fa-linkedin-in"></i></a>
        <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px" href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-5 text-center">
      <h3 class="text-primary mb-4">Get In Touch</h3>
      <div class="d-flex justify-content-center">
        <div>
          <h5 class="text-white"><i class="fa fa-map-marker-alt text-primary"></i> Address</h5>
          <p>123 Street, New York, USA</p>
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <div>
          <h5 class="text-white"><i class="fa fa-envelope text-primary"></i> Email</h5>
          <p>info@example.com</p>
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <div>
          <h5 class="text-white"><i class="fa fa-phone-alt text-primary"></i> Phone</h5>
          <p>+012 345 67890</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-5 text-center">
      <h3 class="text-primary mb-4">Quick Links</h3>
      <div class="d-flex flex-column justify-content-center">
        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About Us</a>
        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Classes</a>
        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Teachers</a>
        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Blog</a>
        <a class="text-white" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
      </div>
    </div>
  </div>
  <div class="container-fluid pt-5" style="border-top: 1px solid rgba(23, 162, 184, 0.2) ;">
    <p class="m-0 text-center text-white">
      &copy;
      <a class="text-primary font-weight-bold" href="#">Your Site Name</a>.
      All Rights Reserved.

      <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
      Designed by
      <a class="text-primary font-weight-bold" href="https://htmlcodex.com">HTML Codex</a>
      <br />Distributed By:
      <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
    </p>
  </div>
</div>
<!-- Footer End -->

<!-- Modal donaciones -->
<div class="modal fade" id="modalDonaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-m" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalFormTitle">Haga su donación para el mantenimiento de esta página</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputState">Importe:</label>
              <input type="number" class="form-control" name="donacion" id="donacion" min="1" value="1" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div id="paypal-button"></div>
          <button type="reset" class="btn btn-danger btn-pill" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Back to Top -->
<a href="#" class="btn btn-primary p-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="views/lib/easing/easing.min.js"></script>
<script src="views/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="views/lib/isotope/isotope.pkgd.min.js"></script>
<script src="views/lib/lightbox/js/lightbox.min.js"></script>
<!-- Contact Javascript File -->
<script src="views/mail/jqBootstrapValidation.min.js"></script>
<script src="views/mail/contact.js"></script>
<!-- Template Javascript -->
<script src="views/js/main.js"></script>

<!-- Select2 -->
<script src="admin/views/plugins/select2/js/select2.full.min.js"></script>

</body>

</html>

<script>
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

  });

  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'AbtBcRI2JZp3s7igdC-XfQBUseygSgRafnFI5VAkRBA7RRkrLr8-V8NEnIVqHtFw5VEdEjBv3ikPzAjZ',
      // production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'es_ES',
    style: {
      size: 'responsive',
      color: 'gold',
      shape: 'rect',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      donacion = $("#donacion").val();
      donacion = donacion.toString()
      return actions.payment.create({
        transactions: [{
          amount: {
            total: donacion,
            currency: 'EUR'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        window.alert('Thank you for your purchase!');
      });
    }
  }, '#paypal-button');
</script>