@extends('backend.layouts.master')

@section('backend-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sales Tracking System
                <small>Dashboard</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">STS Dashboard</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            @foreach(['success', 'danger', 'info', 'warning'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{$msg}}">{{Session::get('alert-' . $msg)}}<a href="#" class="close"
                                                                                        data-dismiss="alert"
                                                                                        aria-label="close">&times;</a>
                    </p>
            @endif
        @endforeach
        <!-- Info boxes -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Client Visits <sub><i>till date</i></sub></span>
                            <span class="info-box-number">{{$data['total_visits_till_date']}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Cancelled Visits <sub><i>till date</i></sub></span>
                            <span class="info-box-number">{{$data['cancelled_visits_till_date']}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Sales <sub><i>till date</i></sub></span>
                            <span class="info-box-number">{{$data['total_sales_till_date']}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Upcoming Visits <sub><i>till date</i></sub></span>
                            <span class="info-box-number">{{$data['upcoming_visits']}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->

            <div class="row">
                <div class="col-md-6">
                    <!-- Info Boxes Style 2 -->
                    <div class="info-box bg-blue">
                        <span class="info-box-icon"><i class="ion ion-checkmark-circled"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Task Completion Rate</span>
                            <span class="info-box-number">{{$data['task_completion_rate_in_30_days']}} %</span>

                            <div class="progress">
                                <div class="progress-bar"
                                     style="width: {{$data['task_completion_rate_in_30_days']}}%"></div>
                            </div>
                            <span class="progress-description">
                    In last 30 Days
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-6">
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="ion ion-ios-pricetag"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Sales Rate</span>
                            <span class="info-box-number">{{$data['sales_rate_in_30_days']}} %</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: {{$data['sales_rate_in_30_days']}}%"></div>
                            </div>
                            <span class="progress-description">
                    In last in 30 Days
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible">
                        <h4><i class="icon fa fa-moon-o"></i>Day End</h4>
                        Day end will close all your today's task. You should end your day everyday before leaving
                        office. Once you do it, You won't be able to modify your tasks!
                        <hr/>
                        @if($data['end_day']->value == 0)
                            <a href="{{route('backend.dayend')}}" class="btn btn-primary"
                               style="text-decoration: none;">Day End</a>
                        @else
                            <p>Thank you! Your day has been end for today! <i class="icon fa fa-smile-o"></i></p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Today's Task</a></li>
                            <li><a href="#tab_2" data-toggle="tab">Upcoming Task</a></li>
                            <li><a href="#tab_3" data-toggle="tab">Completed Task</a></li>
                            <li><a href="#tab_4" data-toggle="tab">Incomplete Task</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <table id="todaySchedule" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Client</th>
                                        <th>Time</th>
                                        <th>KeyNotes</th>
                                        <th>Visit Type</th>
                                        <th>Task Status</th>
                                        <th>Sales Status</th>
                                        <th>Created By</th>
                                        <th>Next Followup Date</th>
                                        <th>Created At</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!$data['today_task']->isEmpty())
                                        <?php $i = 1; ?>
                                        @foreach($data['today_task'] as $todayTask)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$todayTask->client->name}}</td>
                                                <td>{{$todayTask->time}}</td>
                                                <td>{{$todayTask->keynotes}}</td>
                                                <td>{{$todayTask->visit_type}}</td>
                                                <td>@switch($todayTask->task_status)
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
                                                <td>@switch($todayTask->sales_status)
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
                                                <td>{{$todayTask->user->name}}</td>
                                                <td>{{$todayTask->next_followup_date}}</td>
                                                <td>{{$todayTask->created_at}}</td>
                                                <td>
                                                    @if(empty($todayTask->created_at))
                                                        <a href="{{URL::to('admin/schedule/edit/'.$todayTask->id)}}"
                                                           class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                                                    @endif
                                                    @if(empty($todayTask->task_status))
                                                        <a href="#"
                                                           class="btn btn-info btn-xs"><i class="fa fa-comment"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>SN</th>
                                        <th>Client</th>
                                        <th>Time</th>
                                        <th>KeyNotes</th>
                                        <th>Visit Type</th>
                                        <th>Task Status</th>
                                        <th>Sales Status</th>
                                        <th>Created By</th>
                                        <th>Next Followup Date</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <table id="upcomingTask" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Client</th>
                                        <th>Visit Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!$data['upcoming_task']->isEmpty())
                                        <?php $i = 1; ?>
                                        @foreach($data['upcoming_task'] as $upcomingTask)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$upcomingTask->client->name}}</td>
                                                <td>{{explode(' ',$upcomingTask->next_followup_date)[0]}}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>SN</th>
                                        <th>Client</th>
                                        <th>Visit Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                <table id="task_completed" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Client</th>
                                        <th>Visit Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!$data['task_completed']->isEmpty())
                                        <?php $i = 1; ?>
                                        @foreach($data['task_completed'] as $taskCompleted)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$taskCompleted->client->name}}</td>
                                                <td>{{$taskCompleted->time}}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>SN</th>
                                        <th>Client</th>
                                        <th>Visit Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_4">
                                <table id="task_incomplete" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Client</th>
                                        <th>Visit Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!$data['task_incomplete']->isEmpty())
                                        <?php $i = 1; ?>
                                        @foreach($data['task_incomplete'] as $taskIncomplete)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$taskIncomplete->client->name}}</td>
                                                <td>{{explode(' ',$taskIncomplete->next_followup_date)[0]}}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>SN</th>
                                        <th>Client</th>
                                        <th>Visit Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('page_specific_js')
    <script>
        $(function () {
            $('#todaySchedule,#upcomingTask,#task_completed,#task_incomplete').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                'scrollX': true,
            }).columns.adjust()
        })
    </script>
@endsection
