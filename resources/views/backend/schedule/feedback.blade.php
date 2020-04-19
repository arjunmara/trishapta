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
                <li class="active">Feedback</li>
            </ol>
            @foreach(['success', 'danger', 'info', 'warning'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{$msg}}">{{Session::get('alert-' . $msg)}}<a href="#" class="close"
                                                                                        data-dismiss="alert"
                                                                                        aria-label="close">&times;</a>
                    </p>
                @endif
            @endforeach
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Feedback</h3>
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
                        <form role="form" action="{{route($base_route.'.feedback')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="taskId" value="{{$data['task_id']}}"/>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Task Status">Task Status </label><br/>
                                    <input id="task-status" name="task_status" type="checkbox" data-toggle="toggle" data-on="Completed"
                                           data-off="Not Completed"/>
                                </div>
                                <div class="form-group">
                                    <label class="" for="Reason">Mention Reason </label>
                                    <textarea class="form-control" id="reason" cols="10" rows="5" type="text"
                                              name="reason" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="response keyword">Response Keyword</label>
                                    <select name="response_keyword_id"  id="response-keyword" class="form-control"
                                            required disabled>
                                        @if($data['response-keyword']->isNotEmpty())
                                            <option value="" selected disabled>Select Option</option>
                                            @foreach($data['response-keyword'] as $responseKeyword)
                                                <option value="{{$responseKeyword->id}}">{{$responseKeyword->title}}</option>
                                            @endforeach
                                        @else
                                            <option value="">No Data Available!</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Followup">Any Sales?</label>
                                    <select name="sales_status" id="sales" class="form-control" required disabled>
                                        <option value="" selected disabled>Select Option</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="next-followup-date">Next Followup Date</label>
                                    <input id="next-followup-date" type="text" name="next_followup_date"
                                           class="form-control" data-date-format="yyyy-mm-dd" required>
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
            $(function () {
                //Date Picker
                var date = new Date();
                var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                $('#next-followup-date').datepicker({
                    minDate: today
                })
            });

            $(function () {
                $('#task-status').change(function () {
                    if ($(this).prop('checked')) {//completed
                        $('#response-keyword,#sales').prop('disabled', false);
                        $('#reason').prop('disabled', true);
                    }
                    else {//not completed
                        $('#response-keyword,#sales').prop('disabled', true);
                        $('#reason').prop('disabled', false);
                    }
                })
            })
        });
    </script>
@endsection