<header class="header-menu-area bg-white">
    <div class="header-top pr-150px pl-150px border-bottom border-bottom-gray py-1">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="header-widget">
                        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                            <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray">
                                <i class="la la-phone mr-1"></i><a href="tel:00123456789"> (00) 123 456 789</a>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="la la-envelope-o mr-1"></i><a href="mailto:cyduca@gmail.com"> cyduca@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="header-widget d-flex flex-wrap align-items-center justify-content-end">
                        <div class="theme-picker d-flex align-items-center">
                            <button class="theme-picker-btn dark-mode-btn" title="Dark mode">
                                <svg id="moon" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                </svg>
                            </button>
                            <button class="theme-picker-btn light-mode-btn" title="Light mode">
                                <svg id="sun" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="5"></circle>
                                    <line x1="12" y1="1" x2="12" y2="3"></line>
                                    <line x1="12" y1="21" x2="12" y2="23"></line>
                                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                    <line x1="1" y1="12" x2="3" y2="12"></line>
                                    <line x1="21" y1="12" x2="23" y2="12"></line>
                                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                                </svg>
                            </button>
                        </div>
                        @guest
                        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14 border-left border-left-gray pl-3 ml-3">
                            <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray">
                                <i class="la la-sign-in mr-1"></i><a href="{{ route('login') }}"> Login</a>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="la la-user mr-1"></i><a href="{{ route('register') }}"> Register</a>
                            </li>
                        </ul>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-menu-content pr-150px pl-150px bg-white">
        <div class="container-fluid">
            <div class="main-menu-content">
                <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo-box">
                            <a href="{{ route('frontend.home') }}" class="logo">
                                <img src="{{ asset('frontend/images/logo.png') }}" alt="logo" style="max-height: 50px; width: auto;">
                            </a>
                            <div class="user-btn-action">
                                <div class="search-menu-toggle icon-element icon-element-sm shadow-sm mr-2" data-toggle="tooltip" data-placement="top" title="Search">
                                    <i class="la la-search"></i>
                                </div>
                                <div class="off-canvas-menu-toggle cat-menu-toggle icon-element icon-element-sm shadow-sm mr-2" data-toggle="tooltip" data-placement="top" title="Category menu">
                                    <i class="la la-th-large"></i>
                                </div>
                                <div class="off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="top" title="Main menu">
                                    <i class="la la-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="menu-wrapper">
                            <div class="menu-category">
                                <ul>
                                    <li>
                                        <a href="#">Categories <i class="la la-angle-down fs-12"></i></a>
                                        <ul class="cat-dropdown-menu">
                                            @if(function_exists('getCategories'))
                                                @foreach(getCategories() as $category)
                                                <li>
                                                    <a href="{{ route('category.courses', $category->slug) }}">{{ $category->name }} <i class="la la-angle-right"></i></a>
                                                    @if($category->subcategory->count() > 0)
                                                    <ul class="sub-menu">
                                                        @foreach($category->subcategory as $subcat)
                                                        <li><a href="{{ route('category.courses', $subcat->slug) }}">{{ $subcat->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <form method="get" action="{{ route('search') }}">
                                <div class="form-group mb-0">
                                    <input class="form-control form--control pl-3" type="text" name="search" placeholder="Search for anything">
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form>
                            <nav class="main-menu">
                                <ul>
                                    <li><a href="{{ route('frontend.home') }}">Home</a></li>
                                    <li><a href="#">Courses</a></li>
                                    @auth
                                        @if(auth()->user()->role == 'user')
                                        <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                        @elseif(auth()->user()->role == 'instructor')
                                        <li><a href="{{ route('instructor.dashboard') }}">Dashboard</a></li>
                                        @elseif(auth()->user()->role == 'admin')
                                        <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                        @endif
                                    @endauth
                                </ul>
                            </nav>
                            <div class="shop-cart wishlist-cart pr-3 mr-3 border-right border-right-gray">
                                <ul>
                                    <li>
                                        <p class="shop-cart-btn d-flex align-items-center">
                                            <i class="la la-heart-o"></i>
                                            <span class="product-count" id="wishlist-total">0</span>
                                        </p>
                                        <ul class="cart-dropdown-menu" id="wishlist-course">
                                            <!-- Wishlist items loaded via AJAX -->
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="shop-cart">
                                <ul>
                                    <li>
                                        <p class="shop-cart-btn d-flex align-items-center">
                                            <i class="la la-shopping-cart"></i>
                                            <span class="product-count" id="cartSubTotal">0</span>
                                        </p>
                                        <ul class="cart-dropdown-menu">
                                            <div id="miniCart">
                                                <!-- Cart items loaded via AJAX -->
                                            </div>
                                            <li class="media media-card border-top border-top-gray pt-3 d-flex align-items-center">
                                                <a href="{{ route('cart') }}" class="btn theme-btn w-100">Go to cart <i class="la la-arrow-right icon ml-1"></i></a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            @auth
                            <div class="nav-right-button d-flex align-items-center">
                                <div class="user-action-wrap d-flex align-items-center">
                                    <div class="shop-cart user-profile-cart">
                                        <ul>
                                            <li>
                                                <div class="shop-cart-btn">
                                                    <div class="avatar-xs">
                                                        <img class="rounded-full img-fluid" src="{{ auth()->user()->photo ?? asset('frontend/images/small-avatar-1.jpg') }}" alt="Avatar">
                                                    </div>
                                                    <span class="dot-status bg-1"></span>
                                                </div>
                                                <ul class="cart-dropdown-menu">
                                                    <li class="media media-card">
                                                        <div class="media-body">
                                                            <h5><a href="javascript:void(0)">{{ auth()->user()->name }}</a></h5>
                                                            <span class="d-block fs-14 lh-18 pt-1">{{ auth()->user()->email }}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="divider"></div>
                                                    </li>
                                                    @if(auth()->user()->role == 'user')
                                                    <li><a href="{{ route('user.dashboard') }}"><i class="la la-dashboard mr-1"></i> Dashboard</a></li>
                                                    <li><a href="{{ route('user.profile') }}"><i class="la la-user mr-1"></i> My Profile</a></li>
                                                    <li><a href="{{ route('user.wishlist.index') }}"><i class="la la-heart-o mr-1"></i> Wishlist</a></li>
                                                    @elseif(auth()->user()->role == 'instructor')
                                                    <li><a href="{{ route('instructor.dashboard') }}"><i class="la la-dashboard mr-1"></i> Dashboard</a></li>
                                                    <li><a href="{{ route('instructor.profile') }}"><i class="la la-user mr-1"></i> My Profile</a></li>
                                                    <li><a href="{{ route('instructor.course.index') }}"><i class="la la-book mr-1"></i> My Courses</a></li>
                                                    @endif
                                                    <li>
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li>
                                                        <form method="POST" action="{{ auth()->user()->role == 'user' ? route('user.logout') : (auth()->user()->role == 'instructor' ? route('instructor.logout') : route('admin.logout')) }}">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item"><i class="la la-power-off mr-1"></i> Logout</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Off-canvas menus -->
<div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
    <div class="off-canvas-menu-close main-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="left" title="Close menu">
        <i class="la la-times"></i>
    </div>
    <ul class="generic-list-item off-canvas-menu-list pt-90px">
        <li><a href="{{ route('frontend.home') }}">Home</a></li>
        <li><a href="#">Courses</a></li>
        @auth
            @if(auth()->user()->role == 'user')
            <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
            @elseif(auth()->user()->role == 'instructor')
            <li><a href="{{ route('instructor.dashboard') }}">Dashboard</a></li>
            @elseif(auth()->user()->role == 'admin')
            <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            @endif
        @endauth
    </ul>
</div>

<div class="off-canvas-menu custom-scrollbar-styled category-off-canvas-menu">
    <div class="off-canvas-menu-close cat-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="left" title="Close menu">
        <i class="la la-times"></i>
    </div>
    <ul class="generic-list-item off-canvas-menu-list pt-90px">
        @if(function_exists('getCategories'))
            @foreach(getCategories() as $category)
            <li>
                <a href="{{ route('category.courses', $category->slug) }}">{{ $category->name }}</a>
                @if($category->subcategory->count() > 0)
                <ul class="sub-menu">
                    @foreach($category->subcategory as $subcat)
                    <li><a href="{{ route('category.courses', $subcat->slug) }}">{{ $subcat->name }}</a></li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        @endif
    </ul>
</div>

<div class="body-overlay"></div>
