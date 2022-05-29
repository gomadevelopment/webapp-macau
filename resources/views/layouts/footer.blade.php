<!-- ============================ Footer Start ================================== -->
<footer class="dark-footer skin-dark-footer">
    <div>
        <div class="container">
            <div class="row">
                
                <div class="col-lg-6 col-md-6">
                    <div class="footer-widget">
                        <img src="{{asset('/assets/landing_page/logo/PortuguêsàVista_Negativo.svg', config()->get('app.https'))}}?v=2.4" class="logo" alt="" style="width: 26%;" />
                        <div class="footer-add">
                            <p class="supported_label">Supported by Higher Education Fund of Macao SAR Government</p>
                            <img class="university_logo d-block mb-3" src="{{asset('/assets/landing_page/illustrations/logomacau_Negativo.svg', config()->get('app.https'))}}?v=2.4" alt="">
                            <p>Estrada Marginal da Ilha Verde, 14-17, Macau, China.</p>
                            <p>+853 8592 5600</p>
                            <p>info@portuguesavista.com</p>
                        </div>
                        
                    </div>
                </div>

                <div class="col-lg-4 col-md-4"></div>

                <div class="col-lg-2 col-md-2">
                    <div class="footer-widget">
                        <h4 class="widget-title">{{ isset($pt_lang) && $pt_lang ? 'Informação' : 'Information' }}</h4>
                        <ul class="footer-menu">
                            <li><a href="/ficha-tecnica">{{ isset($pt_lang) && $pt_lang ? 'Ficha Técnica' : 'Technical File' }}</a></li>
                            <li><a href="/faqs">FAQ’s</a></li>
                            <li><a href="/privacidade">{{ isset($pt_lang) && $pt_lang ? 'Privacidade' : 'Privacy Policy' }}</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <p class="mb-0">
                        @if(isset($pt_lang) && $pt_lang)
                            © 2020 PortuguêsàVista. Desenhado e desenvolvido por 
                        @elseif(isset($en_lang) && $en_lang)
                            © 2020 PortuguêsàVista. Designed e developed by 
                        @endif
                        <a href="https://gomadevelopment.pt/" target="_blank">GOMA Development</a>.
                    </p>
                </div>
                
                {{-- <div class="col-xs-6 col-sm-5 col-md-4 col-lg-4 text-right">
                    <ul class="footer-bottom-social">
                        <li><a href="#"><img src="{{asset('/assets/landing_page/social_icons/facebook.svg', config()->get('app.https'))}}?v=2.4" alt=""></a></li>
                        <li><a href="#"><img src="{{asset('/assets/landing_page/social_icons/instagram.svg', config()->get('app.https'))}}?v=2.4" alt=""></a></li>
                        <li><a href="#"><img src="{{asset('/assets/landing_page/social_icons/twitter.svg', config()->get('app.https'))}}?v=2.4" alt=""></a></li>
                        <li><a href="#"><img src="{{asset('/assets/landing_page/social_icons/linkedin.svg', config()->get('app.https'))}}?v=2.4" alt=""></a></li>
                    </ul>
                </div> --}}
                
            </div>
        </div>
    </div>
</footer>
<!-- ============================ Footer End ================================== -->
