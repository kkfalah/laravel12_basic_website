<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="" height="24">
                    </span>
                </a>
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="tp-link">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                


                <li class="menu-title">Pages</li>

                <li>
                    <a href="#testimonials" data-bs-toggle="collapse">
                        <i data-feather="star"></i>
                        <span> Testimonials </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="testimonials">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.testimonial.index') }}" class="tp-link">All Testimonials</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.testimonial.create') }}" class="tp-link">Add Testimonial</a>
                            </li>
                           
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#features" data-bs-toggle="collapse">
                        <i data-feather="grid"></i>
                        <span> Features </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="features">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.feature.index') }}" class="tp-link">All Features</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.feature.create') }}" class="tp-link">Add Feature</a>
                            </li>
                            
                           
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#FAQ" data-bs-toggle="collapse">
                        <i data-feather="help-circle"></i>
                        <span> FAQ </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="FAQ">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.faq.index') }}" class="tp-link">All FAQ</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.faq.create') }}" class="tp-link">Add FAQ</a>
                            </li>
                            
                           
                        </ul>
                    </div>
                </li>

                

                

                <li class="menu-title mt-2">General</li>

                <li>
                    <a href="#sliders" data-bs-toggle="collapse">
                        <i data-feather="image"></i>
                        <span> Slider </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sliders">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.slider.index') }}" class="tp-link">All Slider</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.slider.create') }}" class="tp-link">Add Slider</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#midsection" data-bs-toggle="collapse">
                        <i data-feather="layout"></i>
                        <span>Mid Sectons </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="midsection">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.section.one.index') }}" class="tp-link">Mid Section One</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.section.two.index') }}" class="tp-link">Mid Section Two</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.section.video.index') }}" class="tp-link">Video Section</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.section.video.bottom.index') }}" class="tp-link">Video Bottom</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="widgets.html" class="tp-link">
                        <i data-feather="aperture"></i>
                        <span> Widgets </span>
                    </a>
                </li>


            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
