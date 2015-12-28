@extends('backend.master')

@section('content')
    <div class="col-md-offset-2 col-md-6">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Customer's Information</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="/customers/update">
                {!! csrf_field() !!}
                <input type="hidden" name="id" value="{{$customer->id}}">
                <div class="box-body">
                    <div class="form-group">
                        <label for="company_name" class="col-sm-2 control-label">Company Name</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="company_name" placeholder="Company" name="company_name" value="{{$customer->company_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pic_name" class="col-sm-2 control-label">PIC Name</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pic_name" placeholder="John" name="pic_name" value="{{$customer->pic_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pic_email" class="col-sm-2 control-label">PIC Email</label>

                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="pic_email" placeholder="mail@example.com" name="pic_email" value="{{$customer->pic_email}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pic_contact" class="col-sm-2 control-label">PIC Contact</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pic_contact" name="pic_contact" value="{{$customer->pic_contact}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="website" class="col-sm-2 control-label">Website</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="website" placeholder="www.website.com" name="website" value="{{$customer->website}}">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Update</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box -->
    </div>
@endsection