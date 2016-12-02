@extends('backend.master')

@section('content')
    <style>
        i {
            margin-left: 10px;
            -webkit-transition: 0.3s;
            -moz-transition: 0.3s;
            -ms-transition: 0.3s;
            -o-transition: 0.3s;
            transition: 0.3s;
        }
        .fa-trash:hover {
            color: red;
            -webkit-transition: 0.3s;
            -moz-transition: 0.3s;
            -ms-transition: 0.3s;
            -o-transition: 0.3s;
            transition: 0.3s;
        }
        .fa-edit:hover {
            color: forestgreen;
            -webkit-transition: 0.3s;
            -moz-transition: 0.3s;
            -ms-transition: 0.3s;
            -o-transition: 0.3s;
            transition: 0.3s;
        }
        .table>thead>tr>th {
            vertical-align: middle;
            text-align: center;
        }
    </style>
    <div class="row">
        <div class="col-xs-offset-1 col-xs-10">
            <div class="box box-danger">

                <!-- /.box-header -->
                <div class="box-body">
                    <a href="{{asset('products/new')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add Product</a>
                    <a href="{{asset('products/export')}}" class="btn btn-default">Export <i class="fa fa-file-text-o"></i></a>
                    <table id="products-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th rowspan="2">S/N</th>
                            <th rowspan="2">Product Code</th>
                            <th rowspan="2">Product Code</th>
                            <th rowspan="2">Colour</th>
                            <th rowspan="2">Description</th>
                            <th rowspan="2">Quantity</th>
                            <th colspan="3">Pricing (SGD)</th>
                            <th rowspan="2">Actions</th>
                        </tr>
                        <tr>
                            <th>1-3 Days</th>
                            <th>4-6 Days</th>
                            <th>> 6 Days</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($products)
                        <?php $i=0; ?>
                        @foreach($products as $product)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$product->code}}</td>
                                <td>{{$product->code}}</td>
                                <td>{{$product->color==null?'not set':$product->color}}</td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{number_format($product->d13,2)}}</td>
                                <td>{{number_format($product->d46,2)}}</td>
                                <td>{{number_format($product->d6,2)}}</td>
                                <td><a href="{{asset('products/view/'.$product->code)}}"><i class="fa fa-eye"></i></a><a><i data-toggle="modal" data-target="#deleteProductConfirmation" data-id="{{$product->id}}" class="fa fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    <br>
                    <button class="btn btn-primary show-hide-removed" onclick="$('.show_hide').toggle();">
                        <span class="show_hide" style="display: none;">Show</span>
                        <span class="show_hide">Hide</span> deleted products
                    </button>
                    <br>
                    <div class="show_hide">
                        <h4>Removed Products</h4>
                        <table id="removed-products-table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th rowspan="2">S/N</th>
                                <th rowspan="2">Product Code</th>
                                <th rowspan="2">Product Code</th>
                                <th rowspan="2">Colour</th>
                                <th rowspan="2">Description</th>
                                <th rowspan="2">Quantity</th>
                                <th colspan="3">Pricing (SGD)</th>
                                <th rowspan="2">Actions</th>
                            </tr>
                            <tr>
                                <th>1-3 Days</th>
                                <th>4-6 Days</th>
                                <th>> 6 Days</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($removedProducts)
                                <?php $i=0; ?>
                                @foreach($removedProducts as $product)
                                    @if($product->deleted_at != null)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{ $product->code }}</td>
                                            <td>{{ $product->code }}</td>
                                            <td>{{ $product->color==null?'not set':$product->color }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ number_format($product->d13,2) }}</td>
                                            <td>{{ number_format($product->d46,2) }}</td>
                                            <td>{{ number_format($product->d6,2) }}</td>
                                            <td><a href="{{asset('products/restore/' . $product->code)}}"><i class="fa fa-refresh"></i></a></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="modal fade" role="dialog" id="deleteProductConfirmation">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Warning</h4>
                </div>
                <div class="modal-footer">
                    <p>Confirm Delete?</p>
                    <a id="proceedDelete" href="" class="btn btn-primary">Yes</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        $(document).on('click', '.fa-trash', function() {
            var id = $(this).attr('data-id');
            $('#proceedDelete').attr('href', '{{asset('products/remove')}}' + '/' + id);
        });
        $(document).ready(function(){
            $('#products-table').DataTable({
                "paging": true,
                "pagingType": "full_numbers",
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "dom": '<"top"flp<"clear">>rt',
                "columnDefs": [ {
                    "visible": false,
                    "targets": 1
                } ]
            });
            $('#removed-products-table').DataTable({
                "paging": true,
                "pagingType": "full_numbers",
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "dom": '<"top"flp<"clear">>rt',
                "columnDefs": [ {
                    "visible": false,
                    "targets": 1
                } ]
            });
        });
    </script>
@endsection