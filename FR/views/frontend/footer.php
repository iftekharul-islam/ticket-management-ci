
    <!-- Footer -->
    <footer>
        <div class="footer-nav">
            <nav class="container" aria-label="Footer Navigation">
                <ul class="row">
                    <li class="col-md-3 nav-item">
                        <a class="d-block d-md-none" data-toggle="collapse" data-target="#connect" href="javascript:;">CONNECT <i class="lni-chevron-down-circle"></i></a>
                        <strong class="d-none d-md-block">CONNECT</strong>
                        <ul class="collapse d-md-block" id="connect">
                            <li><a href="<?=$site->facebook?>">Find Us on Facebook</a></li>
                            <li><a href="<?=$site->twitter?>">Find Us on Twitter</a></li>
                            <li><a href="<?=$site->instagram?>">Find Us on Instagram</a></li>
                        </ul>
                    </li>
                    <li class="col-md-3 nav-item">
                        <a class="d-block d-md-none" data-toggle="collapse" data-target="#company" href="javascript:;">COMPANY <i class="lni-chevron-down-circle"></i></a>
                        <strong class="d-none d-md-block">COMPANY</strong>
                        <ul class="collapse d-md-block" id="company">
                            <li><a href="contact">Contact Us</a></li>
                            <li><a href="about">About Us</a></li>
                            <li><a href="career">Career</a></li>
                        </ul>
                    </li>
                    <li class="col-md-3 nav-item">
                        <a class="d-block d-md-none" data-toggle="collapse" data-target="#gethelp" href="javascript:;">GET HELP <i class="lni-chevron-down-circle"></i></a>
                        <strong class="d-none d-md-block">INFORMATION</strong>
                        <ul class="collapse d-md-block" id="gethelp">
                            <li><a href="blog">888 Seats Blog</a></li>
                            <li><a href="faq">Frequently Asked Questions</a></li>
                            <li><a href="policies">Terms & Policies</a></li>
                        </ul>
                    </li>
                    <li class="col-md-3 nav-item">
                        <strong class="d-block">SIGN UP FOR NEWSLETTER</strong>
                        <div class="mt-2 mb-1">Enter your email</div>
                        <form action="newsletter" method="get" class="input-group newsletter-signup">
                            <input class="form-control" name="email" placeholder="" type="email">
                            <div class="input-group-append">
                                <button class="btn btn-gradient-reverse" type="button">
                                    SEND <i class="lni-arrow-right-circle"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="copyright-info">
            <div class="container">
                <div class="row flex-md-row-reverse align-items-center">
                    <div class="col-md-6 social-link">
                        <a href="tel:<?=$site->phone?>"><i class="lni-phone-handset"></i></a>
                        <a href="mailto:<?=$site->email?>"><i class="lni-envelope"></i></a>
                        <a href="<?=$site->facebook?>"><i class="lni-facebook-filled"></i></a>
                        <a href="<?=$site->twitter?>"><i class="lni-twitter-filled"></i></a>
                        <a href="<?=$site->instagram?>"><i class="lni-instagram"></i></a>
                    </div>
                    <div class="col-md-6 copyright">
                        <div class="footer-logo py-2 py-md-0">
                            <a href=""><img src="assets/logo/logo.png" alt="<?=$site->app_title?>" height="40"></a>
                        </div>
                        <div class="px-2 pt-1">
                            © <?=date('Y')?> <a href="<?=$site->footer_link?>"><?=$site->footer_text?></a>. All Rights Reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>     
    </footer>
    <!-- //end Footer -->
<!--[if lt IE 9]>
    <script src="assets/frontend/js/html5shiv.js"></script>
    <developed by M Fazle Rabby Khan. netrubby@gmail.com />
    <script src="assets/global/plugins/respond.min.js"></script>
<![endif]-->

<?=$site->before_body_end_tag?>

<script type="text/javascript" src="assets/home/js/script.js"></script>
</body>
</html>
