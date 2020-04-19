@extends('backend.layouts.master')
@section('page_specific_css')
    <style>
        #add_schedule_table .today {
            background: #0073b7 !important
        }

        #add_schedule_table th:nth-of-type(7), td:nth-of-type(7) {
            color: #dd4b39 !important;
        }

    </style>
@endsection
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
                <li class="active">Schedules</li>
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
                            <h3 class="box-title">Schedules Management</h3>

                        </div>
                        <div class="box-body">
                            <table id="add_schedule_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="15%">Sun</th>
                                    <th width="15%">Mon</th>
                                    <th width="15%">Tue</th>
                                    <th width="15%">Wed</th>
                                    <th width="15%">Thu</th>
                                    <th width="15%">Fri</th>
                                    <th width="15%">Sat</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['weeks'] as $week)
                                    {!! $week !!}
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Today's Task</h3>
                        </div>
                        <div class="box-body">
                            <table id="todaySchedule" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{trans($trans_path.'general.columns.sn')}}</th>
                                    <th>{{trans($trans_path.'general.columns.client')}}</th>
                                    <th>{{trans($trans_path.'general.columns.visit_datetime')}}</th>
                                    <th>{{trans($trans_path.'general.columns.keynotes')}}</th>
                                    <th>{{trans($trans_path.'general.columns.visit_type')}}</th>
                                    <th>{{trans($trans_path.'general.columns.task_status')}}</th>
                                    <th>{{trans($trans_path.'general.columns.sales_status')}}</th>
                                    <th>{{trans($trans_path.'general.columns.created_by')}}</th>
                                    <th>{{trans($trans_path.'general.columns.next_followup_date')}}</th>
                                    <th>{{trans($trans_path.'general.columns.created_at')}}</th>
                                    <th>{{trans($trans_path.'general.columns.action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(!$data['rows']->isEmpty())
                                    <?php $i = 1; ?>
                                    @foreach($data['rows'] as $rowData)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$rowData->client->name}}</td>
                                            <td>{{$rowData->time}}</td>
                                            <td>{{$rowData->keynotes}}</td>
                                            <td>{{$rowData->visit_type}}</td>
                                            <td>@switch($rowData->task_status)
                                                    @case('yes')
                                                    Complete
                                                    @break
                                                    @case('no')
                                                    Cancelled
                                                    @break
                                                    @default
                                                    Pending
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>@switch($rowData->sales_status)
                                                    @case('yes')
                                                    Sold
                                                    @break
                                                    @case('no')
                                                    Not Sold
                                                    @break
                                                    @default
                                                    No Info
                                                    @break
                                                @endswitch</td>
                                            <td>{{$rowData->user->name}}</td>
                                            <td>{{$rowData->next_followup_date}}</td>
                                            <td>{{$rowData->created_at}}</td>
                                            <td>
                                                @if(empty($rowData->created_at))
                                                    <a href="{{route($base_route.'.edit',['id'=>$rowData->id])}}"
                                                       class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                                                @endif
                                                @if(empty($rowData->task_status))
                                                    <a href="{{route($base_route.'.feedback',['id'=>$rowData->id])}}"
                                                       class="btn btn-info btn-xs"><i class="fa fa-comment"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{trans($trans_path.'general.columns.sn')}}</th>
                                    <th>{{trans($trans_path.'general.columns.client')}}</th>
                                    <th>{{trans($trans_path.'general.columns.visit_datetime')}}</th>
                                    <th>{{trans($trans_path.'general.columns.keynotes')}}</th>
                                    <th>{{trans($trans_path.'general.columns.visit_type')}}</th>
                                    <th>{{trans($trans_path.'general.columns.task_status')}}</th>
                                    <th>{{trans($trans_path.'general.columns.sales_status')}}</th>
                                    <th>{{trans($trans_path.'general.columns.created_by')}}</th>
                                    <th>{{trans($trans_path.'general.columns.next_followup_date')}}</th>
                                    <th>{{trans($trans_path.'general.columns.created_at')}}</th>
                                    <th>{{trans($trans_path.'general.columns.action')}}</th>
                                </tr>
                                </tfoot>
                            </table>
                            {{--@if(method_exists($data['rows'],'links'))
                                {{ $data['rows']->links() }}
                            @endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('page_specific_js')
    <script>
        $(function () {
            $('#todaySchedule').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                'scrollX': true,
            })
        })



    </script>
@endsection