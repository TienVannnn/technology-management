<!-- jquery Min JS -->
<script src="/frontend/assets/js/jquery.min.js"></script>
<!-- jquery Migrate JS -->
<script src="/frontend/assets/js/jquery-migrate-3.0.0.js"></script>
<!-- jquery Ui JS -->
<script src="/frontend/assets/js/jquery-ui.min.js"></script>
<!-- Easing JS -->
<script src="/frontend/assets/js/easing.js"></script>
<!-- Color JS -->
<script src="/frontend/assets/js/colors.js"></script>
<!-- Popper JS -->
<script src="/frontend/assets/js/popper.min.js"></script>
<!-- Bootstrap Datepicker JS -->
<script src="/frontend/assets/js/bootstrap-datepicker.js"></script>
<!-- Jquery Nav JS -->
<script src="/frontend/assets/js/jquery.nav.js"></script>
<!-- Slicknav JS -->
<script src="/frontend/assets/js/slicknav.min.js"></script>
<!-- ScrollUp JS -->
<script src="/frontend/assets/js/jquery.scrollUp.min.js"></script>
<!-- Niceselect JS -->
<script src="/frontend/assets/js/niceselect.js"></script>
<!-- Tilt Jquery JS -->
<script src="/frontend/assets/js/tilt.jquery.min.js"></script>
<!-- Owl Carousel JS -->
<script src="/frontend/assets/js/owl-carousel.js"></script>
<!-- counterup JS -->
<script src="/frontend/assets/js/jquery.counterup.min.js"></script>
<!-- Steller JS -->
<script src="/frontend/assets/js/steller.js"></script>
<!-- Wow JS -->
<script src="/frontend/assets/js/wow.min.js"></script>
<!-- Magnific Popup JS -->
<script src="/frontend/assets/js/jquery.magnific-popup.min.js"></script>
<!-- Counter Up CDN JS -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<!-- Bootstrap JS -->
<script src="/frontend/assets/js/bootstrap.min.js"></script>
<!-- Main JS -->
<script src="/frontend/assets/js/main.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

{!! Toastr::message() !!}
<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}", "Thành công");
    @endif
    @if (Session::has('error'))
        toastr.error("{{ Session::get('error') }}", "Thất bại");
    @endif
</script>
