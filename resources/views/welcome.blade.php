@extends('layouts.admin')

@section('content')
@include('includes.flash_msgs')
<div class="main-card mb-3 card mt-4">    
    <div class="card-body">
        <div class="tab-content">
            <div class="mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg font-weight-normal text-wrap">
                        Онлайн платформа, която помага на учители да организират посещения на ролеви модели в класните си стаи
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                        <a href="{{url('/register?role=professional')}}" class="btn-wide btn-outline-2x mr-md-2 btn btn-outline-focus btn-sm"> Стани ролеви модел </a>
                    </div>
                </div>
                <div class="no-gutters row">
                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                            <div class="icon-wrapper rounded-circle">
                                <div class="icon-wrapper-bg opacity-9 bg-success"></div>
                                <i class="fas fa-rocket text-white"></i>
                            </div>
                            <div class="widget-chart-content">
                                <div class="widget-subheading font-size-lg">Вдъхновяващи посещения</div>
                                <div class="widget-numbers text-success"><span>75</span></div>
                                <div class="widget-description opacity-8 text-focus">
                                    <i class="fas fa-city"></i>
                                    <span class="text-info pl-1">
                                        <span class="pl-1">24</span>
                                    </span>
                                    Населени места
                                </div>
                            </div>
                        </div>
                        <div class="divider m-0 d-md-none d-sm-block"></div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                            <div class="icon-wrapper rounded-circle">
                                <div class="icon-wrapper-bg opacity-10 bg-warning"></div>
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <div class="widget-chart-content">
                                <div class="widget-subheading font-size-lg">Учители</div>
                                <div class="widget-numbers">254</div>
                                <div class="widget-description opacity-8 text-focus">
                                    <div class="d-inline text-danger pr-1">
                                        <i class="fas fa-school"></i>
                                        <span class="pl-1">31</span>
                                    </div>
                                    училища
                                </div>
                            </div>
                        </div>
                        <div class="divider m-0 d-md-none d-sm-block"></div>
                    </div>

                    <div class="col-sm-12 col-md-4 col-xl-4">
                        <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                            <div class="icon-wrapper rounded-circle">
                                <div class="icon-wrapper-bg opacity-9 bg-danger"></div>
                                <i class="fas fa-user-astronaut text-white"></i></div>
                                <div class="widget-chart-content">
                                    <div class="widget-subheading font-size-lg">Ролеви модели</div>
                                    <div class="widget-numbers"><span>53</span></div>
                                    <div class="widget-description text-focus">

                                        <span class="text-warning pl-1">
                                            <i class="fas fa-industry"></i>
                                            <span class="pl-1">7</span>
                                        </span>
                                        Компании
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center d-block p-3 card-footer">
                        <a href="{{url('/visits')}}" class="btn-pill btn-wide fsize-1 btn btn-primary">
                            <span class="mr-2 opacity-7">
                                <i class="fas fa-map-marked-alt"></i>
                            </span>
                            <span class="mr-1">Виж актуални заявки за посещение на класни стаи</span>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-xl-3">
                        <div class="mb-3 card">
                            <div class="card-header-tab box-header">
                                <div class="font-size-lg text-center">
                                    За учители
                                </div>
                            </div>

                            <div class="widget-chart widget-chart2 text-left p-0">
                                <div class="widget-chart-content box-content">
                                    <div class="widget-title opacity-9 text-muted text-center">
                                        Ангажирай успешни професионалисти в успеха на твоите ученици. 
                                        <p> Мотивирай учениците си за високи постижения! </p>
                                        <a href="{{url('/for-teachers')}}" class="btn btn-primary"> Виж още </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xl-3">
                        <div class="mb-3 card">
                            <div class="card-header-tab box-header">
                                <div class="font-size-lg text-center">
                                    За професионалисти
                                </div>
                            </div>

                            <div class="widget-chart widget-chart2 text-left p-0">
                                <div class="widget-chart-content box-content">
                                    <div class="widget-title opacity-9 text-muted text-center">
                                        Посети училище, разкажи за своята работа
                                        <p> Вдъхнови ученици! </p>
                                        <br> <br>
                                        <a href="{{url('/for-role-models')}}" class="btn btn-primary"> Виж още </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xl-3">
                        <div class="mb-3 card">
                            <div class="card-header-tab box-header">
                                <div class="font-size-lg text-center">
                                    За училища
                                </div>
                            </div>

                            <div class="widget-chart widget-chart2 text-left p-0">
                                <div class="widget-chart-content box-content">
                                    <div class="widget-title opacity-9 text-muted text-center">
                                        Ангажирайте успешни хора за успеха на своите ученици
                                        <p> Намерете партньори! </p>
                                        <br> <br>
                                        <a href="{{url('/for-schools')}}" class="btn btn-primary"> Виж още </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xl-3">
                        <div class="mb-3 card">
                            <div class="card-header-tab box-header">
                                <div class="font-size-lg text-center">
                                    За компании
                                </div>
                            </div>

                            <div class="widget-chart widget-chart2 text-left p-0">
                                <div class="widget-chart-content box-content">
                                    <div class="widget-title opacity-9 text-muted text-center">
                                        Ангажирайте своите служители в CSR кампании
                                        <p> Срещнете бъдещи таланти! </p>
                                        <br> <br>
                                        <a href="{{url('/for-companies')}}" class="btn btn-primary"> Виж още </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!--
                        TODO: make carousel - https://stackoverflow.com/questions/20007610/bootstrap-carousel-multiple-frames-at-once
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="card-shadow-primary card-border mb-3 profile-responsive card">
                            <div class="dropdown-menu-header">
                                <div class="dropdown-menu-header-inner bg-alternate">
                                    <div class="menu-header-image opacity-2" style="background-image: url({{asset('images/backgrounds/abstract3.jpg')}});"></div>
                                    <div class="menu-header-content btn-pane-right">
                                        <div class="avatar-icon-wrapper mr-3 avatar-icon-xl btn-hover-shine">
                                            <div class="avatar-icon rounded">
                                                <img src="{{asset('images/avatars/MariaKaranedeva.jpg')}}" alt="Maria Karanedeva Avatar"/>
                                            </div>
                                        </div>
                                        , 
                                        <div><h5 class="menu-header-title">Мария Каранедева</h5><h6 class="menu-header-subtitle">ръководител „Национални ключови клиенти“,
