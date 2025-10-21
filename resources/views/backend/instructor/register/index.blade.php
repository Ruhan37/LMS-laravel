<!doctype html>
<html lang="en">

<head>

    @include('backend.section.link')

    <title>Cyduca - Instructor Registration</title>
</head>

<body class="">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">

                    <div
                        class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">

                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                            <div class="card-body">
                                <img src="{{asset('backend/assets/images/login-images/login-cover.svg')}}"
                                    class="img-fluid auth-img-cover-login" width="650" alt="" />
                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5">
                                <div class="">
                                    <div class="mb-3 text-center">
                                        <img src="{{asset('backend/assets/images/logo-icon.png')}}" width="60" alt="">
                                    </div>
                                    <div class="text-center mb-4">
                                        <h5 class="">Instructor Registration</h5>
                                        <p class="mb-0">Create your instructor account</p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" method="post" action="{{ route('register') }}" >
                                            @csrf

                                            <input type="hidden" name="role" value="instructor">

                                            <div class="col-12">
												<label for="inputName" class="form-label">Full Name</label>
												<input type="text" class="form-control" name="name" id="inputName" value="{{ old('name') }}" placeholder="Enter your name" required>
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
											</div>

                                            <div class="col-12">
												<label for="inputEmailAddress" class="form-label">Email</label>
												<input type="email" class="form-control" name="email" id="inputEmailAddress" value="{{ old('email') }}" placeholder="jhon@example.com" required>
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
											</div>

                                            <div class="col-12">
												<label for="inputPhone" class="form-label">Phone Number</label>
												<input type="text" class="form-control" name="phone" id="inputPhone" value="{{ old('phone') }}" placeholder="Enter phone number">
                                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
											</div>

											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control border-end-0" name="password" id="inputChoosePassword" placeholder="Enter Password" required>
                                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
												</div>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
											</div>

                                            <div class="col-12">
												<label for="inputConfirmPassword" class="form-label">Confirm Password</label>
												<div class="input-group">
													<input type="password" class="form-control border-end-0" name="password_confirmation" id="inputConfirmPassword" placeholder="Confirm Password" required>
												</div>
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
											</div>

                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Sign Up</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center ">
                                                    <p class="mb-0">Already have an account? <a
                                                            href="{{ route('instructor.login') }}">Sign in here</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->

    @include('backend.section.script')
</body>

</html>
