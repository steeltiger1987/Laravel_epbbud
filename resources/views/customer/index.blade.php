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
                    <h3 class="box-title">Customers</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="customers-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Company Name</th>
                            <th>PIC Name</th>
                            <th>PIC Email</th>
                            <th>PIC Contact</th>
                            <th>Website</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($customers)
                        <?php $i=0; ?>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$customer->company_name}}</td>
                                <td>{{$customer->pic_name}}</td>
                                <td>{{$customer->pic_email}}</td>
                                <td>{{$customer->pic_contact}}</td>
                                <td>{{$customer->website}}</td>
                                <td><a href="{{asset('customers/edit/'.$customer->id)}}"><i class="fa fa-edit"></i></a><a href="{{asset('customers/remove/'.$customer->id)}}"><i class="fa fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Company Name</th>
                            <th>PIC Name</th>
                            <th>PIC Email</th>
                            <th>PIC Contact</th>
                            <th>Website</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                    </table>
                    <a href="{{asset('customers/new')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> New Customer</a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <script>
        $(document).ready(function(){
            $('#customers-table').DataTable({
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