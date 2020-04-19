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
                <li class="active">Edit Permissions</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Permissions</h3>
                        </div>
                        <form role="form" action="{{route($base_route.'.update',['id'=> $data['row']->id])}}"
                              method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Display Name">Display Name</label>
                                    <input type="text" name="display_name" class="form-control" id="display_name"
                                           placeholder="Display Name" value="{{$data['row']->display_name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Slug (Human Readable- Autogenerated)</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="Slug" value="{{$data['row']->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="Display Name">Description</label>
                                    <input type="text" name="description" class="form-control" id="description"
                                           value="{{$data['row']->description}}" placeholder="Description">
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
            $("#display_name").on('focusout', function (e) {
                var displayName = $(this).val().toLowerCase().replace(/ /g, '-');
                $("#name").val(displayName);
            });
        });
    </script>
@endsection