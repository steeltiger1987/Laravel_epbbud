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
    </style>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Products</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="products-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Colour</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0; ?>
                        @foreach($products as $product)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->color}}</td>
                                <td>{{$product->quantity}}</td>
                                <td><a href="{{asset('products/edit/'.$product->id)}}"><i class="fa fa-edit"></i></a><a href="{{asset('products/remove/'.$product->id)}}"><i class="fa fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Colour</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                    </table>
                    <a href="{{asset('products/new')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add Product</a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <script>
        $(document).ready(function(){
            $('#products-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
@endsection