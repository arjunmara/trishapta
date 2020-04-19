@extends('backend.layouts.master')


@section('backend-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Trishapta</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Edit Secondary Category</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Secondary Category</h3>
                        </div>
                        <form role="form" action="{{route($base_route.'.update',['id' => $data['row']->id])}}"
                              method="POST"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Product Title">Product Title</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           value="{{$data['row']->title}}"
                                           placeholder="Enter Product Title" required>
                                </div>
                                <div class="form-group">
                                    <label for="Featured Image">Featured Image (600X600 px)</label>
                                    <input type="file" name="featured_image" class="form-control" id="featured_image">
                                    <img src="{{asset($image_url.$data['row']->featured_image)}}" width="90"
                                         height="90" style="border: #3c8dbc solid medium"/>
                                </div>
                                <div class="form-group">
                                    <label for="Description">Highlight Features</label>
                                    <textarea type="text" name="features" class="form-control" id="features"
                                              placeholder="Product Highlight Features (Comma Separated)"
                                              required>{{$data['row']->features}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="Description">Description</label>
                                    <textarea type="text" name="description" class="form-control" id="description"
                                              placeholder="Product Description"
                                              required>{{$data['row']->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="Price">Price</label>
                                    <input type="number" name="price" class="form-control" id="price"
                                           placeholder="0.00" value="{{$data['row']->price}}" step="any" required>
                                </div>
                                <div class="form-group">
                                    <label for="Select">Primary Category</label>
                                    <select name="primary_category_id" id="primary_category_id"
                                            class="form-control select2" required>
                                        @if($data['primary_category']->isNotEmpty())
                                            @foreach($data['primary_category'] as $pc)
                                                <option value="{{$pc->id}}"
                                                        @if($pc->id == $data['row']->primary_category_id) selected @endif>{{$pc->title}}</option>
                                            @endforeach
                                        @else
                                            <option selected value="">No Data!</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Select">Secondary Category</label>
                                    <select name="secondary_category_id" id="secondary_category_id"
                                            class="form-control select2" required>'
                                        @if($data['secondary_category']->isNotEmpty())
                                            @foreach($data['secondary_category'] as $sc)
                                                <option value="{{$sc->id}}"
                                                        @if($sc->id == $data['row']->secondary_category_id) selected @endif>{{$sc->title}}</option>
                                            @endforeach
                                        @else
                                            <option selected value="">No Data!</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Select">Stock Information</label>
                                    <select name="stock" class="form-control select2" required>
                                        <option value="2">On Sale</option>
                                        <option selected value="1">In Stock</option>
                                        <option value="0">Out Of Stock</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Product Images">Product Image(s) 600X600px</label>
                                    <input type="file" name="images[]" class="form-control" id="images" multiple>
                                    <div class="row" style="margin-top: 20px;">
                                        @if(!empty($data['images']))
                                            @foreach($data['images'] as $image)

                                                <div class="col-sm-3 col-xs-12">
                                                    <span class="pull-right"><a
                                                                href="{{route('backend.product.delete-image',['id' => $image->id])}}">X</a></span>
                                                    <img src="{{asset($image_url.$image->title)}}" width="90"
                                                         height="90" style="border: #3c8dbc solid medium"/>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="is_featured" value="1" @if($data['row']->is_featured == 1) checked @endif> Featured Product
                                    </label>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
@section('page_specific_js')
    @parent
    <script>
        $(document).ready(function () {
            $('.select2').select2();

            $('#primary_category_id').on('change', function () {

                var url = '{{URL::to('/')}}/admin/secondary-category-ajax/' + $(this).val();
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {'_token': '{{ csrf_token() }}'},
                    success: function (data) {
                        console.log(JSON.stringify(data));
                        $('#secondary_category_id').empty();
                        $('#secondary_category_id').append(data.data);
                    },
                    error: function (data) {

                    }

                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('description')

        })
    </script>
@endsection