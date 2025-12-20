<header class="site-header lonyo-header-section light-bg" id="sticky-menu">
    <div class="container">
        <div class="row gx-3 align-items-center justify-content-between">
            <div class="col-8 col-sm-auto ">
                <div class="header-logo1 ">
                    <a href="index.html">
                        <img src="{{ asset('frontend') }}/assets/images/logo/logo-dark.svg" alt="logo">
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="lonyo-main-menu-item">
                    @include('frontend.layouts.navigation')
                </div>
            </div>
            <div class="col-auto d-flex align-items-center">
                <div class="lonyo-header-info-wraper2">

                    @auth
                        <div class="lonyo-header-info-content">
                            <ul>
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            </ul>
                        </div>
                    @else
                        <div class="lonyo-header-info-content">
                            <ul>
                                <li><a href="{{ route('login') }}">Log in</a></li>
                            </ul>
                        </div>
                    @endauth



                    <a class="lonyo-default-btn lonyo-header-btn" href="conact-us.html">Book a demo</a>
                </div>
                <div class="lonyo-header-menu">
                    <nav class="navbar site-navbar justify-content-between">
                        <!-- Brand Logo-->
                        <!-- mobile menu trigger -->
                        <button class="lonyo-menu-toggle d-inline-block d-lg-none">
                            <span></span>
                        </button>
                        <!--/.Mobile Menu Hamburger Ends-->
                    </nav>
                </div>
            </div>
        </div>
    </div>

</header>
