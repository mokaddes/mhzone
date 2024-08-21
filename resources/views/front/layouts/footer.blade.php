<footer class="footer_section text-center mt-5 {{ request()->is('login') ? 'fixed-bottom' : '' }} {{ request()->is('signup') ? 'fixed-bottom' : '' }}">
    <div class="container">
        <div class="md:d-flex justify-content-between align-items-center">
            <div class="copyright">
                <p>Copyright © erthoo. All rights reserved.</p>
            </div>
            <div class="footer_menu">
                <ul class="d-flex align-items-center justify-content-center">
                    <li><a href="{{ route('frontend.privacyPolicy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('frontend.termsCondition') }}">Terms & Conditions</a></li>
                    <li><a href="{{ route('frontend.about-us') }}">About Us</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
