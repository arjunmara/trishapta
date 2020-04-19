@extends('frontend.layouts.master')
@section('frontend-content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @if($data['categories']->isNotEmpty())
                                @foreach($data['categories'] as $category)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordian"
                                                   href="#cat_{{$category->id}}">
                                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                    {{$category->title}}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="cat_{{$category->id}}" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <ul>
                                                    @if($category->SecondaryCategories->isNotEmpty())
                                                        @foreach($category->SecondaryCategories as $secondaryCategory)
                                                            <li><a href="#">{{$secondaryCategory->title}} </a></li>
                                                        @endforeach
                                                    @endif

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div><!--/category-products-->

                        {{--<div class="brands_products"><!--brands_products-->
                            <h2>Brands</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                                    <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                                    <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
                                    <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
                                    <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
                                    <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
                                    <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                                </ul>
                            </div>
                        </div><!--/brands_products-->--}}

                        <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="5000"
                                       data-slider-step="5" data-slider-value="[200,2000]" id="sl2"><br/>
                                <b class="pull-left">Rs 0</b> <b class="pull-right">Rs 5000</b>
                            </div>
                        </div><!--/price-range-->

                        {{-- <div class="shipping text-center"><!--shipping-->
                             <img src="images/home/shipping.jpg" alt=""/>
                         </div><!--/shipping-->--}}

                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    @if($data['products']->isNotEmpty())
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center">{{$data['type']}} Items</h2>
                            <?php $i = 0; ?>
                            @foreach($data['products'] as $featured_product)

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
                                                <a href="{{route('frontend.product.detail',['id' => $featured_product->id])}}"
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
                                <?php $i++ ?>
                                @if($i % 3 == 0)
                                    <div class="clearfix"></div>
                                @endif
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
