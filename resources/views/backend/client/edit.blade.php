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
                <li class="active">Edit Client</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Client</h3>
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
                        <form role="form" action="{{route($base_route.'.update',['id'=> $data['row']->id])}}"
                              method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Client Name">Client Name</label>
                                    <input type="text" name="name" class="form-control" id="client_name"
                                           placeholder="Client Name" value="{{$data['row']->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                           placeholder="Email" value="{{$data['row']->email}}" required>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="oldpassword" class="form-check-inline"
                                           id="oldpassword" checked/>
                                    <label for="oldpassword" class="form-check-label">Keep Old Password</label>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                           placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" id="address"
                                           placeholder="Address" value="{{$data['row']->address}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="contact">Contact</label>
                                    <input type="number" name="contact" class="form-control" id="contact"
                                           placeholder="Contact" value="{{$data['row']->contact}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="text" name="date_of_birth" class="form-control" id="dob"
                                           placeholder="YYYY-MM-DD" value="{{$data['row']->date_of_birth}}">
                                </div>
                                <div class="form-group">
                                    <label for="sex">Sex</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="male" value="Male"
                                               @if($data['row']->sex == 'Male') checked @endif>
                                        <label class="form-check-label" for="Male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="female"
                                               value="Female" @if($data['row']->sex == 'Female') checked @endif>
                                        <label class="form-check-label" for="Female">Female</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dateofanniversary">Date of Anniversary</label>
                                    <input type="text" name="date_of_anniversary" class="form-control"
                                           id="date_of_anniversary"
                                           placeholder="YYYY-MM-DD" value="{{$data['row']->date_of_anniversary}}">
                                </div>
                                <div class="form-group">
                                    <label for="office">Office</label>
                                    <input type="text" name="office" class="form-control" id="office"
                                           placeholder="Office" value="{{$data['row']->office}}">
                                </div>
                                <div class="form-group">
                                    <label for="office_address">Office Address</label>
                                    <input type="text" name="office_address" class="form-control" id="office_address"
                                           placeholder="Office Address" value="{{$data['row']->office_address}}">
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
            var checked = $('#oldpassword').is(":checked");
            if (checked) {
                $('#password').prop('disabled', true);
            }
            $("#oldpassword").on('click', function () {
                checked = $('#oldpassword').is(":checked");
                if (checked) {
                    $('#password').prop('disabled', true);
                }
                else {
                    $('#password').prop('disabled', false);
                }
            })
        });
    </script>
@endsection