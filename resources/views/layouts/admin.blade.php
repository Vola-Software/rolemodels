<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Language" content="bg">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Ролеви модели</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
	/>
	<meta name="description" content="Платформа за посещения на ролеви модели в училище">

	<!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/favicons/site.webmanifest')}}">

	<!-- Disable tap highlight on IE -->
	<meta name="msapplication-tap-highlight" content="no">

	<link href="{{asset('css/main.4e74689db090db0fe094.css')}}" rel="stylesheet">
	<link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
	@yield('header_scripts')

	<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-76897400-11"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      var gak = '{{ env('GOOGLE_ANALYTICS_KEY') }}';
      gtag('config', gak);
    </script>
</head>

<body>
	<div class="app-container app-theme-white">
		@include('includes.admin_header')

		<div class="app-main__outer">
			<div class="app-main__inner">
				<div class="app-page-title">

				</div>
				<div class="container kero-container" id="main-content">
					@yield('content')
				</div>
				<div class="app-wrapper-footer">
					<div class="app-footer">
						<div class="container kero-container">
							<div class="app-footer__inner">
								<div class="app-footer-left">
									<div class="avatar-icon rounded">
                                        <a href="https://zaednovchas.bg" target="_blank">
	                                        <img src="{{asset('images/zvch_logo.png')}}" alt="Заедно в час - лого"/>
	                                    </a>
                                    </div>
									rolemodels.bg <БЕТА> &copy; 2020
								</div>
								<div class="app-footer-left" style="margin-left: 10px;">
                                    Компании партньори: 
                                    <div>
                                        <a href="https://www.hpe.com/emea_europe/en/home.html" target="_blank">
	                                        <img src="{{asset('images/hpe.png')}}" alt="HP Enterprice - лого"/>
	                                    </a>
                                    </div>
                                    <div>
                                    	<a href="https://bg.coca-colahellenic.com/bg" target="_blank">
                                        	<img src="{{asset('images/cocacola.png')}}" alt="Кока-кола - лого"/>
                                        </a>
                                    </div>
								</div>
								<div class="app-footer-right">
									При технически проблем пишете на &nbsp; <a href="mailto:tech@volasoftware.com"> tech@volasoftware.com </a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="{{asset('js/main.4e74689db090db0fe094.js')}}"></script>
	@yield('footer_scripts')
</body>
</html>
