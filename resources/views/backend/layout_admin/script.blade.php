<script src="/backend/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="/backend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/backend/assets/js/sidebarmenu.js"></script>
<script src="/backend/assets/js/app.min.js"></script>
<script src="/backend/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="/backend/assets/libs/simplebar/dist/simplebar.js"></script>
<script src="/backend/assets/js/dashboard.js"></script>
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
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
