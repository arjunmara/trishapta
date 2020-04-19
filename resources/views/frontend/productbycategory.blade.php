@extends('frontend.layouts.master')
@section('frontend-content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend.layouts.sidebar')
                <div class="col-sm-9 padding-right">
                    @if($data['products']->isNotEmpty())
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center">{{--{{$data['secondaryCategory']}}--}} Secondary Category Items</h2>
                            @foreach($data['products'] as $featured_product)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{asset($image_url.$featured_product->featured_image)}}"
                                                     alt=""/>
                                                <h2>Rs. {{$featured_product->price}}</h2>
                                                @if(strlen($featured_product->title) < 40)
                                                    <br/>
                                                    <p>{{$featured_product->title }}</p>
                                                @elseif(strlen($featured_product->title) > 65)
                                                    <p>{{substr($featured_product->title,0,50).'...'}} </p>
                                                @else
                                                    <p>{{$featured_product->title }}</p>
                                                @endif
                                                <a href="{{route('frontend.product.detail',['id' => $featured_product->id])}}"
                                                   class="btn btn-default add-to-cart"><i
                                                            class="fa fa-eye"></i>View Details</a>
                                            </div>
                                            <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <h2>Rs. {{$featured_product->price}}</h2>
                                                    @if(strlen($featured_product->title) < 40)
                                                        <br/>
                                                        <p>{{$featured_product->title }}</p>
                                                    @elseif(strlen($featured_product->title) > 65)
                                                        <p>{{substr($featured_product->title,0,50).'...'}} </p>
                                                    @else
                                                        <p>{{$featured_product->title }}</p>
                                                    @endif
                                                    <a href="{{route('frontend.product.detail',['id' => $featured_product->id])}}"
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
                            @endforeach
                        </div><!--features_items-->

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
