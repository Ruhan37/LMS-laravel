<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>

            <div class="position-relative search-bar d-lg-block d-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
                <input class="form-control px-5" disabled type="search" placeholder="Search">
                <span class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-5"><i class='bx bx-search'></i></span>
            </div>

            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center gap-1">
                    <li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
                        <a class="nav-link" href="javascript:;"><i class='bx bx-search'></i></a>
                    </li>

                    <li class="nav-item dark-mode d-none d-sm-flex">
                        <a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i></a>
                    </li>

                    @php
                        $notifications = \App\Models\Notification::where('user_id', auth()->id())
                            ->orderBy('created_at', 'desc')
                            ->limit(10)
                            ->get();
                        $unreadCount = \App\Models\Notification::where('user_id', auth()->id())
                            ->where('is_read', false)
                            ->count();
                    @endphp

                    <!-- Notifications -->
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                            data-bs-toggle="dropdown">
                            <span class="alert-count">{{ $unreadCount > 0 ? $unreadCount : '' }}</span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Notifications</p>
                                    @if($unreadCount > 0)
                                        <p class="msg-header-badge">{{ $unreadCount }} New</p>
                                    @endif
                                </div>
                            </a>
                            <div class="header-notifications-list">
                                @forelse($notifications as $notification)
                                    <a class="dropdown-item notification-item"
                                       href="{{ $notification->link }}"
                                       data-id="{{ $notification->id }}"
                                       style="{{ !$notification->is_read ? 'background-color: #f0f7ff;' : '' }}">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-primary text-primary">
                                                <i class="bx bx-book-add"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">{{ $notification->title }}
                                                    @if(!$notification->is_read)
                                                        <span class="badge bg-primary ms-1">New</span>
                                                    @endif
                                                </h6>
                                                <p class="msg-info">{{ $notification->message }}</p>
                                                <p class="msg-time">{{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center py-4">
                                        <p class="mb-0">No notifications yet</p>
                                    </div>
                                @endforelse
                            </div>
                            @if($notifications->count() > 0)
                                <a href="javascript:;" id="mark-all-read">
                                    <div class="text-center msg-footer">
                                        <button class="btn btn-primary w-100">Mark All as Read</button>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </li>

                    @if(auth()->user()->role === 'admin')
                    <!-- Messages for Admin -->
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="alert-count">0</span>
                            <i class='bx bx-message'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Messages</p>
                                    <p class="msg-header-badge">0 New</p>
                                </div>
                            </a>
                            <div class="header-message-list">
                                <p class="text-center py-3">No new messages</p>
                            </div>
                            <a href="javascript:;">
                                <div class="text-center msg-footer">
                                    <button class="btn btn-primary w-100">View All Messages</button>
                                </div>
                            </a>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>

            <!-- User Profile Dropdown -->
            <div class="user-box dropdown px-3">
                <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if(auth()->user()->photo)
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="user-img" alt="user avatar">
                    @else
                        <img src="{{ asset('backend/assets/images/avatars/avatar-2.png') }}" class="user-img" alt="user avatar">
                    @endif
                    <div class="user-info">
                        <p class="user-name mb-0">{{ auth()->user()->name }}</p>
                        <p class="designattion mb-0">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                            <i class="bx bx-user fs-5"></i><span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                            <i class="bx bx-cog fs-5"></i><span>Settings</span>
                        </a>
                    </li>
                    @if(auth()->user()->role === 'admin')
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                                <i class="bx bx-home-circle fs-5"></i><span>Dashboard</span>
                            </a>
                        </li>
                    @elseif(auth()->user()->role === 'instructor')
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('instructor.dashboard') }}">
                                <i class="bx bx-home-circle fs-5"></i><span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('instructor.earnings') }}">
                                <i class="bx bx-dollar-circle fs-5"></i><span>Earnings</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bx bx-log-out-circle"></i><span>Logout</span>
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<!-- Search Modal -->
<div class="modal" id="SearchModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header gap-2">
                <div class="position-relative popup-search w-100">
                    <input class="form-control form-control-lg ps-5 border border-3 border-primary" type="search" placeholder="Search">
                    <span class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-4"><i class='bx bx-search'></i></span>
                </div>
                <button type="button" class="btn-close d-md-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="search-list">
                    <p class="mb-1">Recent Searches</p>
                    <div class="list-group">
                        <!-- Search results will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end search modal -->
