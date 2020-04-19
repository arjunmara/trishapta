@extends('frontend.layouts.master')
@section('frontend-content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend.layouts.sidebar')
                <div class="col-sm-9 padding-right">
                    @if(count($data['secondaryData']) > 0 )
                        <div class="features_items"><!--features_items-->
                            @foreach($data['secondaryData'] as $secondaryCategory)
                                <?php $i = 1; ?>
                                @foreach($secondaryCategory as $secondaryCategoryItem)
                                    @if($i == 1)
                                        <h2 class="title text-center">{{$secondaryCategoryItem['secondary_category_id']}}
                                            Items</h2>

                                    @endif

                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{asset($image_url.$secondaryCategoryItem['featured_image'])}}"
                                                         alt=""/>
                                                    <h2>Rs. {{$secondaryCategoryItem['price']}}</h2>
                                                    <p>{{$secondaryCategoryItem['title']}}</p>
                                                    @if(strlen($secondaryCategoryItem['title']) < 40)
                                                        <br/>
                                                        <p>{{$secondaryCategoryItem['title'] }}</p>
                                                    @elseif(strlen($secondaryCategoryItem['title']) > 65)
                                                        <p>{{substr($secondaryCategoryItem['title'],0,50).'...'}} </p>
                                                    @else
                                                        <p>{{$secondaryCategoryItem['title'] }}</p>
                                                    @endif
                                                    <a href="{{route('frontend.product.detail',['id' => $secondaryCategoryItem['id']])}}"
                                                       class="btn btn-default add-to-cart"><i
                                                                class="fa fa-eye"></i>View Details</a>
                                                </div>
                                                <div class="product-overlay">
                                                    <div class="overlay-content">
                                                        <h2>Rs. {{$secondaryCategoryItem['price']}}</h2>
                                                        @if(strlen($secondaryCategoryItem['title']) < 40)
                                                            <br/>
                                                            <p>{{$secondaryCategoryItem['title'] }}</p>
                                                        @elseif(strlen($secondaryCategoryItem['title']) > 65)
                                                            <p>{{substr($secondaryCategoryItem['title'],0,50).'...'}} </p>
                                                        @else
                                                            <p>{{$secondaryCategoryItem['title'] }}</p>
                                                        @endif
                                                        <a href="{{route('frontend.product.detail',['id' => $secondaryCategoryItem['id']])}}"
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
                                <?php $i++; ?>
                            @endforeach
                            {{-- @endforeach--}}
                        </div><!--features_items-->
                    @else
                        <div class="features_items"><!--features_items-->
                            @foreach($data['secondaryData'] as $secondaryCategory)
                                <?php $i = 1; ?>
                                @foreach($secondaryCategory as $secondaryCategoryItem)
                                    @if($i == 1)
                                        <h2 class="title text-center">{{$secondaryCategoryItem['secondary_category_id']}}
                                            Items</h2>

                                    @endif

                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{asset($image_url.$secondaryCategoryItem['featured_image'])}}"
                                                         alt=""/>
                                                    <h2>Rs. {{$secondaryCategoryItem['price']}}</h2>
                                                    <p>{{$secondaryCategoryItem['title']}}</p>
                                                    @if(strlen($secondaryCategoryItem['title']) < 40)
                                                        <br/>
                                                        <p>{{$secondaryCategoryItem['title'] }}</p>
                                                    @elseif(strlen($secondaryCategoryItem['title']) > 65)
                                                        <p>{{substr($secondaryCategoryItem['title'],0,50).'...'}} </p>
                                                    @else
                                                        <p>{{$secondaryCategoryItem['title'] }}</p>
                                                    @endif
                                                    <a href="{{route('frontend.product.detail',['id' => $secondaryCategoryItem['id']])}}"
                                                       class="btn btn-default add-to-cart"><i
                                                                class="fa fa-eye"></i>View Details</a>
                                                </div>
                                                <div class="product-overlay">
                                                    <div class="overlay-content">
                                                        <h2>Rs. {{$secondaryCategoryItem['price']}}</h2>
                                                        @if(strlen($secondaryCategoryItem['title']) < 40)
                                                            <br/>
                                                            <p>{{$secondaryCategoryItem['title'] }}</p>
                                                        @elseif(strlen($secondaryCategoryItem['title']) > 65)
                                                            <p>{{substr($secondaryCategoryItem['title'],0,50).'...'}} </p>
                                                        @else
                                                            <p>{{$secondaryCategoryItem['title'] }}</p>
                                                        @endif
                                                        <a href="{{route('frontend.product.detail',['id' => $secondaryCategoryItem['id']])}}"
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
                                <?php $i++; ?>
                            @endforeach
                            {{-- @endforeach--}}
                        </div>
                        <h2 class="title text-center">Category Items</h2>
                        <p class="text-center">No Items in this Category!!!</p>

                </div>


                @endif
            </div>
        </div>
        </div>
    </section>

@endsection
