@extends('backend.master')

@section('content')
<div class="col-md-offset-2 col-md-6">
    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Product's Information</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="/products/create">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" placeholder="Title" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="color" class="col-sm-2 control-label">Colour</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="color" placeholder="Colour" name="color">
                    </div>
                </div>
                <div class="form-group">
                    <label for="color" class="col-sm-2 control-label">Quantity</label>

                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="quantity" name="quantity" min="0">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Create</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
    <!-- /.box -->
</div>
@endsection