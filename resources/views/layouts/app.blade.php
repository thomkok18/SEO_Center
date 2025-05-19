<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head
    :title="config('app.name', 'Laravel')"
    :description="'SEO Center guarantees quality for websites of customers to get higher on google search results. If you are looking for a way to guarantee the quality of your website with blogs and backlinks to get higher into the google search results, this tool is the thing for you.'"
    :css="$css ?? ''"
    :font-awesome="$fontAwesome ?? false"
></x-head>
<style>
    /* cyrillic-ext */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 200;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459WRhyzbi.woff2) format('woff2');
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        font-display: swap;
    }
    /* cyrillic */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 200;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459W1hyzbi.woff2) format('woff2');
        unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        font-display: swap;
    }
    /* vietnamese */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 200;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459WZhyzbi.woff2) format('woff2');
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        font-display: swap;
    }
    /* latin-ext */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 200;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459Wdhyzbi.woff2) format('woff2');
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        font-display: swap;
    }
    /* latin */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 200;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459Wlhyw.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        font-display: swap;
    }
    /* cyrillic-ext */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459WRhyzbi.woff2) format('woff2');
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        font-display: swap;
    }
    /* cyrillic */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459W1hyzbi.woff2) format('woff2');
        unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        font-display: swap;
    }
    /* vietnamese */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459WZhyzbi.woff2) format('woff2');
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        font-display: swap;
    }
    /* latin-ext */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459Wdhyzbi.woff2) format('woff2');
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        font-display: swap;
    }
    /* latin */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459Wlhyw.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        font-display: swap;
    }
    /* cyrillic-ext */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459WRhyzbi.woff2) format('woff2');
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        font-display: swap;
    }
    /* cyrillic */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459W1hyzbi.woff2) format('woff2');
        unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        font-display: swap;
    }
    /* vietnamese */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459WZhyzbi.woff2) format('woff2');
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        font-display: swap;
    }
    /* latin-ext */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459Wdhyzbi.woff2) format('woff2');
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        font-display: swap;
    }
    /* latin */
    @font-face {
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 700;
        src: url(https://fonts.gstatic.com/s/montserrat/v21/JTUSjIg1_i6t8kCHKm459Wlhyw.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        font-display: swap;
    }

    @font-face {
        font-family: Nucleo Outline;
        src: url({{asset('assets/fonts/nucleo-outline.eot')}});
        src: url({{asset('assets/fonts/nucleo-outline.eot')}}) format("embedded-opentype"), url({{asset('assets/fonts/nucleo-outline.woff2')}}) format("woff2"), url({{asset('assets/fonts/nucleo-outline.woff')}}) format("woff"), url({{asset('assets/fonts/nucleo-outline.ttf')}}) format("truetype");
        font-weight: 400;
        font-style: normal;
        font-display: swap;
    }
</style>
<body>
<a class="skip-main" href="#main">Skip to main content</a>
<div class="wrapper">
    <div class="sidebar" data-color="orange">
        <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
        -->

{{--        <div class="logo">--}}
{{--            <a href="http://www.creative-tim.com" class="simple-text logo-mini">--}}
{{--                {{ __(" CT") }}
{{--            </a>--}}
{{--            <a href="http://www.creative-tim.com" class="simple-text logo-normal">--}}
{{--                {{ __(" Creative Tim") }}
{{--            </a>--}}
{{--            <div class="navbar-minimize">--}}
{{--                <button id="minimizeSidebar" class="btn btn-simple btn-icon btn-neutral btn-round" aria-label="Minimize sidebar">--}}
{{--                    <i class="now-ui-icons text_align-center visible-on-sidebar-regular"></i>--}}
{{--                    <i class="now-ui-icons design_bullet-list-67 visible-on-sidebar-mini"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="sidebar-wrapper">
            <div class="user">
                <div class="float-left" style="height: 34px; width: 34px; margin-left: 23px; margin-right: 10px;"></div>
{{--                <div class="photo">--}}
{{--                    <img src="{{asset('../assets/img/james.jpg')}}" alt="Profile picture of you."/>--}}
{{--                </div>--}}
                <div class="info">
                    <a data-toggle="collapse" href="#collapse" class="collapsed">
                      <span>
                          {{ substr(auth()->user()->firstname, 0, 1) }}.
                          @foreach(explode(' ', auth()->user()->inserts) as $inserts)
                              @if($inserts !== '')
                                  {{strtoupper(substr($inserts, 0, 1)) . '.'}}
                              @endif
                          @endforeach
                          {{ substr(auth()->user()->lastname, 0, 1) }}.
                          <b class="caret"></b>
                      </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse" id="collapse">
                        <ul class="nav">
                            <li>
                                <a href="{{route('profile')}}">
                                    <span class="sidebar-mini-icon">MP</span>
                                    <span class="sidebar-normal">{{__('webpage.my_profile')}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="{{Route::currentRouteName() === 'dashboard' ? 'active' : ''}}">
                    <a href="{{route('dashboard')}}">
                        <i class="now-ui-icons design_app"></i>
                        <p>{{__('webpage.Dashboard')}}</p>
                    </a>
                </li>
                @if(auth()->user()->role_id === \App\Models\Role::ADMIN)
                    <li>
                        <a data-toggle="collapse" href="#company">
                            <i class="now-ui-icons design_image"></i>
                            <p>{{__('webpage.companies')}}
                                <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse show" id="company">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('admin.companies.index')}}">
                                        <span class="sidebar-mini-icon">OV</span>
                                        <span class="sidebar-normal">{{__('webpage.overview')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.companies.archived')}}">
                                        <span class="sidebar-mini-icon">AR</span>
                                        <span class="sidebar-normal">{{__('webpage.archive')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="{{Route::currentRouteName() === 'admin.link-buildings.index' ? 'active' : ''}}">
                        <a href="{{route('admin.link-buildings.index')}}">
                            <i class="now-ui-icons design_app"></i>
                            <p>{{__('webpage.link_building')}}</p>
                        </a>
                    </li>
                    <li class="{{Route::currentRouteName() === 'admin.links.index' ? 'active' : ''}}">
                        <a href="{{route('admin.links.index')}}">
                            <i class="now-ui-icons design_app"></i>
                            <p>{{__('webpage.link_crawler')}}</p>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->role_id === \App\Models\Role::SUPPLIER)
                    <li>
                        <a data-toggle="collapse" href="#promotionUrl">
                            <i class="now-ui-icons design_image"></i>
                            <p>{{__('webpage.promotion_url')}}
                                <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse show" id="promotionUrl">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('supplier.promotion-urls.index')}}">
                                        <span class="sidebar-mini-icon">OV</span>
                                        <span class="sidebar-normal">{{__('webpage.overview')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('supplier.promotion-urls.archived')}}">
                                        <span class="sidebar-mini-icon">AR</span>
                                        <span class="sidebar-normal">{{__('webpage.archive')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if(auth()->user()->role_id === \App\Models\Role::SEO)
                    <li>
                        <a data-toggle="collapse" href="#promotionUrl">
                            <i class="now-ui-icons design_image"></i>
                            <p>{{__('webpage.customers')}}
                                <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse show" id="promotionUrl">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('seo.customers.index')}}">
                                        <span class="sidebar-mini-icon">OV</span>
                                        <span class="sidebar-normal">{{__('webpage.overview')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('seo.customers.archived')}}">
                                        <span class="sidebar-mini-icon">AR</span>
                                        <span class="sidebar-normal">{{__('webpage.archive')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="{{Route::currentRouteName() === 'seo.promotion-urls.index' ? 'active' : ''}}">
                        <a href="{{route('seo.promotion-urls.index')}}">
                            <i class="now-ui-icons design_app"></i>
                            <p>{{__('webpage.promotion_url')}}</p>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#promotionUrl">
                            <i class="now-ui-icons design_image"></i>
                            <p>{{__('webpage.observations')}}
                                <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse show" id="promotionUrl">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('seo.observations.index')}}">
                                        <span class="sidebar-mini-icon">OV</span>
                                        <span class="sidebar-normal">{{__('webpage.overview')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('seo.observations.archived')}}">
                                        <span class="sidebar-mini-icon">AR</span>
                                        <span class="sidebar-normal">{{__('webpage.archive')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#promotionUrlPrice">
                            <i class="now-ui-icons design_image"></i>
                            <p>{{__('title.promotion_url_price')}}
                                <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse show" id="promotionUrlPrice">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('seo.price-types.index')}}">
                                        <span class="sidebar-mini-icon">OV</span>
                                        <span class="sidebar-normal">{{__('webpage.overview')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('seo.price-types.archived')}}">
                                        <span class="sidebar-mini-icon">AR</span>
                                        <span class="sidebar-normal">{{__('webpage.archive')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if(auth()->user()->role_id === \App\Models\Role::CUSTOMER)
                    <li>
                        <a data-toggle="collapse" href="#competitors">
                            <i class="now-ui-icons design_image"></i>
                            <p>{{trans_choice('competitor.competitor', 2)}}
                                <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse show" id="competitors">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('customer.competitors.index')}}">
                                        <span class="sidebar-mini-icon">OV</span>
                                        <span class="sidebar-normal">{{__('webpage.overview')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler" aria-label="Navbar toggle">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="{{route('dashboard')}}">{{__('webpage.Dashboard')}}</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a style="cursor:pointer" href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="now-ui-icons users_single-02"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">{{ __("Account") }}</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('profile') }}">{{ __('webpage.Profile') }}</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('user.log_out') }}
                                    </a>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="panel-header panel-header-sm"></div>

        <main id="main" class="content" tabindex="-1">
            {{$slot}}
        </main>

        <x-footer></x-footer>
    </div>
</div>
</body>
{{-- Service worker --}}
<x-service-worker></x-service-worker>

<!--   Core JS Files   -->
<script src="{{asset('../assets/js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('../assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('../assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('../assets/js/plugins/moment.min.js')}}"></script>

<!--  Plugin for Sweet Alert -->
<script src="{{asset('../assets/js/plugins/sweetalert2.min.js')}}"></script>

<!-- Forms Validations Plugin -->
<script src="{{asset('../assets/js/plugins/jquery.validate.min.js')}}"></script>

<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{asset('../assets/js/plugins/jquery.bootstrap-wizard.min.js')}}"></script>

<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{asset('../assets/js/plugins/bootstrap-selectpicker.min.js')}}" type="text/javascript"></script>

<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{asset('../assets/js/plugins/bootstrap-switch.min.js')}}"></script>

<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{asset('../assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="{{asset('../assets/js/plugins/jquery.dataTables.min.js')}}"></script>

<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{asset('../assets/js/plugins/bootstrap-tagsinput.min.js')}}"></script>

<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{asset('../assets/js/plugins/jasny-bootstrap.min.js')}}"></script>

<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{asset('../assets/js/plugins/fullcalendar.min.js')}}"></script>

<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{asset('../assets/js/plugins/jquery-jvectormap.min.js')}}"></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{asset('../assets/js/plugins/nouislider.min.js')}}" type="text/javascript"></script>

<!--  Google Maps Plugin    -->
{{--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>--}}

<!-- Chart JS -->
{{-- Chart JS is inside the pages its used in. --}}
{{--<script src="{{asset('../assets/js/plugins/chartjs.min.js')}}"></script>--}}

<!--  Notifications Plugin    -->
<script src="{{asset('../assets/js/plugins/bootstrap-notify.min.js')}}"></script>

<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('../assets/js/now-ui-dashboard.min.js')}}" type="text/javascript"></script>
</html>