Кока-Кола ХБК България</h6></div>
                                        <div class="menu-header-btn-pane">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="widget-content pt-2 pl-0 pb-2 pr-0">
                                        <div class="text-center">
                                            <h5 class="widget-heading opacity-8 mb-0">Когато завърших своето образование и за миг не си представях, че ще се върна
отново в класната стая. „Заедно в час“ ми дадоха тази възможност – да се върна, но
не сред, а пред учениците – да имам възможност да споделя своите знания, умения и
да вдъхновя бъдещите лидери – това наистина си заслужава. Опитайте – със
сигурност ще ви хареса!</h5>
</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="card-shadow-primary card-border mb-3 profile-responsive card">
                            <div class="dropdown-menu-header">
                                <div class="dropdown-menu-header-inner bg-alternate">
                                    <div class="menu-header-image opacity-2" style="background-image: url({{asset('images/backgrounds/abstract2.jpg')}});"></div>
                                    <div class="menu-header-content btn-pane-right">
                                        <div class="avatar-icon-wrapper mr-3 avatar-icon-xl btn-hover-shine">
                                            <div class="avatar-icon rounded">
                                                <img src="{{asset('images/avatars/EmilMyankov.png')}}" alt="Emil Myankov Avatar"/>
                                            </div>
                                        </div>
                                        <div><h5 class="menu-header-title">Емил Мянков</h5><h6 class="menu-header-subtitle">ръководител „Търговски канали за незабавна консумация“ , Кока-
Кола ХБК България</h6></div>
                                        <div class="menu-header-btn-pane">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="widget-content pt-2 pl-0 pb-2 pr-0">
                                        <div class="text-center">
                                            <h5 class="widget-heading opacity-8 mb-0">
                                                Срещите ми с ученици са едно от най-вълнуващите преживявания за мен. Защо го
