<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @if($data['categories']->isNotEmpty())
                @foreach($data['categories'] as $category)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="{{route('frontend.product.category',['category' => 'primary','id' => $category->id])}}">{{$category->title}} </a>
                                <span data-toggle="collapse" data-parent="#accordian"
                                      href="#cat_{{$category->id}}" class="badge pull-right"><i class="fa fa-plus"></i></span>
                            </h4>

                        </div>
                        <div id="cat_{{$category->id}}" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    @if($category->SecondaryCategories->isNotEmpty())
                                        @foreach($category->SecondaryCategories as $secondaryCategory)
                                            <li>
                                                <a href="{{route('frontend.product.category',['category' => 'secondary','id' => $secondaryCategory->id])}}">{{$secondaryCategory->title}} </a>
                                            </li>
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

    {{--<div class="price-range"><!--price-range-->
        <h2>Price Range</h2>
        <div class="well text-center">
            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="5000"
                   data-slider-step="5" data-slider-value="[200,2000]" id="sl2"><br/>
            <b class="pull-left">Rs 0</b> <b class="pull-right">Rs 5000</b>
        </div>
    </div>--}}<!--/price-range-->

        {{-- <div class="shipping text-center"><!--shipping-->
             <img src="images/home/shipping.jpg" alt=""/>
         </div><!--/shipping-->--}}

    </div>
</div>