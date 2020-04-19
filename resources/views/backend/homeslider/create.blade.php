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
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Home Slider</h3>
                        </div>
                        <form role="form" action="{{route($base_route.'.store')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Image (H:400px, W:1000px, Transparent Background)</label>
                                    <input type="file" name="file" class="form-control" id="file"
                                            required>
                                </div>
                                <div class="form-group">
                                    <label for="Alt Text">Alt Text</label>
                                    <input type="text" name="alt_text" class="form-control" id="alt_text"
                                           placeholder="Alt Text" required>
                                </div>
                                <div class="form-group">
                                    <label for="Product Link">Product Link</label>
                                    <input type="text" name="link" class="form-control" id="alt_text"
                                           placeholder="Product Link" required>
                                </div>
                                <div class="form-group">
                                    <label for="Display">Display</label>
                                    <select class="form-control" name="status">
                                        <option value="0">Hide</option>
                                        <option value="1" selected>Show</option>
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