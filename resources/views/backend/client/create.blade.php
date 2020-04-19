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
                <li class="active">Create Client</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Client</h3>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form role="form" action="{{route($base_route.'.store')}}" method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Client Name">Client Name</label>
                                    <input type="text" name="name" class="form-control" id="client_name"
                                           placeholder="Client Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                           placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                           placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" id="address"
                                           placeholder="Address" required>
                                </div>
                                <div class="form-group">
                                    <label for="contact">Contact</label>
                                    <input type="number" name="contact" class="form-control" id="contact"
                                           placeholder="Contact" required>
                                </div>
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="text" name="date_of_birth" class="form-control" id="dob"
                                           placeholder="YYYY-MM-DD">
                                </div>
                                <div class="form-group">
                                    <label for="sex">Sex</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="male" value="Male" checked>
                                        <label class="form-check-label" for="Male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="female" value="Female">
                                        <label class="form-check-label" for="Female">Female</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dateofanniversary">Date of Anniversary</label>
                                    <input type="text" name="date_of_anniversary" class="form-control" id="date_of_anniversary"
                                           placeholder="YYYY-MM-DD">
                                </div>
                                <div class="form-group">
                                    <label for="office">Office</label>
                                    <input type="text" name="office" class="form-control" id="office"
                                           placeholder="Office">
                                </div>
                                <div class="form-group">
                                    <label for="office_address">Office Address</label>
                                    <input type="text" name="office_address" class="form-control" id="office_address"
                                           placeholder="Office Address">
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