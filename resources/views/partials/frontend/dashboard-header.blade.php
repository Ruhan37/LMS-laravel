<header class="header-menu-area">
    <div class="header-menu-content dashboard-menu-content pr-30px pl-30px bg-white shadow-sm">
        <div class="container-fluid">
            <div class="main-menu-content">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="logo-box logo--box">
                            <a href="{{ url('/') }}" class="logo"><img src="{{ asset('frontend/images/logo.png') }}" alt="logo"></a>
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
                        </div><!-- end logo-box -->
                        <div class="menu-wrapper">
                            <form method="get" action="{{ route('courses.search') }}" class="mr-auto ml-0">
                                <div class="form-group mb-0">
                                    <input class="form-control form--control form--control-gray pl-3" type="text" name="search" placeholder="Search for anything">
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form>
                            <div class="nav-right-button d-flex align-items-center">
                                <div class="user-action-wrap d-flex align-items-center">
                                    @auth
                                        @if(auth()->user()->role === 'instructor' || auth()->user()->role === 'user')
                                            <!-- My Courses Dropdown -->
                                            <div class="shop-cart course-cart pr-3 mr-3 border-right border-right-gray">
                                                <ul>
                                                    <li>
                                                        <p class="shop-cart-btn d-flex align-items-center fs-16">
                                                            My Courses
                                                            <span class="la la-angle-down fs-13 ml-1"></span>
                                                        </p>
                                                        <ul class="cart-dropdown-menu after-none" id="enrolled-courses-dropdown">
                                                            <!-- Dynamic enrolled courses will be loaded here via AJAX -->
                                                            <li>
                                                                <a href="{{ route('my-courses') }}" class="btn theme-btn w-100">Go to my course <i class="la la-arrow-right icon ml-1"></i></a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div><!-- end course-cart -->
                                        @endif
                                    @endauth

                                    <!-- Shopping Cart -->
                                    <div class="shop-cart pr-3 mr-3 border-right border-right-gray">
                                        <ul>
                                            <li>
                                                <p class="shop-cart-btn d-flex align-items-center">
                                                    <i class="la la-shopping-cart fs-22"></i>
                                                    <span class="dot-status bg-1" id="cart-badge"></span>
                                                </p>
                                                <ul class="cart-dropdown-menu after-none" id="miniCart">
                                                    <!-- Dynamic cart items will be loaded here -->
                                                </ul>
                                            </li>
                                        </ul>
                                    </div><!-- end shop-cart -->

                                    <!-- Wishlist -->
                                    <div class="shop-cart wishlist-cart pr-3 mr-3 border-right border-right-gray">
                                        <ul>
                                            <li>
                                                <p class="shop-cart-btn">
                                                    <i class="la la-heart-o"></i>
                                                    <span class="dot-status bg-1" id="wishlist-badge"></span>
                                                </p>
                                                <ul class="cart-dropdown-menu after-none" id="wishlist-dropdown">
                                                    <!-- Dynamic wishlist items will be loaded here -->
                                                </ul>
                                            </li>
                                        </ul>
                                    </div><!-- end shop-cart -->

                                    <!-- Notifications -->
                                    <div class="shop-cart notification-cart pr-3 mr-3 border-right border-right-gray">
                                        <ul>
                                            <li>
                                                <p class="shop-cart-btn">
                                                    <i class="la la-bell"></i>
                                                    <span class="dot-status bg-1"></span>
                                                </p>
                                                <ul class="cart-dropdown-menu after-none p-0 notification-dropdown-menu">
                                                    <li class="menu-heading-block d-flex align-items-center justify-content-between">
                                                        <h4>Notifications</h4>
                                                        <span class="ribbon fs-14">0</span>
                                                    </li>
                                                    <li>
                                                        <div class="notification-body">
                                                            <p class="text-center py-3">No new notifications</p>
                                                        </div>
                                                    </li>
                                                    <li class="menu-heading-block">
                                                        <a href="{{ route('dashboard') }}" class="btn theme-btn w-100">Show All Notifications <i class="la la-arrow-right icon ml-1"></i></a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div><!-- end shop-cart -->

                                    @auth
                                    <!-- User Profile -->
                                    <div class="shop-cart user-profile-cart">
                                        <ul>
                                            <li>
                                                <div class="shop-cart-btn">
                                                    <div class="avatar-xs">
                                                        @if(auth()->user()->photo)
                                                            <img class="rounded-full img-fluid" src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Avatar image">
                                                        @else
                                                            <img class="rounded-full img-fluid" src="{{ asset('frontend/images/small-avatar-1.jpg') }}" alt="Avatar image">
                                                        @endif
                                                    </div>
                                                    <span class="dot-status bg-1"></span>
                                                </div>
                                                <ul class="cart-dropdown-menu after-none p-0 notification-dropdown-menu">
                                                    <li class="menu-heading-block d-flex align-items-center">
                                                        <a href="{{ route('profile.edit') }}" class="avatar-sm flex-shrink-0 d-block">
                                                            @if(auth()->user()->photo)
                                                                <img class="rounded-full img-fluid" src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Avatar image">
                                                            @else
                                                                <img class="rounded-full img-fluid" src="{{ asset('frontend/images/small-avatar-1.jpg') }}" alt="Avatar image">
                                                            @endif
                                                        </a>
                                                        <div class="ml-2">
                                                            <h4><a href="{{ route('profile.edit') }}" class="text-black">{{ auth()->user()->name }}</a></h4>
                                                            <span class="d-block fs-14 lh-20">{{ auth()->user()->email }}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="theme-picker d-flex align-items-center justify-content-center lh-40">
                                                            <button class="theme-picker-btn dark-mode-btn w-100 font-weight-semi-bold justify-content-center" title="Dark mode">
                                                                <svg class="mr-1" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                                                </svg>
                                                                Dark Mode
                                                            </button>
                                                            <button class="theme-picker-btn light-mode-btn w-100 font-weight-semi-bold justify-content-center" title="Light mode">
                                                                <svg class="mr-1" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
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
                                                                Light Mode
                                                            </button>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <ul class="generic-list-item">
                                                            @if(auth()->user()->role === 'user')
                                                                <li><a href="{{ route('my-courses') }}"><i class="la la-file-video-o mr-1 text-gray"></i> My courses</a></li>
                                                                <li><a href="{{ route('wishlist') }}"><i class="la la-heart-o mr-1 text-gray"></i> My wishlist</a></li>
                                                                <li><a href="{{ route('cart') }}"><i class="la la-shopping-cart mr-1 text-gray"></i> My cart</a></li>
                                                            @elseif(auth()->user()->role === 'instructor')
                                                                <li><a href="{{ route('instructor.courses') }}"><i class="la la-file-video-o mr-1 text-gray"></i> My courses</a></li>
                                                                <li><a href="{{ route('instructor.earnings') }}"><i class="la la-dollar mr-1 text-gray"></i> Earnings</a></li>
                                                            @endif
                                                            <li><a href="{{ route('dashboard') }}"><i class="la la-dashboard mr-1 text-gray"></i> Dashboard</a></li>
                                                            <li><a href="{{ route('profile.edit') }}"><i class="la la-user mr-1 text-gray"></i> Edit profile</a></li>
                                                            <li>
                                                                <div class="section-block"></div>
                                                            </li>
                                                            <li>
                                                                <form method="POST" action="{{ route('logout') }}">
                                                                    @csrf
                                                                    <a href="{{ route('logout') }}"
                                                                       onclick="event.preventDefault(); this.closest('form').submit();">
                                                                        <i class="la la-power-off mr-1 text-gray"></i> Logout
                                                                    </a>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div><!-- end shop-cart -->
                                    @else
                                    <!-- Guest Actions -->
                                    <div class="shop-cart user-profile-cart">
                                        <a href="{{ route('login') }}" class="btn theme-btn theme-btn-sm mr-2">Login</a>
                                        <a href="{{ route('register') }}" class="btn theme-btn theme-btn-sm theme-btn-transparent">Sign up</a>
                                    </div>
                                    @endauth
                                </div><!-- end user-action-wrap -->
                            </div><!-- end nav-right-button -->
                        </div><!-- end menu-wrapper -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            </div>
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-content -->
</header>
<!-- end header-menu-area -->
