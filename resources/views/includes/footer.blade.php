<footer>
    <div class="container container-custom">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="foot-contact-block">
                    <!-- <img src="images/foot-logo.png" class="img-fluid" alt="#" /> -->
                    <p>
                        {{ DB::table('sitesettings')->where('id', 1)->first()->footertextenglish }}
                    </p>
                    <a href="https://demo.web3canvas.com/cdn-cgi/l/email-protection#f39a9d959cb39e969796979a9ddd909c9e">
                        <h4><i class="far fa-envelope"></i><span class="__cf_email__" data-cfemail="7f161119103f121a1b1a1b1611511c1012">Report a Problem</span></h4>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-2 offset-lg-1 col-6">
                <div class="foot-link-box">
                    <h4>About this site</h4>
                    <ul>
                        <li>
                            <a href="{{url('blogs')}}"><i class="fas fa-angle-double-right"></i>Our Blogs</a>
                        </li>
                        <li>
                            <a href="{{url('contact')}}"><i class="fas fa-angle-double-right"></i>About Us</a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-angle-double-right"></i>Support Us</a>
                        </li>
                        <li>
                            <a href="{{url('contact')}}"><i class="fas fa-angle-double-right"></i>Contact Us</a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-angle-double-right"></i>FAQ</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-2 col-6">
                <div class="foot-link-box">
                    <h4>Terms of Use</h4>
                    <ul>
                        <li>
                            <a href="#"><i class="fas fa-angle-double-right"></i>Patient Confidentiality</a>
                        </li>
<!--                         <li>
                            <a href="{{ url('case-guide') }}"><i class="fas fa-angle-double-right"></i>Case Style Guide</a>
                        </li> -->
                        <li>
                            <a href="#"><i class="fas fa-angle-double-right"></i>Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-angle-double-right"></i>Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php 
                $facebook =  DB::table('sitesettings')->where('id', 1)->first()->facebook; 
                $twitter = DB::table('sitesettings')->where('id', 1)->first()->twitter;
                $instagram = DB::table('sitesettings')->where('id', 1)->first()->instagram;
                $linkdlin = DB::table('sitesettings')->where('id', 1)->first()->linkdlin;
              ?>
            <div class="col-md-4 col-lg-2 offset-lg-1">
                <div class="foot-link-box">
                    <h4>Follow Us</h4>
                    <div class="foot-link-box footlink-box_btn">
                        <ul>
                            @if(!empty($facebook))
                              <li><a href="{{ $facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                              @endif
                              @if(!empty($instagram))
                              <li><a href="{{ $instagram }}"><i class="fab fa-instagram"></i></a></li>
                              @endif
                              @if(!empty($twitter))
                              <li><a href="{{ $twitter }}"><i class="fab fa-twitter"></i></a></li>
                              @endif
                              @if(!empty($linkdlin))
                              <li><a href="{{ $linkdlin }}"><i class="fab fa-linkedin"></i></a></li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-text-center">
                <div class="copyright">
                    <p>© Osteosynthesis 2020 Allright Reserved</p>
                    <a href="#" id="scroll"><i class="fas fa-angle-double-up"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>