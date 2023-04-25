@php
    $businessObj = get_business_segment(false);
     $business_logo = get_image($businessObj->business_logo,'business_logo',$businessObj->merchant_id,true);
@endphp
<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

    <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
                data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
                data-toggle="collapse">
            <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </button>
        {{--    <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">--}}
        <div class="navbar-brand navbar-brand-center site-tour-trigger">
            <img class="navbar-brand-logo" src="{{ $business_logo }}">
            <span class="navbar-brand-text hidden-xs-down">{{ $businessObj->full_name }}</span>
        </div>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
                data-toggle="collapse">

            <span class="sr-only">Toggle Search</span>
            <i class="icon wb-search" aria-hidden="true"></i>
        </button>
    </div>

    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="nav-item hidden-float" id="toggleMenubar">
                    <a class="nav-link" data-toggle="menubar" href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left">
                            <span class="sr-only">Toggle menubar</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>
                <li class="nav-item hidden-sm-down" id="toggleFullscreen">
                    <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                        <span class="sr-only">Toggle fullscreen</span>
                    </a>
                </li>
                <li class="nav-item hidden-float">
                    <a class="nav-link icon wb-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
                       role="button">

                        <span class="sr-only">Toggle Search</span>
                    </a>
                </li>

            </ul>
            <!-- End Navbar Toolbar -->
            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up"
                       aria-expanded="false" role="button">
                        @if(isset($languages))
                            @foreach($languages as $language)
                                @if(App::getLocale())
                                    @if(strtolower(App::getLocale()) == strtolower($language->locale))
                                        {{ $language->name }}
                                    @endif
                                @else
                                    @if($businessObj->Merchant->Configuration->default_language && strtolower($businessObj->Merchant->Configuration->default_language) == strtolower($language->locale))
                                        {{ $language->name }}
                                    @endif
                                @endif
                            @endforeach
                        @endif
                        {{--@if(isset($languages))--}}
                            {{--@foreach($languages as $language)--}}
                                {{--@if(strtolower(App::getLocale()) == $language->locale)--}}
                                    {{--{{ $language->name }}--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                        {{--            <span class="flag-icon flag-icon-{{ strtolower(App::getLocale()) }}"></span>--}}
                    </a>
                    <div class="dropdown-menu" role="menu">
                        @if(isset($languages))
                            @foreach($languages as $language)
                                {{--                <a class="dropdown-item" href="{{ route('merchant.language',$language->locale) }}" role="menuitem">--}}
                                {{--                  <span class="flag-icon flag-icon-{{$language->locale}}"></span> {{ $language->name }}</a>--}}
                                <a class="dropdown-item" href="{{ route('business-segment.language',$language->locale) }}" role="menuitem">
                                    {{ $language->name }}</a>
                            @endforeach
                        @endif
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                       data-animation="scale-up" role="button">
                <span class="avatar avatar-online">
                  <img src="{{ $business_logo }}">
                  <i></i>
                </span>
                    </a>
                    <div class="dropdown-menu" role="menu">
{{--                        <a class="dropdown-item" href="{{ route('taxicompany.profile') }}" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i>Update Profile</a>--}}
{{--                        <div class="dropdown-divider" role="presentation"></div>--}}
                        <a class="dropdown-item" href="{{ route('business-segment.logout') }}" data-toggle="modal" data-target="#examplePositionTop" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
                    </div>
                </li>
            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->

        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
            <form role="search">
                <div class="form-group">
                    <div class="input-search">
                        <i class="input-search-icon wb-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" name="site-search" placeholder="Search...">
                        <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
                                data-toggle="collapse" aria-label="Close"></button>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Site Navbar Seach -->
    </div>
</nav>
<!-- Logout Modal-->
<div class="modal fade" id="examplePositionTop" tabindex="-1" role="dialog" aria-labelledby="examplePositionTops" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('business-segment.logout') }}">Logout</a>
            </div>
        </div>
    </div>
</div>