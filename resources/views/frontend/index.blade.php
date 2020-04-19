@extends('frontend.layouts.master')
@section('frontend-content')
    @if($data['homeslider']->isNotEmpty())
        <section id="slider"><!--slider-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @if($data['homeslider']->isNotEmpty())
                                    @for($j=0; $j < $data['homeslider']->count(); $j++)
                                        <li data-target="#slider-carousel" data-slide-to="{{$j}}"
                                            class="@if($j==0)active @endif"></li>
                                    @endfor
                                @endif
                            </ol>

                            <div class="carousel-inner">
                                <?php $i = 1; ?>

                                @foreach($data['homeslider'] as $slide)

                                    <div class="item @if($i++ == 1)active @endif">
                                        <div class="col-sm-12">
                                            <a href="{{$slide->product_link}}"><img
                                                        src="{{asset('assets/uploads/images/homeslider/'.$slide->title)}}"
                                                        class="img-responsive"/></a>
                                        </div>
                                    </div>

                                @endforeach

                            </div>

                            <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section><!--/slider-->
    @endif

    <section>
        <div class="container">
            <div class="row">
                @include('frontend.layouts.sidebar')
                <div class="col-sm-9 padding-right">
                   {{-- <div class="features_items"><!--Shortcut Button Ribbons-->
                        <h2 class="title text-center">Quick Menu</h2>
                        <div class="col-sm-4">
                            <a href="#">
                                <div class="product-image-wrapper" style="background-color: #ff0000; height: 70px;">
                                    <div class="single-products">
                                        <div class=" text-center">
                                            <h3 style="color: #fff; text-decoration: none;">Router</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="#">
                                <div class="product-image-wrapper" style="background-color: #ff0000; height: 70px;">
                                    <div class="single-products">
                                        <div class=" text-center">
                                            <h3 style="color: #fff; text-decoration: none;">SFP</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="#">
                                <div class="product-image-wrapper" style="background-color: #ff0000; height: 70px;">
                                    <div class="single-products">
                                        <div class=" text-center">
                                            <h3 style="color: #fff; text-decoration: none;">Splicing Machine</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="#">
                                <div class="product-image-wrapper" style="background-color: #ff0000; height: 70px;">
                                    <div class="single-products">
                                        <div class=" text-center">
                                            <h3 style="color: #fff; text-decoration: none;">Optical FIber Cable</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="#">
                                <div class="product-image-wrapper" style="background-color: #ff0000; height: 70px;">
                                    <div class="single-products">
                                        <div class=" text-center">
                                            <h3 style="color: #fff; text-decoration: none;">OLT</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="#">
                                <div class="product-image-wrapper" style="background-color: #ff0000; height: 70px;">
                                    <div class="single-products">
                                        <div class=" text-center">
                                            <h3 style="color: #fff; text-decoration: none;">ONU</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="#">
                                <div class="product-image-wrapper" style="background-color: #ff0000; height: 70px;">
                                    <div class="single-products">
                                        <div class=" text-center">
                                            <h3 style="color: #fff; text-decoration: none;">Mikrotik</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="#">
                                <div class="product-image-wrapper" style="background-color: #ff0000; height: 70px;">
                                    <div class="single-products">
                                        <div class=" text-center">
                                            <h3 style="color: #fff; text-decoration: none;">FTTH Node</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="#">
                                <div class="product-image-wrapper" style="background-color: #ff0000; height: 70px;">
                                    <div class="single-products">
                                        <div class=" text-center">
                                            <h3 style="color: #fff; text-decoration: none;">Drop Cable</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>--}}<!--Shortcut Button menus-->
                    @if(empty($data['searchProducts']))
                        @if($data['featured_products']->isNotEmpty())
                            <div class="features_items"><!--features_items-->
                                <h2 class="title text-center">Features Items</h2>
                                <?php $i = 0; ?>
                                @foreach($data['featured_products'] as $featured_product)
                                    <?php $i++ ?>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{asset($image_url.$featured_product->featured_image)}}"
                                                         alt=""/>
                                                    <h2>Rs. {{$featured_product->price}}</h2>
                                                    @if(strlen($featured_product->title) < 35)
                                                        <br/>
                                                        <p>{{$featured_product->title }}</p>
                                                    @elseif(strlen($featured_product->title) > 65)
                                                        <p>{{substr($featured_product->title,0,50).'...'}} </p>
                                                    @else
                                                        <p>{{$featured_product->title }}</p>
                                                    @endif
                                                    <a href="{{route('frontend.product.detail',['id' => $featured_product->id, 'title' =>$featured_product->title ])}}"
                                                       class="btn btn-default add-to-cart"><i
                                                                class="fa fa-eye"></i>View Details</a>
                                                </div>
                                                <div class="product-overlay">
                                                    <div class="overlay-content">
                                                        <h2>Rs. {{$featured_product->price}}</h2>
                                                        @if(strlen($featured_product->title) < 35)
                                                            <br/>
                                                            <p>{{$featured_product->title }}</p>
                                                        @elseif(strlen($featured_product->title) > 65)
                                                            <p>{{substr($featured_product->title,0,50).'...'}} </p>
                                                        @else
                                                            <p>{{$featured_product->title }}</p>
                                                        @endif
                                                        <a href="{{route('frontend.product.detail',['id' => $featured_product->id, 'title' =>$featured_product->title])}}"
                                                           class="btn btn-default add-to-cart"><i
                                                                    class="fa fa-eye"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--<div class="choose">
                                                <ul class="nav nav-pills nav-justified">
                                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                                </ul>
                                            </div>--}}
                                        </div>
                                    </div>
                                    @if($i % 3 == 0)
                                        <div class="clearfix"></div>
                                    @endif
                                @endforeach
                            </div><!--features_items-->
                            <div class="row">
                                <center>
                                    <a href="{{route('frontend.product.type',['type' => 'featured'])}}"
                                       class="btn btn-primary" style="margin-bottom: 30px;">All Featured
                                        Products</a>
                                </center>
                            </div>
                        @endif

                        @if($data['all_products']->isNotEmpty())
                            <div class="features_items"><!--all_items-->
                                <h2 class="title text-center">All Products</h2>
                                <?php $i = 0; ?>
                                @foreach($data['all_products'] as $all_product)
                                    <?php $i++ ?>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{asset($image_url.$all_product->featured_image)}}"
                                                         alt=""/>
                                                    <h2>Rs. {{$all_product->price}}</h2>
                                                    @if(strlen($all_product->title) < 35)
                                                        <br/>
                                                        <p>{{$all_product->title }}</p>
                                                    @elseif(strlen($all_product->title) > 65)
                                                        <p>{{substr($all_product->title,0,50).'...'}} </p>
                                                    @else
                                                        <p>{{$all_product->title }}</p>
                                                    @endif

                                                    <a href="{{route('frontend.product.detail',['id' => $all_product->id])}}"
                                                       class="btn btn-default add-to-cart"><i
                                                                class="fa fa-eye"></i>View Details</a>
                                                </div>
                                                <div class="product-overlay">
                                                    <div class="overlay-content">
                                                        <h2>Rs. {{$all_product->price}}</h2>
                                                        <p>{{$all_product->title}}</p>
                                                        <a href="{{route('frontend.product.detail',['id' => $all_product->id])}}"
                                                           class="btn btn-default add-to-cart"><i
                                                                    class="fa fa-eye"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--<div class="choose">
                                                <ul class="nav nav-pills nav-justified">
                                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a>
                                                    </li>
                                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                                </ul>
                                            </div>--}}
                                        </div>
                                    </div>

                                    @if($i % 3 == 0)
                                        <div class="clearfix"></div>
                                    @endif
                                @endforeach
                            </div><!--all_items-->
                            <div class="row">
                                <center>
                                    <a href="{{route('frontend.product.type',['type' => 'all'])}}"
                                       class="btn btn-primary"
                                       style="margin-bottom: 30px;">All Products</a>
                                </center>
                            </div>
                        @endif
                    @else
                        <div class="features_items"><!--Searched_items-->
                            <h2 class="title text-center">Best Matched Item(s)</h2>
                            <?php $i = 0; ?>
                            @if($data['searchProducts']->isNotEmpty())
                                @foreach($data['searchProducts'] as $searched_product)
                                    <?php $i++ ?>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{asset($image_url.$searched_product->featured_image)}}"
                                                         alt=""/>
                                                    <h2>Rs. {{$searched_product->price}}</h2>
                                                    <p>{{$searched_product->title}}</p>
                                                    <a href="{{route('frontend.product.detail',['id' => $searched_product->id])}}"
                                                       class="btn btn-default add-to-cart"><i
                                                                class="fa fa-eye"></i>View Details</a>
                                                </div>
                                                <div class="product-overlay">
                                                    <div class="overlay-content">
                                                        <h2>Rs. {{$searched_product->price}}</h2>
                                                        <p>{{$searched_product->title}}</p>
                                                        <a href="{{route('frontend.product.detail',['id' => $searched_product->id])}}"
                                                           class="btn btn-default add-to-cart"><i
                                                                    class="fa fa-eye"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--<div class="choose">
                                                <ul class="nav nav-pills nav-justified">
                                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                                </ul>
                                            </div>--}}
                                        </div>
                                    </div>
                                    @if($i % 3 == 0)
                                        <div class="clearfix"></div>
                                    @endif
                                @endforeach
                            @else
                                <p style="text-align: center;">No Items Found!! Please try again..</p>
                            @endif
                        </div><!--Searched_items-->
                @endif


                {{-- <div class="recommended_items"><!--recommended_items-->
                     <h2 class="title text-center">recommended items</h2>

                     <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                         <div class="carousel-inner">
                             <div class="item active">
                                 <div class="col-sm-4">
                                     <div class="product-image-wrapper">
                                         <div class="single-products">
                                             <div class="productinfo text-center">
                                                 <img src="images/home/recommend1.jpg" alt=""/>
                                                 <h2>$56</h2>
                                                 <p>Easy Polo Black Edition</p>
                                                 <a href="#" class="btn btn-default add-to-cart"><i
                                                             class="fa fa-shopping-cart"></i>Add to cart</a>
                                             </div>

                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-sm-4">
                                     <div class="product-image-wrapper">
                                         <div class="single-products">
                                             <div class="productinfo text-center">
                                                 <img src="images/home/recommend2.jpg" alt=""/>
                                                 <h2>$56</h2>
                                                 <p>Easy Polo Black Edition</p>
                                                 <a href="#" class="btn btn-default add-to-cart"><i
                                                             class="fa fa-shopping-cart"></i>Add to cart</a>
                                             </div>

                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-sm-4">
                                     <div class="product-image-wrapper">
                                         <div class="single-products">
                                             <div class="productinfo text-center">
                                                 <img src="images/home/recommend3.jpg" alt=""/>
                                                 <h2>$56</h2>
                                                 <p>Easy Polo Black Edition</p>
                                                 <a href="#" class="btn btn-default add-to-cart"><i
                                                             class="fa fa-shopping-cart"></i>Add to cart</a>
                                             </div>

                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="item">
                                 <div class="col-sm-4">
                                     <div class="product-image-wrapper">
                                         <div class="single-products">
                                             <div class="productinfo text-center">
                                                 <img src="images/home/recommend1.jpg" alt=""/>
                                                 <h2>$56</h2>
                                                 <p>Easy Polo Black Edition</p>
                                                 <a href="#" class="btn btn-default add-to-cart"><i
                                                             class="fa fa-shopping-cart"></i>Add to cart</a>
                                             </div>

                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-sm-4">
                                     <div class="product-image-wrapper">
                                         <div class="single-products">
                                             <div class="productinfo text-center">
                                                 <img src="images/home/recommend2.jpg" alt=""/>
                                                 <h2>$56</h2>
                                                 <p>Easy Polo Black Edition</p>
                                                 <a href="#" class="btn btn-default add-to-cart"><i
                                                             class="fa fa-shopping-cart"></i>Add to cart</a>
                                             </div>

                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-sm-4">
                                     <div class="product-image-wrapper">
                                         <div class="single-products">
                                             <div class="productinfo text-center">
                                                 <img src="images/home/recommend3.jpg" alt=""/>
                                                 <h2>$56</h2>
                                                 <p>Easy Polo Black Edition</p>
                                                 <a href="#" class="btn btn-default add-to-cart"><i
                                                             class="fa fa-shopping-cart"></i>Add to cart</a>
                                             </div>

                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <a class="left recommended-item-control" href="#recommended-item-carousel"
                            data-slide="prev">
                             <i class="fa fa-angle-left"></i>
                         </a>
                         <a class="right recommended-item-control" href="#recommended-item-carousel"
                            data-slide="next">
                             <i class="fa fa-angle-right"></i>
                         </a>
                     </div>
                 </div>--}}<!--/recommended_items-->

                </div>
            </div>
        </div>
    </section>

@endsection
