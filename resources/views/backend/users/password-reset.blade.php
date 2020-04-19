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
                <li class="active">Reset Password</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Reset Password</h3>
                        </div>
                        <form role="form" action="{{route($base_route.'.password-reset')}}" method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Old Password">Old Password</label>
                                    <input type="password" name="old_password" class="form-control" id="old_password"
                                           placeholder="Old Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="New Password">New Password</label>
                                    <input type="password" name="new_password" class="form-control" id="new_password"
                                           placeholder="New Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="Confirm Password">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" id="confirm_password"
                                           placeholder="Confirm Password" required>
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