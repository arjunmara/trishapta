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
                <li class="active">Edit Home Slider</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Home Slider</h3>
                        </div>
                        <form role="form" action="{{route($base_route.'.update',['id' => $data['row']->id])}}" enctype="multipart/form-data"
                              method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Image (H:400px, W:1000px, Transparent Background)</label>
                                    <input type="file" name="file" class="form-control" id="file">
                                    <img src="{{asset($image_url.$data['row']->title)}}" width="96" height="96"/>
                                </div>
                                <div class="form-group">
                                    <label for="Alt Text">Alt Text</label>
                                    <input type="text" name="alt_text" class="form-control" id="alt_text"
                                           placeholder="Alt Text" value="{{$data['row']->alt}}"required>
                                </div>
                                <div class="form-group">
                                    <label for="Product Link">Product Link</label>
                                    <input type="text" name="link" class="form-control" id="alt_text"
                                           placeholder="Product Link" value="{{$data['row']->product_link}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="Display">Display</label>
                                    <select class="form-control" name="status">
                                        <option value="0" @if($data['row']->status == 0) selected @endif>Hide</option>
                                        <option value="1" @if($data['row']->status == 1) selected @endif>Show</option>
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