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
                <li class="active">Create Push Notification</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Push Notification</h3>
                        </div>
                        <form role="form" action="{{route($base_route.'.store')}}" method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Title">Title</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           placeholder="Title" required>
                                </div>
                                <div class="form-group">
                                    <label for="Body">Body</label>
                                    <textarea type="text" name="body" class="form-control" id="body"
                                              placeholder="Body.." required></textarea>
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