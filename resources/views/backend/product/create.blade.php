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
                <li class="active">Create</li>
            </ol>
        </section>

        <section class="content">
            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)

                        <p class="alert alert-danger">{{ $error }}<a href="#" class="close"
                                                                     data-dismiss="alert"
                                                                     aria-label="close">&times;</a>
                        </p>
                    @endforeach
                </ul>
            @endif
            <div class="row">

                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Product</h3>
                        </div>
                        <form role="form" action="{{route($base_route.'.store')}}" method="POST"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Product Title">Product Title</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           placeholder="Enter Product Title" required>
                                </div>
                                <div class="form-group">
                                    <label for="Featured Image">Featured Image (W:600px,H:600px)</label>
                                    <input type="file" name="featured_image" class="form-control" id="featured_image"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="Description">Highlight Features (Comma Separated)</label>
                                    <textarea type="text" name="features" class="form-control" id="features"
                                              placeholder="Product Highlight Features (Comma Separated)"
                                              required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="Description">Description</label>
                                    <textarea type="text" name="description" class="form-control" id="description"
                                              placeholder="Product Description" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="Price">Price</label>
                                    <input type="number" name="price" class="form-control" id="price"
                                           placeholder="0.00" step="any" required>
                                </div>
                                <div class="form-group">
                                    <label for="Select">Primary Category</label>
                                    <select name="primary_category_id" id="primary_category_id"
                                            class="form-control select2" required>
                                        @if($data['rows']->isNotEmpty())
                                            <option selected value="">Select Primary Category</option>
                                            @foreach($data['rows'] as $data)
                                                <option value="{{$data->id}}">{{$data->title}}</option>
                                            @endforeach
                                        @else
                                            <option selected value="">No Data!</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Select">Secondary Category</label>
                                    <select name="secondary_category_id" id="secondary_category_id"
                                            class="form-control select2" required>
                                        '
                                        <option value="">Select Secondary Category</option>
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
                                    <label for="Product Images">Product Image(s) (MAX: 3 images: 600X600)</label>
                                    <input type="file" name="images[]" class="form-control" id="images" multiple
                                           required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="is_featured" value="1"> Featured Product
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
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('description')

        })
    </script>
@endsection