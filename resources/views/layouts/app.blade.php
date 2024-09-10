<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@stack('meta-description')">
    <meta name="keywords" content="@stack('meta-keywords')">

    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <title>koncrete @yield('title')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <!-- start page-wrapper -->
    <div class="page-wrapper">
        <!-- start preloader -->
        <div class="preloader">
            <div class="vertical-centered-box">
                <div class="content">
                    <div class="loader-circle"></div>
                    <div class="loader-line-mask">
                        <div class="loader-line"></div>
                    </div>
                    <img src="{{ asset('assets/images/preloader.png') }}" alt="">
                </div>
            </div>
        </div>
        <!-- end preloader -->
        <!-- Start header -->
        <header id="header">
            <!-- start topbar -->
            {{-- <x-top-bar></x-top-bar> --}}
            @isset($topbar)
                {{ $topbar }}
            @endisset
            <!-- end topbar -->
            <div class="wpo-site-header">
                <nav class="navigation navbar navbar-expand-lg navbar-light">
                    <div class="container">
                        <div class="toggle-btn-menu">
                            <div class="mobail-menu">
                                <button type="button" class="navbar-toggler open-btn">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar first-angle"></span>
                                    <span class="icon-bar middle-angle"></span>
                                    <span class="icon-bar last-angle"></span>
                                </button>
                            </div>
                        </div>
                        <a class="navbar-brand" href=""><img src="{{ asset('assets/images/logo.png') }}"
                                alt=""></a>
                        <div id="navbar" class="collapse navbar-collapse navigation-holder">
                            <button class="menu-close"><i class="ti-close"></i></button>
                            <ul class="nav navbar-nav mb-2 mb-lg-0">
                                @foreach ($navbarItems as $item)
                                    @php
                                        $children = collect($item->children);
                                        $slug = urldecode(request()->path());
                                        $isActive =
                                            $slug == $item->url ||
                                            $children->contains(function ($child) use ($slug) {
                                                return $slug == $child->url;
                                            });
                                    @endphp

                                    <li
                                        class="{{ $isActive ? 'menu-item-has-children active' : 'menu-item-has-children' }}">
                                        <a class="{{ $isActive ? 'active' : '' }}"
                                            href="{{ URL($item->url) }}">{{ $item->name }}</a>
                                        @if ($children->isNotEmpty())
                                            <ul class="sub-menu">
                                                @foreach ($children as $child)
                                                    @php
                                                        $isChildActive = $slug == $child->url;
                                                    @endphp
                                                    <li class="{{ $isChildActive ? 'active' : '' }}">
                                                        <a class="{{ $isChildActive ? 'active' : '' }}"
                                                            href="{{ URL($child->url) }}">{{ $child->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>

                        </div><!-- end of nav-collapse -->
                        <div class="header-right">
                            @if ($haveContactPage && isset($languageMeta['contact_btn']))
                                <a class="theme-btn" href="{{ URL($haveContactPage->slug) }}">
                                    {{ $languageMeta['contact_btn'] }} </a>
                            @endif
                        </div>
                    </div><!-- end of container -->
                </nav>
            </div>
        </header>
        <!-- end of header -->
        {{ $slot }}
        <x-footer></x-footer>
    </div>
    <!-- end of page-wrapper -->
    <script src="{{ mix('js/app.js') }}"></script>
    @isset($scripts)
        {{ $scripts }}
    @endisset
</body>


</html>
