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
                <li class="active">Users</li>
            </ol>
            <div class="row">

            </div>

        </section>
        <section class="content">
            @foreach(['success', 'danger', 'info', 'warning'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{$msg}}">{{Session::get('alert-' . $msg)}}<a href="#" class="close"
                                                                                        data-dismiss="alert"
                                                                                        aria-label="close">&times;</a>
                    </p>
                @endif
            @endforeach

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Users Management</h3>
                            <a href="{{route($base_route.'.add')}}" class="btn btn-xs btn-primary"><i
                                        class="fa fa-plus"></i> Add</a>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{trans($trans_path.'general.columns.sn')}}</th>
                                    <th>{{trans($trans_path.'general.columns.username')}}</th>
                                    <th>{{trans($trans_path.'general.columns.email')}}</th>
                                    <th>{{trans($trans_path.'general.columns.branch')}}</th>
                                    <th>{{trans($trans_path.'general.columns.created_at')}}</th>
                                    <th>{{trans($trans_path.'general.columns.updated_at')}}</th>
                                    <th>{{trans($trans_path.'general.columns.action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(!$data['rows']->isEmpty())

                                    <?php $i = 1; ?>
                                    @foreach($data['rows'] as  $rowData)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{ $rowData->name}}</td>
                                            <td>{{ $rowData->email}}</td>
                                            <td>{{ $rowData->branch->branch_name}}</td>
                                            <td>{{ $rowData->created_at}}</td>
                                            <td>{{ $rowData->updated_at}}</td>
                                            <td>
                                                <a href="{{route($base_route.'.edit',['id'=> $rowData->id])}}"
                                                   class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                                               {{-- <a href="#" type="button" data-toggle="modal"
                                                   data-id="{{ $rowData->id}}"
                                                   data-target="#modal-danger-{{ $rowData->id}}"
                                                   class="btn btn-danger delete btn-xs"><i
                                                            class="fa fa-trash"></i></a>--}}
                                            </td>
                                        </tr>
                                        <div class="modal modal-danger fade" id="modal-danger-{{ $rowData->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Alert!</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure want to delete this record ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="#" class="btn btn-outline"
                                                           data-dismiss="modal">Close</a>
                                                        <a id="delete"
                                                           href="{{route($base_route.'.delete',['id'=> $rowData->id])}}"
                                                           class="btn btn-outline">Yes</a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    @endforeach

                                @else
                                    <tr class="text-center">
                                        <td colspan="7">No Data!</td>
                                    </tr>

                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{trans($trans_path.'general.columns.sn')}}</th>
                                    <th>{{trans($trans_path.'general.columns.username')}}</th>
                                    <th>{{trans($trans_path.'general.columns.email')}}</th>
                                    <th>{{trans($trans_path.'general.columns.branch')}}</th>
                                    <th>{{trans($trans_path.'general.columns.created_at')}}</th>
                                    <th>{{trans($trans_path.'general.columns.updated_at')}}</th>
                                    <th>{{trans($trans_path.'general.columns.action')}}</th>
                                </tr>
                                </tfoot>

                            </table>


                            @if(method_exists($data['rows'],'links'))
                                {{ $data['rows']->links() }}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection