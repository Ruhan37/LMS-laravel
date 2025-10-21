<section class="footer-area pt-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 responsive-column-half">
                <div class="footer-item">
                    <a href="{{ route('frontend.home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="footer logo" class="footer__logo">
                    </a>
                    <ul class="generic-list-item pt-4">
                        <li><a href="tel:+8801745186442">+880 1745 186442</a></li>
                        <li><a href="mailto:cyduca@gmail.com">cyduca@gmail.com</a></li>
                        <li>Dhaka, Bangladesh</li>
                    </ul>
                    <h3 class="fs-20 font-weight-semi-bold pt-4 pb-2">We are on</h3>
                    <ul class="social-icons social-icons-styled">
                        <li class="mr-1"><a href="https://www.facebook.com/ra.sarnav" target="_blank" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                        <li class="mr-1"><a href="https://x.com/ruh4nX" target="_blank" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                        <li class="mr-1"><a href="https://www.linkedin.com/in/ruhan-ahsan" target="_blank" class="linkedin-bg"><i class="la la-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 responsive-column-half">
                <div class="footer-item">
                    <h3 class="fs-20 font-weight-semi-bold">Company</h3>
                    <span class="section-divider section--divider"></span>
                    <ul class="generic-list-item">
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="{{ route('instructor.register') }}">Become a Teacher</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 responsive-column-half">
                <div class="footer-item">
                    <h3 class="fs-20 font-weight-semi-bold">Courses</h3>
                    <span class="section-divider section--divider"></span>
                    <ul class="generic-list-item">
                        @if(function_exists('getCategories'))
                            @foreach(getCategories()->take(6) as $category)
                            <li><a href="#">{{ $category->name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 responsive-column-half">
                <div class="footer-item">
                    <h3 class="fs-20 font-weight-semi-bold">Download App</h3>
                    <span class="section-divider section--divider"></span>
                    <div class="mobile-app">
                        <p class="pb-3 lh-24">Download our mobile app and learn on the go.</p>
                        <a href="#" class="d-block mb-2 hover-s"><img src="{{ asset('images/appstore.png') }}" alt="App store" class="img-fluid"></a>
                        <a href="#" class="d-block hover-s"><img src="{{ asset('images/googleplay.png') }}" alt="Google play store" class="img-fluid"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-block"></div>
    <div class="copyright-content py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <p class="copy-desc">&copy; {{ date('Y') }} Cyduca. All Rights Reserved.</p>
                </div>
                <div class="col-lg-6">
                    <div class="d-flex flex-wrap align-items-center justify-content-end">
                        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                            <li class="mr-3"><a href="#">Terms & Conditions</a></li>
                            <li class="mr-3"><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
