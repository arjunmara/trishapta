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
                              method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Category Name">Category Name</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           placeholder="Enter Category Name" value="{{$data['row']->title}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="Description">Description</label>
                                    <textarea type="text" name="description" class="form-control" id="description"
                                              placeholder="Short-Description"
                                              required>{{$data['row']->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="Select">Primary Category</label>
                                    <select name="primary_category_id" class="form-control select2" required>
                                        @if($data['rows']->isNotEmpty())
                                            @foreach($data['rows'] as $primaryCat)
                                                <option @if($data['row']->primary_category_id == $primaryCat->id) selected
                                                        @endif value="{{$primaryCat->id}}">{{$primaryCat->title}}</option>
                                            @endforeach
                                        @else
                                            <option selected value="">No Data!</option>
                                        @endif
                                    </select>
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
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection