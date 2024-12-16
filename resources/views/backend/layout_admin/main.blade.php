<!doctype html>
<html lang="en">

<head>
    @include('backend.layout_admin.headonly')
    @yield('css')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('backend.layout_admin.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('backend.layout_admin.header')
            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                @yield('content')
                @include('backend.layout_admin.footer')
            </div>
        </div>
    </div>
    @routes
    @include('backend.layout_admin.script')
    @yield('js')
</body>

</html>
