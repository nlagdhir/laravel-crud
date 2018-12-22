@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker3.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add new item') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('item.update',$item->id) }}" class="form-validate">
                        @method('PATCH')
                        @csrf

                        <div class="form-group row required">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name',$item->name) }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row required">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

                            <div class="col-md-6">
                                <input id="quantity" type="number" class="form-control{{ $errors->has('qty') ? ' is-invalid' : '' }}" name="qty" value="{{ old('qty',$item->qty) }}" required>

                                @if ($errors->has('qty'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('qty') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row required">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="float" max="999999.99" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price',$item->price) }}" required>

                                @if ($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row required">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Manufacturer') }}</label>

                            <div class="col-md-6">
                                <select id="manufacturer" required class="form-control{{ $errors->has('manufacturer') ? ' is-invalid' : '' }}" name="manufacturer">
                                    <option value="">Please select</option>
                                    @foreach(config('setting')['manufacturer'] as $key => $man)
                                        <option @if(old('manufacturer',$item->manufacturer) == $key) selected="selected" @endif value="{{ $key }}">{{ $man }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('manufacturer'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('manufacturer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row required">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Model') }}</label>

                            <div class="col-md-6">
                                <select id="model" required class="form-control{{ $errors->has('model') ? ' is-invalid' : '' }}" name="model">
                                    <option value="">Please select</option>
                                    @foreach(config('setting')['models'] as $keyModel => $model)
                                        <option @if(old('model',$item->model) == $keyModel) selected="selected" @endif value="{{ $keyModel }}">{{ $model }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('model'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('model') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row required">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Date of purchase') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_purchased" required readonly="" type="text" class="form-control datepicker {{ $errors->has('date_of_purchased') ? ' is-invalid' : '' }}" name="date_of_purchased" value="{{ old('date_of_purchased',$item->date_of_purchased) }}">

                                @if ($errors->has('date_of_purchased'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_of_purchased') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script>
$(document).ready(function () {

    $('.datepicker').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy",
      todayHighlight: true,
    });
});

</script>

@endsection

