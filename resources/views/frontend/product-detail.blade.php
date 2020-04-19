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
                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img id="zoom_03" src="{{asset($image_url.$data['row']->featured_image)}}"
                                     alt="{{$data['row']->title}}"/>
                                {{--<h3>ZOOM</h3>--}}
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active" id="gal1">
                                        <a href="#" data-image="{{asset($image_url.$data['row']->featured_image)}}"
                                           data-zoom-image="{{asset($image_url.$data['row']->featured_image)}}"> <img
                                                    id="zoom_03"
                                                    src="{{asset($image_url.$data['row']->featured_image)}}"
                                                    alt="{{$data['row']->title}}" width="85"
                                                    height="84"/></a>
                                        @foreach($data['row']->Images as $image)
                                            <a href="#" data-image="{{asset($image_url.$data['row']->featured_image)}}"
                                               data-zoom-image="{{asset($image_url.$data['row']->featured_image)}}"><img
                                                        id="zoom_03" src="{{asset($image_url.$image->title)}}"
                                                        width="85"
                                                        height="84" alt=""></a>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Controls -->
                                {{--<a class="left item-control" href="#similar-product" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right item-control" href="#similar-product" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>--}}
                            </div>

                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                {{--<img src="images/product-details/new.jpg" class="newarrival" alt=""/>--}}
                                <h2>{{$data['row']->title}}</h2>
                                {{-- <p>Web ID: 1089772</p>--}}
                                {{-- <img src="images/product-details/rating.png" alt=""/>--}}
                                <span>
									<span>Rs. {{$data['row']->price}} <a href="{{route('frontend.contact')}}"
                                                                         type="button" class="btn btn-fefault cart">
                                    <i class="fa fa-envelope"></i>
                                    Enquiry
                                </a></span>
                                    {{--	<label>Quantity:</label>
                                        <input type="text" value="3"/>--}}

								</span>
                                <span> </span>
                                <p><b>Availability:</b>@if($data['row']->stock == 1) In
                                    Stock @elseif($data['row']->stock == 0) Out Of
                                    Stock @elseif($data['row']->stock == 2) On Sale @endif</p>
                                {{-- <p><b>Condition:</b> New</p>--}}
                                {{-- <p><b>Brand:</b> E-SHOPPER</p>--}}
                                <a href=""><img src="images/product-details/share.png" class="share img-responsive"
                                                alt=""/></a>
                            </div><!--/product-information-->
                        </div>
                    </div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                                {{--<li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
                                <li><a href="#tag" data-toggle="tab">Tag</a></li>--}}
                                <li><a href="#reviews" data-toggle="tab">Reviews</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active fade in" id="details">
                                <div class="col-sm-12" style="padding: 0px 10px 0px 10px;">
                                    {!! $data['row']->description !!}
                                </div>

                            </div>

                            <div class="tab-pane fade in" id="reviews">
                                {{-- <div class="col-sm-12">
                                     <ul>
                                         <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                         <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                         <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                     </ul>
                                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                         incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis
                                         nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                         consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                         dolore eu fugiat nulla pariatur.</p>
                                     <p><b>Write Your Review</b></p>

                                     <form action="#">
                                         <span>
                                             <input type="text" placeholder="Your Name"/>
                                             <input type="email" placeholder="Email Address"/>
                                         </span>
                                         <textarea name=""></textarea>
                                         <b>Rating: </b> <img src="images/product-details/rating.png" alt=""/>
                                         <button type="button" class="btn btn-default pull-right">
                                             Submit
                                         </button>
                                     </form>
                                 </div>--}}
                                <p>Under Construction!</p>
                            </div>

                        </div>
                    </div><!--/category-tab-->

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
                                                 <button type="button" class="btn btn-default add-to-cart"><i
                                                             class="fa fa-shopping-cart"></i>Add to cart
                                                 </button>
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
                                                 <button type="button" class="btn btn-default add-to-cart"><i
                                                             class="fa fa-shopping-cart"></i>Add to cart
                                                 </button>
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
                                                 <button type="button" class="btn btn-default add-to-cart"><i
                                                             class="fa fa-shopping-cart"></i>Add to cart
                                                 </button>
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
                                                 <button type="button" class="btn btn-default add-to-cart"><i
                                                             class="fa fa-shopping-cart"></i>Add to cart
                                                 </button>
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
                                                 <button type="button" class="btn btn-default add-to-cart"><i
                                                             class="fa fa-shopping-cart"></i>Add to cart
                                                 </button>
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
                                                 <button type="button" class="btn btn-default add-to-cart"><i
                                                             class="fa fa-shopping-cart"></i>Add to cart
                                                 </button>
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

@section('page_specific_js')
    <script>
        //initiate the plugin and pass the id of the div containing gallery images
        $("#zoom_03").elevateZoom({
            gallery: 'gallery_01',
            cursor: 'pointer',
            galleryActiveClass: 'active',
            imageCrossfade: true,
            loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'
        });

        //pass the images to Fancybox
        $("#zoom_03").bind("click", function (e) {
            var ez = $('#zoom_03').data('elevateZoom');
            $.fancybox(ez.getGalleryList());
            return false;
        });


        $('.carousel-inner .item a img').click(function () {


            var c = $(this).attr("src").replace();
            alert(c);
            $(".view-product .zoomWrapper img").html('<img id="zoom_03" src="' + c + '"/>');

        });
    </script>
@endsection