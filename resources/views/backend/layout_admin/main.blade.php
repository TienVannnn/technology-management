<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.layout_admin.headonly')
    @yield('css')
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('backend.layout_admin.sidebar')
        <!-- End Sidebar -->
        <div class="main-panel">
            @include('backend.layout_admin.header')
            <div class="container">
                @yield('content')
            </div>
            @include('backend.layout_admin.footer')
        </div>


    </div>
    @routes
    @include('backend.layout_admin.script')
    @yield('js')
</body>

</html>
