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
                <li class="active">Create Role</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Role</h3>
                        </div>
                        <form role="form" action="{{route($base_route.'.store')}}" method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Display Name">Display Name</label>
                                    <input type="text" name="display_name" class="form-control" id="display_name"
                                           placeholder="Display Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Slug (Autogenerated)</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="Slug" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="Display Name">Description</label>
                                    <input type="text" name="description" class="form-control" id="description"
                                           placeholder="Description">
                                </div>
                                <div class="form-group">
                                    <label for="Display Name">User Level (SuperAdmin = 1, Admin = 2, Sales Representative = 3 and so on)</label>
                                    <input type="number" name="user_level" class="form-control" id="user_level"
                                           placeholder="User Level" required>
                                </div>
                                <div class="form-group">
                                    <label for="Display Name">Permissions
                                        for this role</label><br/>

                                    @foreach($data['rows'] as $permission)
                                        <input type="checkbox" name="permissions[]"
                                               value="{{$permission->id}}"/>
                                        <label for="Permission Name">{{$permission->display_name}}</label>
                                        <br/>
                                    @endforeach


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
    </div>
    </section>
    </div>
@endsection
@section('page_specific_js')
    <script>
        $(document).ready(function () {
            $("#display_name").on('focusout', function (e) {
                var displayName = $(this).val().toLowerCase().replace(/ /g, '-');
                $("#name").val(displayName);
            });
        });
    </script>
@endsection