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
                            <h3 class="box-title">Create Primary Category</h3>
                        </div>
                        <form role="form" action="{{route($base_route.'.store')}}" method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Category Name">Category Name</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           placeholder="Enter Category Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="Description">Description</label>
                                    <textarea type="text" name="description" class="form-control" id="description"
                                              placeholder="Short-Description" required></textarea>
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