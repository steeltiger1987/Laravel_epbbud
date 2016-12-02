@extends('backend.master')

@section('content')
    <style>
        #company_address {
            resize: vertical;
        }
        .add-new-pic {
            margin-top: 10px;
        }
        .custom-control {
            height: 24px;
        }
        .control-buttons {
            margin-top: 15px;
        }
        .remover {
            cursor: pointer;
        }
        .remover:hover {
            color: red;
            -webkit-transition-delay: 0.1s;
            -moz-transition-delay: 0.1s;
            -ms-transition-delay: 0.1s;
            -o-transition-delay: 0.1s;
            transition-delay: 0.1s;
        }
        .error-msg {
            color: red;
        }
    </style>
    <div class="row">
    <div class="col-md-offset-2 col-md-7">
        <!-- Horizontal Form -->
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">New Customer</h3>
                <div class="col-md-12 control-buttons">
                    <a href="{{ URL::previous() }}"><i class="fa fa-arrow-left"></i> Cancel</a>
                    <button form="main-form" type="submit" id="saveCustomer" class="btn btn-info pull-right">Save</button>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="main-form" method="POST" action="/customers/create">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="company_name" class="col-sm-3 control-label">Company Name:</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="company_name" placeholder="Company" name="company_name" value="{{old('company_name')}}" required>
                            <span class="error-msg name-error">{{$errors->first('company_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company_name" class="col-sm-3 control-label">Abbreviation:</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="abbreviation" name="abbreviation" value="{{old('abbreviation')}}" required>
                            <span class="error-msg name-error">{{$errors->first('abbreviation')}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pic_name" class="col-sm-3 control-label">Company Address:</label>

                        <div class="col-sm-9">
                            <textarea class="form-control" id="company_address" name="company_address" required>{{old('company_address')}}</textarea>
                            <span class="error-msg address-error">{{$errors->first('company_address')}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company_name" class="col-sm-3 control-label">Default Discount, %:</label>

                        <div class="col-sm-9">
                            <input type="number" class="form-control" min="0" max="100" id="default_discount" name="default_discount" value="{{ old('default_discount') }}">
                            <span class="error-msg name-error">{{$errors->first('default_discount')}}</span>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>PIC</th>
                                <th>Name</th>
                                <th>Contact No.</th>
                                <th>Fax</th>
                                <th style="border-right: none;">Email Address</th>
                                <th style="border-left: none;"> </th>
                            </tr>
                        </thead>
                        <tbody class="pic-persons-table">

                        </tbody>
                    </table>
                    <button id="addNewPic" class="btn btn-success add-new-pic"><i class="fa fa-plus-circle"></i> add new PIC</button>
                    <span class="error-msg pic-error"></span>
                    <div class="form-group" style="margin-top: 20px;">
                        <label for="pic_contact" class="col-sm-3 control-label">Payment Terms:</label>

                        <div class="col-sm-9">
                            <select id="payment_terms" name="payment_terms" class="form-control" required>
                                <option value="">-- Please Select --</option>
                                <option value="Cash/Cheque on Delivery">Cash/Cheque on Delivery</option>
                                <option value="Payment via Bank Transfer/Credit Card">Payment via Bank Transfer/Credit Card</option>
                                <option value="7 Days Term">7 Days Term</option>
                                <option value="14 Days Term">14 Days Term</option>
                                <option value="30 Days Term">30 Days Term</option>
                                <option value="60 Days Term">60 Days Term</option>
                            </select>
                            <span class="error-msg address-error">{{$errors->first('payment_terms')}}</span>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

            </form>
        </div>
        <!-- /.box -->
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.pic-persons-table').append("<tr class=\"pic-entry\">" +
                    "<td class=\"index\">1</td>" +
                    "<td>" +
                    "<input type=\"text\" pattern=\"[a-zA-Z\\s]+\" class=\"form-control custom-control\" id=\"pic_name\" required name=\"pic_name[]\">" +
                    "</td>" +
                    "<td>" +
                    "<input type=\"text\" pattern=\"[0-9\\s]+\" class=\"form-control custom-control\" required id=\"pic_contact\" name=\"pic_contact[]\">" +
                    "</td>" +
                    "<td>" +
                    "<input type=\"text\" pattern=\"[0-9\\s]+\" class=\"form-control custom-control\" required id=\"pic_fax\" name=\"pic_fax[]\">" +
                    "</td>" +
                    "<td style=\"border-right: none;\"><input type=\"email\" class=\"form-control custom-control\" id=\"pic_email\" required placeholder=\"mail@example.com\" name=\"pic_email[]\">" +
                    "</td>" +
                    "<td style=\"border-left: none;\"><span class=\"remover\">x</span></td></tr>")
            var i = 1;
           $(document).on('click', '#addNewPic', function(e) {
               e.preventDefault();
               var indexes = $(document).find('.index');
               var i = indexes.length+1;
               $('.pic-persons-table').append("<tr class=\"pic-entry\">" +
                       "<td class=\"index\">"+i+"</td>" +
                       "<td>" +
                       "<input type=\"text\" pattern=\"[a-zA-Z\\s]+\" class=\"form-control custom-control\" id=\"pic_name\" name=\"pic_name[]\">" +
                       "</td>" +
                       "<td>" +
                       "<input type=\"text\" pattern=\"[0-9\\s]+\" class=\"form-control custom-control\" id=\"pic_contact\" name=\"pic_contact[]\">" +
                       "</td>" +
                       "<td>" +
                       "<input type=\"text\" pattern=\"[0-9\\s]+\" class=\"form-control custom-control\" id=\"pic_fax\" name=\"pic_fax[]\">" +
                       "</td>" +
                       "<td style=\"border-right: none;\"><input type=\"email\" class=\"form-control custom-control\" id=\"pic_email\" placeholder=\"mail@example.com\" name=\"pic_email[]\">" +
                       "</td>" +
                       "<td style=\"border-left: none;\"><span class=\"remover\">x</span></td></tr>")
               $(document).on('click', '.remover', function() {
                   $(this).parent().parent().remove();
                   var indexes = $(document).find('.index');
                   var newIndex = 1;
                   for (var k = 0; k < indexes.length; k++) {
                       $(indexes[k]).text(newIndex);
                       newIndex++;
                   }

               });
           });
        });
        $(document).on('focus', 'input', function() {
            $('.error-msg').text('');
        });
        $(document).on('focus', 'textarea', function() {
            $('.error-msg').text('');
        });
    </script>
@endsection