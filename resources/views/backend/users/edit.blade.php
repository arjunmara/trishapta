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
                <li class="active">Edit Users</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Users</h3>
                        </div>
                        <form role="form" action="{{route($base_route.'.update',['id'=> $data['row']->id])}}"
                              method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="Name" value="{{$data['row']->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                           placeholder="Email" value="{{$data['row']->email}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="Branch">Branch</label>
                                    <select class="form-control" name="branch_id" required>
                                        @if($data['branches']->isNotEmpty())
                                            @foreach($data['branches'] as $branch)
                                                <option @if($branch->id == $data['row']->branch_id) selected @endif value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Display Name">Roles
                                        for this User</label><br/>

                                    @foreach($data['roles'] as $role)
                                        <input type="checkbox" name="roles[]" @if(in_array($role->id,$data['row']->roles->pluck('id')->toArray())) checked
                                               @endif
                                               value="{{$role->id}}"/>
                                        <label for="Permission Name">{{$role->display_name}}</label>
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
        </section>
    </div>
@endsection