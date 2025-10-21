<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">{{ config('app.name') }}</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @if(auth()->check())
            @if(auth()->user()->role === 'admin')
                <!-- Admin Menu -->
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'mm-active' : '' }}">
                        <div class="parent-icon"><i class='bx bx-home-alt'></i></div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>

                <li class="menu-label">Course Management</li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-book'></i></div>
                        <div class="menu-title">Courses</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('admin.courses.index') }}"><i class='bx bx-radio-circle'></i>All Courses</a></li>
                        <li><a href="{{ route('admin.courses.pending') }}"><i class='bx bx-radio-circle'></i>Pending Courses</a></li>
                        <li><a href="{{ route('admin.courses.approved') }}"><i class='bx bx-radio-circle'></i>Approved Courses</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-category'></i></div>
                        <div class="menu-title">Categories</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('admin.categories.index') }}"><i class='bx bx-radio-circle'></i>All Categories</a></li>
                        <li><a href="{{ route('admin.subcategories.index') }}"><i class='bx bx-radio-circle'></i>Sub Categories</a></li>
                    </ul>
                </li>

                <li class="menu-label">User Management</li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-user'></i></div>
                        <div class="menu-title">Users</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('admin.users.index') }}"><i class='bx bx-radio-circle'></i>All Users</a></li>
                        <li><a href="{{ route('admin.instructors.index') }}"><i class='bx bx-radio-circle'></i>Instructors</a></li>
                        <li><a href="{{ route('admin.users.pending') }}"><i class='bx bx-radio-circle'></i>Pending Approvals</a></li>
                    </ul>
                </li>

                <li class="menu-label">Financial</li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-cart'></i></div>
                        <div class="menu-title">Orders</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('admin.orders.index') }}"><i class='bx bx-radio-circle'></i>All Orders</a></li>
                        <li><a href="{{ route('admin.orders.pending') }}"><i class='bx bx-radio-circle'></i>Pending Orders</a></li>
                        <li><a href="{{ route('admin.orders.completed') }}"><i class='bx bx-radio-circle'></i>Completed Orders</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.payments.index') }}">
                        <div class="parent-icon"><i class='bx bx-dollar-circle'></i></div>
                        <div class="menu-title">Payments</div>
                    </a>
                </li>

                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-money'></i></div>
                        <div class="menu-title">Withdrawals</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('admin.withdrawals.pending') }}"><i class='bx bx-radio-circle'></i>Pending Requests</a></li>
                        <li><a href="{{ route('admin.withdrawals.approved') }}"><i class='bx bx-radio-circle'></i>Approved Requests</a></li>
                        <li><a href="{{ route('admin.withdrawals.all') }}"><i class='bx bx-radio-circle'></i>All Withdrawals</a></li>
                    </ul>
                </li>

                <li class="menu-label">Content Management</li>
                <li>
                    <a href="{{ route('admin.reviews.index') }}">
                        <div class="parent-icon"><i class='bx bx-star'></i></div>
                        <div class="menu-title">Reviews</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.coupons.index') }}">
                        <div class="parent-icon"><i class='bx bx-gift'></i></div>
                        <div class="menu-title">Coupons</div>
                    </a>
                </li>

                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-file'></i></div>
                        <div class="menu-title">Pages</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('admin.pages.about') }}"><i class='bx bx-radio-circle'></i>About Us</a></li>
                        <li><a href="{{ route('admin.pages.privacy') }}"><i class='bx bx-radio-circle'></i>Privacy Policy</a></li>
                        <li><a href="{{ route('admin.pages.terms') }}"><i class='bx bx-radio-circle'></i>Terms & Conditions</a></li>
                    </ul>
                </li>

                <li class="menu-label">Settings</li>
                <li>
                    <a href="{{ route('admin.settings.site') }}">
                        <div class="parent-icon"><i class='bx bx-cog'></i></div>
                        <div class="menu-title">Site Settings</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.settings.smtp') }}">
                        <div class="parent-icon"><i class='bx bx-envelope'></i></div>
                        <div class="menu-title">SMTP Settings</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.settings.payment') }}">
                        <div class="parent-icon"><i class='bx bx-credit-card'></i></div>
                        <div class="menu-title">Payment Settings</div>
                    </a>
                </li>

            @elseif(auth()->user()->role === 'instructor')
                <!-- Instructor Backend Menu -->
                <li>
                    <a href="{{ route('instructor.dashboard') }}" class="{{ request()->routeIs('instructor.dashboard') ? 'mm-active' : '' }}">
                        <div class="parent-icon"><i class='bx bx-home-alt'></i></div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>

                <li class="menu-label">Course Management</li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-book'></i></div>
                        <div class="menu-title">My Courses</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('instructor.courses.index') }}"><i class='bx bx-radio-circle'></i>All Courses</a></li>
                        <li><a href="{{ route('instructor.courses.create') }}"><i class='bx bx-radio-circle'></i>Add New Course</a></li>
                        <li><a href="{{ route('instructor.courses.pending') }}"><i class='bx bx-radio-circle'></i>Pending Courses</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('instructor.reviews') }}">
                        <div class="parent-icon"><i class='bx bx-star'></i></div>
                        <div class="menu-title">Reviews</div>
                    </a>
                </li>

                <li class="menu-label">Financial</li>
                <li>
                    <a href="{{ route('instructor.earnings') }}">
                        <div class="parent-icon"><i class='bx bx-dollar-circle'></i></div>
                        <div class="menu-title">Earnings</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('instructor.withdraw') }}">
                        <div class="parent-icon"><i class='bx bx-money'></i></div>
                        <div class="menu-title">Withdraw</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('instructor.orders') }}">
                        <div class="parent-icon"><i class='bx bx-cart'></i></div>
                        <div class="menu-title">My Orders</div>
                    </a>
                </li>

                <li class="menu-label">Account</li>
                <li>
                    <a href="{{ route('profile.edit') }}">
                        <div class="parent-icon"><i class='bx bx-user-circle'></i></div>
                        <div class="menu-title">Profile Settings</div>
                    </a>
                </li>
            @endif

            <!-- Common Logout -->
            <li>
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                </form>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="parent-icon"><i class='bx bx-log-out-circle'></i></div>
                    <div class="menu-title">Logout</div>
                </a>
            </li>
        @endif
    </ul>
    <!--end navigation-->
</div>
