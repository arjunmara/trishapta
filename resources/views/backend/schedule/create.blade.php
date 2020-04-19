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
                <li class="active">Create Today's Task</li>
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
                            <h3 class="box-title">Create Today's Task</h3>
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
                        <form role="form" action="{{route($base_route.'.store')}}" method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Client Name">Choose Client</label>
                                    <select name="client_id" class="form-control" required>
                                        @if($data['clients']->isNotEmpty())
                                            @foreach($data['clients'] as $client)
                                                <option value="{{$client->id}}">{{$client->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="">No Data Available!</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="time">Time</label>
                                    <input type="text" name="time" class="form-control" id="time"
                                           placeholder="Time" required>
                                </div>
                                <div class="form-group">
                                    <label for="keynotes">Keynotes</label>
                                    <input type="text" name="keynotes" class="form-control" id="keynotes"
                                           placeholder="Keynotes">
                                </div>
                                <div class="form-group">
                                    <label for="Followup">Followup Type</label>
                                    <select name="visit_type" class="form-control" required>
                                            <option value="Visit">Client Visit</option>
                                            <option value="Phone Call">Phone Call</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
                                <button type="submit" name="submitandadd" value="submitandadd" class="btn btn-primary">Submit And Add New</button>
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
            $(function () {
                //Timepicker
                $('#time').timepicker({
                    showInputs: false
                })
            });
        });
    </script>
@endsection