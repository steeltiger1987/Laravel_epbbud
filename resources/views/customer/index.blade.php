@extends('backend.master')

@section('content')
    <?php
    use App\Customer;
    ?>
    <div class="row">
        <div class="col-xs-offset-1 col-xs-10">
            <div class="box box-danger">

                <!-- /.box-header -->
                <div class="box-body">
                    <a href="{{asset('customers/new')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> New Customer</a>
                    <a href="{{asset('customers/export')}}" class="btn btn-default">Export <i class="fa fa-file-text-o"></i></a>
                    <table id="customers-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Company Name</th>
                            <th>Company Address</th>
                            <th>PIC</th>
                            <th>Phone Number</th>
                            <th>Email Address</th>
                            <th>Payment Terms</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($customers)
                        <?php $i=0;?>
                        @foreach($customers as $customer)
                            <?php
                            $pics = Customer::find($customer->id)->pics()->get();
                            ?>
                            @foreach($pics as $pic)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$customer->company_name}}</td>
                                <td>{{$customer->company_address}}</td>
                                <td>@if(isset($pic)){{$pic->name}}@endif</td>
                                <td>@if(isset($pic)){{$pic->phone}}@endif</td>
                                <td>@if(isset($pic)){{$pic->email}}@endif</td>
                                <td>{{$customer->payment_terms}}</td>
                                <td>
                                    @if($customer->deleted_at == null)
                                    <a href="{{asset('customers/view/'.$customer->abbreviation)}}"><i class="fa fa-eye"></i></a>
                                    <a class="rm-a"><i data-toggle="modal" data-target="#deleteCustomerConfirmation" class="fa fa-trash" data-id="{{$customer->id}}"></i></a>
                                    @else
                                    Deleted
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                        @endif
                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <button class="btn btn-primary show-hide-removed" onclick="$('.show_hide').toggle();">
                <span class="show_hide" style="display: none;">Show</span>
                <span class="show_hide">Hide</span> deleted costumers
            </button>
            <div class="box show_hide">
                <div class="box-header with-border">
                    <h3 class="box-title">Deleted Customers</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <table id="customers-table2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Company Name</th>
                            <th>Company Address</th>
                            <th>PIC</th>
                            <th>Phone Number</th>
                            <th>Email Address</th>
                            <th>Payment Terms</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($removedCustomers)
                            <?php $i=0;?>
                            @foreach($removedCustomers as $customer)
                                <?php
                                $pics = \App\Pic::where('customer_id', $customer->id)->get();
                                ?>
                                @foreach($pics as $pic)
                                    @if($customer->deleted_at != null)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$customer->company_name}}</td>
                                        <td>{{$customer->company_address}}</td>
                                        <td>@if(isset($pic)){{$pic->name}}@endif</td>
                                        <td>@if(isset($pic)){{$pic->phone}}@endif</td>
                                        <td>@if(isset($pic)){{$pic->email}}@endif</td>
                                        <td>{{$customer->payment_terms}}</td>
                                        <td>
                                           <a href="{{ asset('customers/restore/' . $customer->id) }}"><i class="fa fa-refresh"></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                        </tbody>

                    </table>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="deleteCustomerConfirmation">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Warning</h4>
                </div>
                <div class="modal-body">
                    <p>Invoices, Quotation and D/O related to this company will be kept</p>
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
            $('#proceedDelete').attr('href', '{{asset('customers/remove')}}' + '/' + id);
        });
        $(document).ready(function(){
            $('#customers-table').DataTable({
                "paging": true,
                "pagingType": "full_numbers",
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "dom": '<"top"flp<"clear">>rt<"bottom"ilp<"clear">>'
            });
        });
        $(document).ready(function(){
            $('#customers-table2').DataTable({
                "paging": true,
                "pagingType": "full_numbers",
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "dom": '<"top"flp<"clear">>rt<"bottom"ilp<"clear">>'
            });
        });
        $(document).on('click', '[data-widget="collapse"]', function(){
             $('#customers-table2').toggle();
        });
    </script>
@endsection