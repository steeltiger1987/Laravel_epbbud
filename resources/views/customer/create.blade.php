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
            <form class="form-horizontal" method="POST" action="/customers/create">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="company_name" class="col-sm-3 control-label">Company Name</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="company_name" placeholder="Company" name="company_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pic_name" class="col-sm-3 control-label">PIC Name</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="pic_name" placeholder="John" name="pic_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pic_email" class="col-sm-3 control-label">PIC Email</label>

                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="pic_email" placeholder="mail@example.com" name="pic_email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pic_contact" class="col-sm-3 control-label">PIC Contact</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="pic_contact" name="pic_contact">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="website" class="col-sm-3 control-label">Website</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="website" placeholder="www.website.com" name="website">
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