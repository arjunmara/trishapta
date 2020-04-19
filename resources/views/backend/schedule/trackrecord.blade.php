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
                <li class="active">Track Employee</li>
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
                            <h3 class="box-title">Track Employee</h3>
                            <h4><em>
                                    <small>Choose one or more filters to get data.</small>
                                </em></h4>
                        </div>
                        <form id="emp_report_form">
                            <div class="box-body">
                                <div class="form-group col-xs-12 col-sm-2">
                                    <label for="branch Name">Choose Branch</label>
                                    <select id="branch_id" name="branch_id" class="form-control" required>
                                        @if($data['branches']->isNotEmpty())
                                            <option value="" selected disabled>Select</option>
                                            @foreach($data['branches'] as $branch)
                                                <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                            @endforeach
                                        @else
                                            <option value="">No Data Available!</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-xs-12 col-sm-2">
                                    <label for="Employee Name">Choose Employee</label>
                                    <select name="employee_id" id="employee_id" class="form-control" required>
                                        <option value="" selected disabled>Select</option>
                                    </select>
                                </div>
                                <div class="form-group col-xs-12 col-sm-2">
                                    <label for="Task Status">Task Status</label><br/>
                                    <label>
                                        <input type="radio" name="task_status" value="completed"
                                               class="minimal form-control" checked/>
                                        &nbsp;&nbsp;Completed Task
                                    </label><br/>
                                    <label>
                                        <input type="radio" name="task_status" value="incomplete"
                                               class="minimal form-control"/>
                                        &nbsp;&nbsp;Incomplete Task
                                    </label><br/>
                                    <label>
                                        <input type="radio" name="task_status" value="pending"
                                               class="minimal form-control"/>
                                        &nbsp;&nbsp;Pending Task
                                    </label>
                                </div>
                                <div class="form-group col-xs-12 col-sm-2">
                                    <label for="Task Status">Sales Status</label><br/>
                                    <label>
                                        <input type="radio" name="sales_status" value="yes" class="minimal form-control"
                                               checked/>
                                        &nbsp;&nbsp;Sold
                                    </label><br/>
                                    <label>
                                        <input type="radio" name="sales_status" value="no"
                                               class="minimal form-control"/>
                                        &nbsp;&nbsp;Not Sold
                                    </label>
                                    <label>
                                        <input type="radio" name="sales_status" value="unknown"
                                               class="minimal form-control"/>
                                        &nbsp;&nbsp;Unknown
                                    </label>
                                </div>
                                <div class="form-group col-xs-12 col-sm-2">
                                    <label>Task Created On:</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                                            <span> <i class="fa fa-calendar"></i> Date range picker</span>
                                            <i class="fa fa-caret-down"></i>
                                        </button>
                                        <input type="hidden" id="daterange" name="daterange"/>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-2">
                                    <div class="input-group">
                                        <button type="button" name="submit" class="btn btn-primary"
                                                style="margin-top: 25px;" id="submit">
                                            <span>Search</span>
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="box-body">
                            <table id="report-table" class="table table-bordered table-striped">
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
                                <td colspan="11" class="text-center">No Data Available!</td>
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

        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })

        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                // autoUpdateInput: false,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#daterange-btn span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'))
                $('#daterange').val(start.format('YYYY-MM-DD') + ' , ' + end.format('YYYY-MM-DD'))

            }
        )
    </script>
    <script>
        var branchID;
        $(document).ready(function () {
            $('#branch_id').change(function () {
                branchID = $(this).val();
                employee = ajaxCall('GET', '/admin/getEmployeeBasedOnBranch', {'bid': branchID})
                //console.log(JSON.stringify(data));
                $('#employee_id').empty();
                $('#employee_id').append(employee);
            });

            //fetch employee task

            $('#submit').on('click', function (e) {
                e.preventDefault();
                var emp_report_data = {
                    'bid': $('#branch_id').val(),
                    'eid': $('#employee_id').val(),
                    'task_status': $("input[name='task_status']:checked").val(),
                    'sales_status': $("input[name='sales_status']:checked").val(),
                    'daterange': $('#daterange').val(),
                    '_token': '{{csrf_token()}}'
                };
                console.log('form submitted');
                tasks_report = ajaxCall('POST', '/admin/getEmployeeTaskReport', emp_report_data)
                console.log(JSON.stringify(tasks_report));
                $('#report-table > tbody').empty();
                $('#report-table > tbody').append(tasks_report);
            })
        });
    </script>
@endsection