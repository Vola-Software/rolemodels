<div class="app-header header-shadow">
	<div class="container kero-container">
		<div class="app-header__mobile-menu">
			<div>
				<button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</div>
		</div>
		<div class="app-header__logo">
			<a href="{{url('/')}}" data-toggle="tooltip" data-placement="bottom" title="Име на платформа">
				<h3> Платформа за ролеви модели </h3>
			</a>
		</div>
		<ul class="horizontal-nav-menu">
			@if(Auth::check())
			<li class="dropdown">
				<a href="{{url('visits')}}">
					<i class="fas fa-rocket"></i>
					<span>Посещения</span>
				</a>
			</li>
			@if(Auth::user()->isProfessional())
			<li class="dropdown">
				<a href="{{url('my-visits')}}">
					<i class="fas fa-users"></i>
					<span>Моите посещения</span>
				</a>
			</li>
			@endif
			@if(Auth::user()->isCompanyAdmin())
			<li class="dropdown">
				<a href="{{url('my-visits')}}">
					<i class="fas fa-building"></i>
					<span>Посещения от компанията</span>
				</a>
			</li>
			@endif
			@if(Auth::user()->hasAdminAccess() || Auth::user()->isCompanyAdmin())
			<li class="dropdown">
				<a href="{{url('users')}}">
					<i class="fas fa-users"></i>
					<span>Потребители</span>
				</a>
			</li>
			@endif
			@if(Auth::user()->hasAdminAccess())
			<li class="dropdown">
				<a href="{{url('schools')}}">
					<i class="fas fa-school"></i>
					<span>Училища</span>
				</a>
			</li>
			<li class="dropdown">
				<a href="{{url('cities')}}">
					<i class="fas fa-city"></i>
					<span>Населени места</span>
				</a>
			</li>
			@endif

			@if(Auth::user()->isTeacher() || Auth::user()->isProfessional())
			<li class="dropdown">
				<a  data-toggle="dropdown" data-offset="10" data-display="static" aria-expanded="false">
					<span>Полезни ресурси </span>
					<i class="fas fa-chevron-down"></i>
				</a>
				<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-lg">
					<div class="scroll-area-xs">
						<div class="scrollbar-container">
							<a class="dropdown-item" href="{{url('/useful-resources/Safeguarding_Children_Policy_Final_Sep_2018.pdf')}}">
								<i class="fas fa-file-download"></i>
								Вътрешноорганизационна политика за действия при деца в риск
							</a>
							@if(Auth::user()->isTeacher())
								<a class="dropdown-item" href="{{url('/useful-resources/Checklist.pdf')}}">
									<i class="fas fa-file-download"></i>
									Чеклист за работа с ролеви модел
								</a>
								<a class="dropdown-item" href="{{url('/useful-resources/Важни_важности_за_ролевите_модели_в_класната_стая.pdf')}}">
									<i class="fas fa-file-download"></i>
									Важни детайли
								</a>
								<a class="dropdown-item" href="{{url('/useful-resources/История_от_класната_стая.pdf')}}">
									<i class="fas fa-file-download"></i>
									История от класната стая
								</a>
							@endif
						</div>
					</div>
				</div>
			</li>
			@endif

				<!--
				<li class="dropdown">
					<a href="_teacher_polls.html">
						<i class="nav-icon-big typcn typcn-document"></i>
						<span>Анкети</span>
					</a>
				</li>
				<li class="dropdown">
					<a  data-toggle="dropdown" data-offset="10" data-display="static" aria-expanded="false" disabled="disabled">
						<i class="nav-icon-big typcn typcn-lightbulb"></i>
						<span>Ресурси (очаквайте) </span>
					</a>
				</li>
			-->
			@else
			<li class="dropdown">
				<a href="{{url('login')}}">
					<span>Вход</span>
				</a>
			</li>
			<li class="dropdown">
				<a href="{{url('register?role=teacher')}}">
					<span>Регистрация на учител</span>
				</a>
			</li>
			<li class="dropdown">
				<a href="{{url('register?role=professional')}}">
					<span>Регистрация на ролеви модел</span>
				</a>
			</li>
			@endif
		</ul>

		@if(Auth::check())        
		<div class="app-header-right">
			<div class="header-btn-lg pr-0">
				<div class="widget-content p-0">
					<div class="widget-content-wrapper">
						<div class="widget-content-left">
							<div class="btn-group">
								<a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
									<img width="42" class="rounded" src="{{asset('images/avatars/_avatar.jpg')}}" alt="">
									<i class="fas fa-caret-down"></i>
								</a>
								<div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
									<div class="dropdown-menu-header">
										<div class="dropdown-menu-header-inner bg-info">
											<div class="menu-header-image opacity-2" style="background-image: url('assets/images/dropdown-header/city1.jpg');"></div>
											<div class="menu-header-content text-left">
												<div class="widget-content p-0">
													<div class="widget-content-wrapper">
														<div class="widget-content-left mr-3">
															@if(Auth::user()->role_id === config('consts.ROLE_ID_TEACHER'))
															<i class="fas fa-chalkboard-teacher fa-3x"></i>
															@elseif(Auth::user()->role_id === config('consts.ROLE_ID_PROFESSIONAL') || Auth::user()->role_id === config('consts.ROLE_ID_COMPANY_ADMIN'))
															<i class="fas fa-user-astronaut fa-3x"></i>
															@else
															<i class="fas fa-user fa-3x"></i>
															@endif
														</div>
														<div class="widget-content-left">
															<div class="widget-heading">{{Auth::user()->fullNames}}
															</div>
															<div class="widget-subheading opacity-8">
																{{Auth::user()->role->name}}
															</div>
														</div>
														<div class="widget-content-right mr-2">
															<button class="btn-pill btn-shadow btn-shine btn btn-focus" href="{{ route('logout') }}" onclick="event.preventDefault();
															document.getElementById('logout-form').submit();">
															Изход
														</button>
														<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
															@csrf
														</form>
													</div>

												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="scroll-area-xs" style="height: 150px;">
									<div class="scrollbar-container ps">
										<ul class="nav flex-column">
											<li class="nav-item">
												<a class="btn-icon-vertical btn-square btn-transition btn btn-outline-link" href="{{url('profile')}}">
													<i class="fas fa-cog icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
													Настойки
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>  
	</div>
	@endif
</div>
</div>