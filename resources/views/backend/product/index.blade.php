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
                <li class="active">Products</li>
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
                            <h3 class="box-title">Product Management</h3>
                            <a href="{{route($base_route.'.add')}}" class="btn btn-xs btn-primary"><i
                                        class="fa fa-plus"></i> Add</a>
                            <div class="col-sm-3 col-xs-12" style="float: right;">
                                <form action="{{route('backend.product.search')}}" method="GET" role="search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="searchQuery"
                                               placeholder="Search Product.."> <span class="input-group-btn">
                                {{ csrf_field() }}
                                            <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                                </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{trans($trans_path.'general.columns.sn')}}</th>
                                    <th>{{trans($trans_path.'general.columns.title')}}</th>
                                    <th>{{trans($trans_path.'general.columns.price')}}</th>
                                    <th>{{trans($trans_path.'general.columns.primary')}}</th>
                                    <th>{{trans($trans_path.'general.columns.secondary')}}</th>
                                    <th>{{trans($trans_path.'general.columns.stock')}}</th>
                                    <th>{{trans($trans_path.'general.columns.action')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(count($data['searchProducts']) < 1)
                                    @if(!$data['rows']->isEmpty())

                                        <?php $i = 1; ?>
                                        @foreach($data['rows'] as  $rowData)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{ $rowData->title}}
                                                </td>
                                                <td>Rs. {{ $rowData->price}}</td>
                                                <td>{{ $rowData->PrimaryCategory->title}}</td>
                                                <td>{{ $rowData->SecondaryCategory->title}}</td>
                                                <td>@if( $rowData->stock == 0)<span
                                                            class="label label-danger stock" style="cursor: pointer;"
                                                            data-id="{{$rowData->id}}">Out of Stock</span> @elseif( $rowData->stock == 1)
                                                        <span class="label label-success stock" style="cursor: pointer;"
                                                              data-id="{{ $rowData->id}}">In Stock</span> @else
                                                        <span
                                                                class="label label-info">On Sale</span> @endif</td>
                                                <td>
                                                    @if( $rowData->status == 0)<span
                                                            class="label label-success show" style="cursor: pointer;"
                                                            data-id="{{$rowData->id}}">Show</span> @elseif( $rowData->status == 1)
                                                        <span class="label label-danger show" style="cursor: pointer;"
                                                              data-id="{{ $rowData->id}}">Hide</span> @else
                                                       @endif
                                                    <a href="{{route($base_route.'.edit',['id'=> $rowData->id])}}"
                                                       class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" type="button" data-toggle="modal"
                                                       data-id="{{ $rowData->id}}"
                                                       data-target="#modal-danger-{{ $rowData->id}}"
                                                       class="btn btn-danger delete btn-xs"><i
                                                                class="fa fa-trash"></i></a>
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
                                            <td colspan="5">No Data!</td>
                                        </tr>

                                    @endif
                                @else

                                @endif
                                <?php $i = 1; ?>
                                @foreach($data['searchProducts'] as  $rowData)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{ $rowData->title}}
                                        </td>
                                        <td>Rs. {{ $rowData->price}}</td>
                                        <td>{{ $rowData->PrimaryCategory->title}}</td>
                                        <td>{{ $rowData->SecondaryCategory->title}}</td>
                                        <td>@if( $rowData->stock == 0)<span
                                                    class="label label-danger stock" style="cursor: pointer;"
                                                    data-id="{{$rowData->id}}">Out of Stock</span> @elseif( $rowData->stock == 1)
                                                <span class="label label-success stock" style="cursor: pointer;"
                                                      data-id="{{ $rowData->id}}">In Stock</span> @else
                                                <span
                                                        class="label label-info">On Sale</span> @endif</td>
                                        <td>
                                            @if( $rowData->status == 0)<span
                                                    class="label label-success show" style="cursor: pointer;"
                                                    data-id="{{$rowData->id}}">Show</span> @elseif( $rowData->status == 1)
                                                <span class="label label-danger show" style="cursor: pointer;"
                                                      data-id="{{ $rowData->id}}">Hide</span> @else
                                            @endif

                                            <a href="{{route($base_route.'.edit',['id'=> $rowData->id])}}"
                                               class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                                            <a href="#" type="button" data-toggle="modal"
                                               data-id="{{ $rowData->id}}"
                                               data-target="#modal-danger-{{ $rowData->id}}"
                                               class="btn btn-danger delete btn-xs"><i
                                                        class="fa fa-trash"></i></a>
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
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{trans($trans_path.'general.columns.sn')}}</th>
                                    <th>{{trans($trans_path.'general.columns.title')}}</th>
                                    <th>{{trans($trans_path.'general.columns.price')}}</th>
                                    <th>{{trans($trans_path.'general.columns.primary')}}</th>
                                    <th>{{trans($trans_path.'general.columns.secondary')}}</th>
                                    <th>{{trans($trans_path.'general.columns.stock')}}</th>
                                    <th>{{trans($trans_path.'general.columns.action')}}</th>
                                </tr>
                                </tfoot>

                            </table>

                            @if(method_exists($data['searchProducts'],'links'))
                                {{ $data['searchProducts']->appends(request()->query())->links() }}
                            @elseif(method_exists($data['rows'],'links'))
                                {{ $data['rows']->links() }}
                            @endif

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
            var result;
            $('.stock').click(function () {
                result = null;
                /**
                 * call ajax funciton from master blade
                 * @param1 Ajax Method
                 * @param2 Ajax Partial URL
                 * @param3 Ajax data
                 * @result Ajax Status:string
                 */
                result = ajaxCall('POST', '/admin/product-stock-status-ajax', {
                    'pid': $(this).data('id'),
                    '_token': '{{csrf_token()}}'
                });
                location.reload();
            });

            $('.show').click(function () {
                result = null;
                /**
                 * call ajax funciton from master blade
                 * @param1 Ajax Method
                 * @param2 Ajax Partial URL
                 * @param3 Ajax data
                 * @result Ajax Status:string
                 */
                result = ajaxCall('POST', '/admin/product-show-status-ajax', {
                    'pid': $(this).data('id'),
                    '_token': '{{csrf_token()}}'
                });
                location.reload();
            });



        });
    </script>
@endsection