правя? Основно, защото младите хора са отворени, любопитни и искат да научат
повече за света, извън училище. В своя живот, те получават насоки как да правят
нещата, а не защо да ги правят. Именно това е причината, която ме кара да се срещям
с тях – да бъда човекът, който им дава перспективата „Защо?“.
                                            </h5>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    -->

                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="card-shadow-primary card-border mb-3 profile-responsive card">
                            <div class="dropdown-menu-header">
                                <div class="dropdown-menu-header-inner bg-alternate">
                                    <div class="menu-header-image opacity-2" style="background-image: url({{asset('images/backgrounds/abstract2.jpg')}});"></div>
                                    <div class="menu-header-content btn-pane-right">
                                        <div class="avatar-icon-wrapper mr-3 avatar-icon-xl btn-hover-shine">
                                            <div class="avatar-icon rounded">
                                                <img src="{{asset('images/avatars/NikoletaHalimanova.png')}}" alt="Nikoleta Halimanova Avatar"/>
                                            </div>
                                        </div>
                                        <div><h5 class="menu-header-title">Николета Калиманова-Халил</h5><h6 class="menu-header-subtitle">Бизнес анализатор, HPE</h6></div>
                                        <div class="menu-header-btn-pane">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="widget-content pt-2 pl-0 pb-2 pr-0">
                                        <div class="text-center">
                                            <h5 class="widget-heading opacity-8 mb-0">
                                                Във всяко дете се крият потенциал, умения и таланти, които заедно можем да събудим, насърчаваме и развиваме. Част съм от инициативата „Ролеви модели“, защото искам да помогна на децата да повярват в себе си, да се почувстват уверени и да следват смело мечтите си. Обичам да споделям с тях любим цитат „Единственото ограничение е твоето въображение.“ Радвам се, когато успея да запаля в тях огъня на любопитството и им дам мотивация да се развиват, да търсят решения и да откриват нови светове, които да ги обогатят и да им помогнат да станат успешни хора.
                                            </h5>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="card-shadow-primary card-border mb-3 profile-responsive card">
                            <div class="dropdown-menu-header">
                                <div class="dropdown-menu-header-inner bg-alternate">
                                    <div class="menu-header-image opacity-2" style="background-image: url({{asset('images/backgrounds/abstract2.jpg')}});"></div>
                                    <div class="menu-header-content btn-pane-right">
                                        <div class="avatar-icon-wrapper mr-3 avatar-icon-xl btn-hover-shine">
                                            <div class="avatar-icon rounded">
                                                <img src="{{asset('images/avatars/PlamenMargaritov.png')}}" alt="Plamen Margaritov Avatar"/>
                                            </div>
                                        </div>
                                        <div><h5 class="menu-header-title">Пламен Маргаритов</h5><h6 class="menu-header-subtitle">учител, ЧСУ Цар Симеон Велики</h6></div>
                                        <div class="menu-header-btn-pane">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="widget-content pt-2 pl-0 pb-2 pr-0">
                                        <div class="text-center">
                                            <h5 class="widget-heading opacity-8 mb-0">
                                                За моите ученици най-ценна бе възможността да представят своя туристически уеб-сайт пред водещи представители на Coca Cola. Младежите разбраха, че техните идеи могат да излязат отвъд пределите на класната стая и да бъдат началото на смислен бъдещ проект.
                                            </h5>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="card-shadow-primary card-border mb-3 profile-responsive card">
                            <div class="dropdown-menu-header">
                                <div class="dropdown-menu-header-inner bg-alternate">
                                    <div class="menu-header-image opacity-2" style="background-image: url({{asset('images/backgrounds/abstract2.jpg')}});"></div>
                                    <div class="menu-header-content btn-pane-right">
                                        <div class="avatar-icon-wrapper mr-3 avatar-icon-xl btn-hover-shine">
                                            <div class="avatar-icon rounded">
                                                <img src="{{asset('images/avatars/AngelinaGrigorova.png')}}" alt="Angelina Grigorova Avatar"/>
                                            </div>
                                        </div>
                                        <div><h5 class="menu-header-title">Ангелина Григорова</h5><h6 class="menu-header-subtitle">експерт „Корпоративна социална отговорност“ , Кока-Кола
ХБК България</h6></div>
                                        <div class="menu-header-btn-pane">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="widget-content pt-2 pl-0 pb-2 pr-0">
                                        <div class="text-center">
                                            <h5 class="widget-heading opacity-8 mb-0">
                                                За последните 4 години, 17 служители от
Системата на Кока-Кола в България посетиха над 20 учебни заведения, благодарение
на партньорството ни със „Заедно в час“. Те отделиха повече от 260 доброволчески
часа, но отвъд цифрите, всеки един от тези часове е безценен, защото е бил полезен
както за учениците, така и за нашите колеги. Вярвам, че вдъхновението, знанието и
радостта, породени от тези срещи, са взаимни!
                                            </h5>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endsection
