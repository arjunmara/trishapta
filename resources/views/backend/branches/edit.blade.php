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
                <li class="active">Edit Branch</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Branch</h3>
                        </div>
                        <form role="form" action="{{route($base_route.'.update',['id'=> $data['row']->id])}}"
                              method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Branch Name">Branch Name</label>
                                    <input type="text" name="branch_name" class="form-control" id="branch_name"
                                           placeholder="Branch Name" value="{{$data['row']->branch_name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="Location">Location</label>
                                    <input type="text" name="location" class="form-control" id="location"
                                           placeholder="Location" value="{{$data['row']->location}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="Description">Description</label>
                                    <input type="text" name="description" class="form-control" id="description"
                                           value="{{$data['row']->description}}"
                                           placeholder="Description">
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

        });
    </script>
@endsection