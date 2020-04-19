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
                <li class="active">Primary Category</li>
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
                            <h3 class="box-title">Home Slider Management</h3>
                            <a href="{{route($base_route.'.add')}}" class="btn btn-xs btn-primary"><i
                                        class="fa fa-plus"></i> Add</a>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{trans($trans_path.'general.columns.sn')}}</th>
                                    <th>{{trans($trans_path.'general.columns.slide')}}</th>
                                    <th>{{trans($trans_path.'general.columns.alt')}}</th>
                                    <th>{{trans($trans_path.'general.columns.product_link')}}</th>
                                    <th>{{trans($trans_path.'general.columns.action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(!$data['rows']->isEmpty())
                                    <?php $i = 1; ?>
                                    @foreach($data['rows'] as $data)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td><img src="{{asset($image_url.$data->title)}}" width="96" height="96"/>
                                            </td>
                                            <td>{{$data->alt}}</td>
                                            <td>{{$data->product_link}}</td>
                                            <td><a href="{{route($base_route.'.edit',['id'=>$data->id])}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                                                <a href="#" type="button" data-toggle="modal" data-id="{{$data->id}}"
                                                   data-target="#modal-danger-{{$data->id}}" class="btn btn-danger delete btn-xs"><i
                                                            class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal modal-danger fade" id="modal-danger-{{$data->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Alert!</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure want to delete this record ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="#" class="btn btn-outline" data-dismiss="modal">Close</a>
                                                        <a id="delete" href="{{route($base_route.'.delete',['id'=>$data->id])}}"
                                                           class="btn btn-outline">Yes</a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    @endforeach
                                    @else
                                    <tr class="text-center"><td colspan="5">No Data!</td></tr>
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{trans($trans_path.'general.columns.sn')}}</th>
                                    <th>{{trans($trans_path.'general.columns.slide')}}</th>
                                    <th>{{trans($trans_path.'general.columns.alt')}}</th>
                                    <th>{{trans($trans_path.'general.columns.product_link')}}</th>
                                    <th>{{trans($trans_path.'general.columns.action')}}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection