@extends('backend.master')

@section('content')
    <style>
        .control-buttons {
            margin-top: 15px;
        }
        #description {
            resize: vertical;
        }
        .error-msg {
            color: red;
        }
        .hidden {
            display: none;
        }
    </style>
<div class="col-md-offset-2 col-md-6">
    <!-- Horizontal Form -->
    <div class="box box-danger">
        <form class="form-horizontal" method="POST" action="/products/create" enctype="multipart/form-data">
        <div class="box-header with-border">
            <h3 class="box-title">New Product</h3>
            <div class="col-md-12 control-buttons">
                <a href="{{asset('products')}}"><i class="fa fa-arrow-left"></i> Cancel</a>
                <input id="saveCustomer" type="submit" class="btn btn-info pull-right" value="Save Changes">
            </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Product Type:</label>
                    <div class="col-sm-3">
                        <select class="form-control" id="type" name="category_type">
                            <option value="existing" @if(!empty(old('category_type')) && old('category_type') == 'existing') selected @endif>Existing Category</option>
                            <option value="new" @if(!empty(old('category_type')) && old('category_type') == 'new') selected @endif>New Category</option>
                        </select>
                    </div>
                    <div class="col-sm-offset-1 col-sm-5" id="sel-div">
                        <select class="form-control type-input-select">
                            <option value="">-- Please select --</option>
                            @foreach($types as $type)
                                <option @if(old('type') == $type->type) selected @endif>{{ $type->type }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('type'))
                            <span class="error-msg">{{ $errors->first('type') }}</span>
                        @endif
                    </div>
                    <div id="inp-div" class="col-sm-offset-1 col-sm-5 hidden">
                        <input type="text" class="form-control type-input">
                        @if ($errors->has('type'))
                            <span class="error-msg">{{ $errors->first('type') }}</span>
                        @endif
                    </div>
                    <input type="hidden" name="type">
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Product Code:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}">
                        @if ($errors->has('code'))
                            <span class="error-msg">{{$errors->first('code')}}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="color" class="col-sm-3 control-label">Colour:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="color" name="color" value="{{ old('color') }}">
                        @if ($errors->has('color'))
                            <span class="error-msg">The field is required</span>
                        @endif
                        <span class="error-msg address-error"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pic_name" class="col-sm-3 control-label">Description:</label>

                    <div class="col-sm-9">
                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="error-msg">The field is required</span>
                        @endif
                        <span class="error-msg address-error"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="color" class="col-sm-3 control-label">Quantity:</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="quantity" name="quantity" min="0" value="{{ old('quantity') }}">
                        @if ($errors->has('quantity'))
                            <span class="error-msg">The field is required</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="color" class="col-sm-3 control-label">Pricing</label>
                </div>
                <div class="form-group">
                    <label for="color" class="col-sm-3 control-label">1-3 Days: SGD</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="quantity" min="0" step="0.01" name="d13" value="{{ old('d13') }}">
                        @if ($errors->has('d13'))
                            <span class="error-msg">The field is required</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="color" class="col-sm-3 control-label">4-6 Days: SGD</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="quantity" name="d46" min="0" step="0.01" value="{{ old('d46') }}">
                        @if ($errors->has('d46'))
                            <span class="error-msg">The field is required</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="color" class="col-sm-3 control-label">> 6 Days: SGD</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="quantity" name="d6" min="0" step="0.01" value="{{ old('d6') }}">
                        @if ($errors->has('d6'))
                            <span class="error-msg">The field is required</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="color" class="col-sm-3 control-label">Image:</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" id="image" name="image">
                        @if ($errors->has('image'))
                            <span class="error-msg">@if(isset($errors)) {{ $errors->first('image') }} @endif</span>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
        </form>
    </div>
    <!-- /.box -->
</div>
    <script>
        $(document).ready(function() {
            $('input[name="type"]').val($('.type-input-select').val());
        });
        $('.type-input-select').on('change', function() {
            $('input[name="type"]').val($('.type-input-select').val());
        });
        $('.type-input').on('keydown keyup focus', function() {
            $('input[name="type"]').val($('.type-input').val());
        });
        $(document).on('focus', 'input', function() {
           $('.error-msg').text('');
        });
        $(document).on('textarea', 'input', function() {
            $('.error-msg').text('');
        });
        $(document).on('change', 'select[name=category_type]', function() {
            var cat = $(this).val();
            if(cat == 'new') {
                $('#sel-div').addClass('hidden');
                $('#inp-div').removeClass('hidden');
            }else {
                $('#inp-div').addClass('hidden');
                $('#sel-div').removeClass('hidden');
            }
        });
    </script>
@endsection