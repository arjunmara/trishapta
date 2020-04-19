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
                <li class="active">Edit Schedule</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Schedule</h3>
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
                        <form role="form" action="{{route($base_route.'.update',['id'=> $data['row']->id])}}"
                              method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Client Name">Choose Client</label>
                                    <select name="client_id" class="form-control" required>
                                        @if($data['clients']->isNotEmpty())
                                            @foreach($data['clients'] as $client)
                                                <option value="{{$client->id}}"
                                                        @if($client->id == $data['row']->client_id) selected @endif>{{$client->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="">No Data Available!</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="time">Time</label>
                                    <input type="text" name="time" class="form-control" id="time"
                                           placeholder="Time" value="{{$data['row']->time}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="keynotes">Keynotes</label>
                                    <input type="text" name="keynotes" class="form-control" id="keynotes"
                                           placeholder="Keynotes" value="{{$data['row']->keynotes}}">
                                </div>
                                <div class="form-group">
                                    <label for="Followup">Followup Type</label>
                                    <select name="visit_type" class="form-control" required>
                                        <option value="Visit" @if($data['row']->visit_type == 'Visit') selected @endif>Client Visit</option>
                                        <option value="Phone Call" @if($data['row']->visit_type == 'Phone Call') selected @endif>Phone Call</option>
                                    </select>
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
                //Timepicker
                $('#time').timepicker({
                    showInputs: false
                })
            });
        });
    </script>
@endsection