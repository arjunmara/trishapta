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
                <li class="active">Devices</li>
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
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th  width="5%">{{trans($trans_path.'general.columns.sn')}}</th>
                                    <th  width="10%">{{trans($trans_path.'general.columns.mac_id')}}</th>
                                    <th  width="55%">{{trans($trans_path.'general.columns.device_token')}}</th>
                                    <th  width="10%">{{trans($trans_path.'general.columns.device_type')}}</th>
                                    <th  width="20%">{{trans($trans_path.'general.columns.created_at')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!$data['rows']->isEmpty())

                                    <?php $i = 1; ?>
                                    @foreach($data['rows'] as  $rowData)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{ $rowData->mac_id}}</td>
                                            <td style="word-break: break-all;">{{ $rowData->device_token}}</td>
                                            <td>{{ $rowData->device_type}}</td>
                                            <td>{{ $rowData->created_at}}</td>
                                        </tr>
                                    @endforeach

                                @else
                                    <tr class="text-center">
                                        <td colspan="5">No Data!</td>
                                    </tr>

                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{trans($trans_path.'general.columns.sn')}}</th>
                                    <th>{{trans($trans_path.'general.columns.mac_id')}}</th>
                                    <th>{{trans($trans_path.'general.columns.device_token')}}</th>
                                    <th>{{trans($trans_path.'general.columns.device_type')}}</th>
                                    <th>{{trans($trans_path.'general.columns.created_at')}}</th>
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