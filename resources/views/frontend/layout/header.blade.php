<header class="header">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7 col-12">
                    <!-- Contact -->
                    <ul class="top-contact">
                        <li><i class="fa fa-phone"></i>+880 1234 56789</li>
                        <li>
                            <i class="fa fa-envelope"></i><a href="mailto:support@yourmail.com">support@yourmail.com</a>
                        </li>
                    </ul>
                    <!-- End Contact -->
                </div>
                <div class="col-lg-6 col-md-5 col-12">
                    <!-- Top Contact -->
                    <ul class="top-link">
                        <li class="">
                            <input type="search" class="form-control d-none" />
                            <a href="" class="input-search"><i class="fa fa-search"></i></a>
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i><a href="mailto:support@yourmail.com">Vi</a>
                        </li>
                        @if (Auth::guard('customers')->check())
                            <li>
                                <a href="{{ route('customer.profile') }}"><i
                                        class="fa fa-user mr-1"></i>{{ Auth::guard('customers')->user()->name }}</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('customer.login_page') }}">Login</a>
                            </li>
                            <li>
                                <a href="{{ route('customer.register_page') }}">Register</a>
                            </li>
                        @endif
                    </ul>
                    <!-- End Top Contact -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-12">
                        <!-- Start Logo -->
                        <div class="logo">
                            <a href="index.html"><img src="/frontend/assets/img/logo.png" alt="#" /></a>
                        </div>
                        <!-- End Logo -->
                        <!-- Mobile Nav -->
                        <div class="mobile-nav"></div>
                        <!-- End Mobile Nav -->
                    </div>
                    <div class="col-lg-7 col-md-9 col-12">
                        <!-- Main Menu -->
                        <div class="main-menu">
                            <nav class="navigation">
                                <ul class="nav menu">
                                    <li class="active">
                                        <a href="#">Home <i class="icofont-rounded-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="index.html">Home Page 1</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="ourdoctor.html">Doctos </a></li>
                                    <li><a href="#">Services </a></li>
                                    <li>
                                        <a href="#">Pages <i class="icofont-rounded-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="404.html">404 Error</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Blogs <i class="icofont-rounded-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="blog-single.html">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!--/ End Main Menu -->
                    </div>
                    <div class="col-lg-2 col-12">
                        <div class="get-quote">
                            <a href="appointment.html" class="btn">Book Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
