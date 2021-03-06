@extends('backend.master')



@section('content')
<div class="row">
    <div class="col-xs-12">
        <!--Session Msg Include -->
        @include('common.message')

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="users-table" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; ?>
                    @foreach($users as $user)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                <a href="{{route("user/edit",['id'=>$user->id])}}" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{route("user/delete",['id'=>$user->id])}}" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
                <a href="{{asset('users/new')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> New User</a>
            </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
    <script>
        $(document).ready(function(){
            $('#users-table').DataTable({
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