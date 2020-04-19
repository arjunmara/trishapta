<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i>+977-071540211, +977-9857074266, +977-061531912,+977-9856075266</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@trishapta.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="https://www.facebook.com/trishapta/" target="_blank"><i
                                            class="fa fa-facebook"></i></a></li>
                            {{--<li><a href="#"><i class="fa fa-twitter"></i></a></li>--}}
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            {{--<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{URL::to('/')}}"><img src="{{asset('frontend/images/trishapta.png')}}"
                                                        alt="Trishapta Logo" width="96" height="96"/></a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="single-widget">
                        <form action="{{route('frontend.product.search')}}" class="searchform" method="GET">
                            <input class="searchfrm" name="searchQuery" type="text" placeholder="Product Name..." height="100px;"/>
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{route('frontend.about')}}"><i class="fa fa-info"></i> About Us</a></li>
                            <li><a href="{{route('frontend.contact')}}"><i class="fa fa-phone"></i> Contact Us</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->
    <!-- Mega Menu -->
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                {{-- <a class="navbar-brand" href="#"><i class="fa fa-home"></i> Home</a>--}}
            </div>
            <div class="collapse navbar-collapse js-navbar-collapse" style="position:relative; z-index: 99999;">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{URL::to('/')}}"> <i class="fa fa-home"></i> Home</a></li>
                    <li class="dropdown mega-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-th-list"></i> All
                            Categories <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
                        <ul class="dropdown-menu mega-dropdown-menu row" style=" background: #cccccc;">
                            @if($data['categories']->isNotEmpty())
                                @foreach($data['categories'] as $category)
                                    <li class="col-sm-3">
                                        <ul style="position:relative; z-index: 99999;">
                                            <li class="dropdown-header"><i
                                                        class="fa fa-th-large"></i> {{$category->title}}</li>
                                            <li class="divider"></li>
                                            @if($category->SecondaryCategories->isNotEmpty())
                                                @foreach($category->SecondaryCategories as $secondaryCategory)
                                                    <li><a href="{{route('frontend.product.category',['category' => 'secondary','id' => $secondaryCategory->id])}}"><i class="fa fa-angle-double-right"></i> {{$secondaryCategory->title}}</a></li>
                                                @endforeach
                                            @endif
                                        </ul>

                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    {{--<li class="dropdown mega-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i>  Featured Products <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
                        <ul class="dropdown-menu mega-dropdown-menu row">
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header"><i class="fa fa-th-large"></i> Dresses</li>
                                    <li class="divider"></li>
                                    <li><a href="#">Unique Features</a></li>
                                    <li><a href="#">Image Responsive</a></li>
                                    <li><a href="#">Auto Carousel</a></li>
                                    <li><a href="#">Newsletter Form</a></li>
                                    <li><a href="#">Four columns</a></li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Jackets</li>
                                    <li class="divider"></li>
                                    <li><a href="#">Easy to customize</a></li>
                                    <li><a href="#">Glyphicons</a></li>
                                    <li><a href="#">Pull Right Elements</a></li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Accessories</li>
                                    <li class="divider"></li>
                                    <li><a href="#">Default Navbar</a></li>
                                    <li><a href="#">Lovely Fonts</a></li>
                                    <li><a href="#">Responsive Dropdown </a></li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Accessories</li>
                                    <li class="divider"></li>
                                    <li><a href="#">Default Navbar</a></li>
                                    <li><a href="#">Lovely Fonts</a></li>
                                    <li><a href="#">Responsive Dropdown </a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>--}}

                </ul>


            </div>
            <!-- /.nav-collapse -->
        </nav>
    </div>
    <!-- /Mega Menu -->


</header><!--/header-->
