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
    </style>
    <div class="col-md-offset-2 col-md-6">
        <!-- Horizontal Form -->
        <div class="box box-danger">
            <form class="form-horizontal" method="POST" action="/products/update" enctype="multipart/form-data">
                <div class="box-header with-border">
                    <h3 class="box-title">New Product</h3>
                    <div class="col-md-12 control-buttons">
                        <a href="{{URL::previous()}}"><i class="fa fa-arrow-left"></i> Cancel</a>
                        <input id="saveCustomer" type="submit" class="btn btn-info pull-right" value="Save Changes">
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <input type="hidden" name="id" value="{{$product->id}}">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Product Type:</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="type" name="category_type">
                                <option value="existing">Existing Category</option>
                                <option value="new">New Category</option>
                            </select>
                        </div>
                        <div class="col-sm-offset-1 col-sm-5" id="sel-div">
                            <select class="form-control type-input-select" id="category">

                                @foreach($types as $type)
                                    <option @if($product->type == $type->type)
                                            selected
                                            @endif
                                            value="{{$type->type}}">{{$type->type}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('type'))
                                <span class="error-msg">{{$errors->first('type')}}</span>
                            @endif
                        </div>
                        <div id="inp-div" class="col-sm-offset-1 col-sm-5 hidden">
                            <input type="text" class="form-control type-input">
                            @if ($errors->has('type'))
                                <span class="error-msg">{{$errors->first('type')}}</span>
                            @endif
                        </div>
                        <input type="hidden" name="type" value="{{$product->type}}">
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Product Code:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="code" name="code" value="{{$product->code}}">
                            @if ($errors->has('code'))
                                <span class="error-msg">{{$errors->first('code')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color" class="col-sm-3 control-label">Colour:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="color" name="color" value="{{$product->color}}">
                            @if ($errors->has('color'))
                                <span class="error-msg">The field is required</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pic_name" class="col-sm-3 control-label">Description:</label>

                        <div class="col-sm-9">
                            <textarea class="form-control" id="description" name="description">{{$product->description}}</textarea>
                            @if ($errors->has('description'))
                                <span class="error-msg">The field is required</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color" class="col-sm-3 control-label">Quantity:</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="quantity" name="quantity" min="0" value="{{$product->quantity}}">
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
                            <input type="number" class="form-control" id="quantity" name="d13" min="0" step="0.01" value="{{number_format($product->d13,2)}}">
                            @if ($errors->has('d13'))
                                <span class="error-msg">The field is required</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color" class="col-sm-3 control-label">4-6 Days: SGD</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="quantity" name="d46" min="0" step="0.01" value="{{number_format($product->d46,2)}}">
                            @if ($errors->has('d46'))
                                <span class="error-msg">The field is required</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color" class="col-sm-3 control-label">> 6 Days: SGD</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="quantity" name="d6" min="0" step="0.01" value="{{number_format($product->d6,2)}}">
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
                    @if($product->image)
                        <div style="text-align: center;">
                            <img style="max-width: 200px;" src="{{ asset($product->image) }}">
                        </div>
                    @endif
                </div>
                <!-- /.box-body -->
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box -->
    </div>
    <script>
        $(document).ready(function() {
            $('input[name=type]').val('{{$product->type}}');
        });
        $('.type-input-select').on('change', function() {
            $('input[name=type]').val($('.type-input-select').val());
        });
        $('.type-input').on('keydown keyup focus', function() {
            $('input[name=type]').val($('.type-input').val());
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