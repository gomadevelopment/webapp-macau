<!-- ============================ Footer Start ================================== -->
<footer class="dark-footer skin-dark-footer">
    <div>
        <div class="container">
            <div class="row">
                
                <div class="col-lg-6 col-md-6">
                    <div class="footer-widget">
                        <img src="{{asset('/assets/landing_page/logo/PortuguêsàVista_Negativo.svg')}}" class="logo" alt="" style="width: 26%;" />
                        <div class="footer-add">
                            <p class="supported_label">Supported by Higher Education Fund of Macao SAR Government</p>
                            <img class="university_logo d-block mb-3" src="{{asset('/assets/landing_page/illustrations/logomacau_Negativo.svg')}}" alt="">
                            <p>4967 Sardis Sta, Victoria 8007,  Macau.</p>
                            <p>+1 246-345-0695</p>
                            <p>info@ptavista.com</p>
                        </div>
                        
                    </div>
                </div>

                <div class="col-lg-1 col-md-1"></div>

                <div class="col-lg-2 col-md-2">
                    <div class="footer-widget">
                        <h4 class="widget-title">{{ isset($pt_lang) && $pt_lang ? 'Informação' : 'Information' }}</h4>
                        <ul class="footer-menu">
                            <li><a href="#">{{ isset($pt_lang) && $pt_lang ? 'Sobre nós' : 'About us' }}</a></li>
                            <li><a href="#">FAQ’s</a></li>
                            <li><a href="#">{{ isset($pt_lang) && $pt_lang ? 'Privacidade' : 'Privacy Policy' }}</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-3">
                    <div class="footer-widget">
                        <h4 class="widget-title">{{ isset($pt_lang) && $pt_lang ? 'Ajuda e Suporte' : 'Help and Support' }}</h4>
                        <ul class="footer-menu">
                            <li><a href="#">{{ isset($pt_lang) && $pt_lang ? 'Documentação' : 'Documentation' }}</a></li>
                            <li><a href="#">{{ isset($pt_lang) && $pt_lang ? 'Envia-nos um E-mail' : 'Send us an E-mail' }}</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                    <p class="mb-0">
                        @if(isset($pt_lang) && $pt_lang)
                            © 2020 PortuguêsàVista. Desenhado e desenvolvido por 
                        @elseif(isset($en_lang) && $en_lang)
                            © 2020 PortuguêsàVista. Designed e developed by 
                        @endif
                        <a href="https://gomadevelopment.pt/" target="_blank">GOMA Development</a>.
                    </p>
                </div>
                
                <div class="col-xs-6 col-sm-5 col-md-4 col-lg-4 text-right">
                    <ul class="footer-bottom-social">
                        <li><a href="#"><img src="{{asset('/assets/landing_page/social_icons/facebook.svg')}}" alt=""></a></li>
                        <li><a href="#"><img src="{{asset('/assets/landing_page/social_icons/instagram.svg')}}" alt=""></a></li>
                        <li><a href="#"><img src="{{asset('/assets/landing_page/social_icons/twitter.svg')}}" alt=""></a></li>
                        <li><a href="#"><img src="{{asset('/assets/landing_page/social_icons/linkedin.svg')}}" alt=""></a></li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</footer>
<!-- ============================ Footer End ================================== -->