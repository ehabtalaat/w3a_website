       <!--content --->
       <div class="col-md-10 col-12">
        <div class="container ">
            <!---nav bar-->
            <div class="row nav_container">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">

 

                            <form class="form-nav">
                                <i class="fas fa-search"></i>
                                <input class="form-control me-2" id="nav-search" type="search"
                                    placeholder="اكتب كلمات للبحث هنا" aria-label="Search">
                            </form>
                            <ul class="navbar-nav">
                                <ul class="navbar-nav">
                                    <?php
                                    $other_locale = LaravelLocalization::getCurrentLocale() == "en" ? "Ar" : "En";
                                    $flag = LaravelLocalization::getCurrentLocale() == "ar" ? asset('assets/media/icons/usa.svg') : asset('assets/media/icons/saudi-arabia.svg');
                                    ?>
                                    <li class="nav-item ">
                                        {{-- <i class="far fa-question-circle"></i> --}}
    
                                        <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL(strtolower($other_locale), null, [], true) }}">
    
                                            <img class="flag" src="{{$flag}}" alt="" />
                                            <!-- {{$other_locale}} -->
                                        </a>
                                    </li>
                                <li class="nav-item ">
                                    <i class="far fa-bell"></i>
                                </li>
                                <img src="" class="image_navbar" alt="">
                                <div class="dropdown link_re">

                                    <a class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                       
                                    </a>

                                    <span class="nav_email">
                                     
                                    </span>
                                    <ul class="dropdown-menu dropdown-menu-custom"
                                        aria-labelledby="dropdownMenuButton1">
                                        {{-- <li><a class="dropdown-item" href="">حسابى</a></li> --}}
                                        <li><a class="dropdown-item" href=""> {{__('messages.logout')}}</a></li>
                                    </ul>
                                </div>

                            </ul>

                        </div>

                    </div>
                </nav>
                <button class="navbar-light navbar-toggler side_btn" type="button"  >
                    <span class="navbar-toggler-icon"></span>
                </button> 
            </div>
            <!---nav bar-->
            @yield("content")