<div class="form-group row required">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name',(isset($item) && $item->name) ? $item->name : '' ) }}" required autofocus>

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
        <input id="quantity" type="number" class="form-control{{ $errors->has('qty') ? ' is-invalid' : '' }}" name="qty" value="{{ old('qty',(isset($item) && $item->qty) ? $item->qty : '') }}" required>

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
        <input id="price" type="number" max="999999.99" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price',(isset($item) && $item->price) ? $item->price : '') }}" required step="0.01" min="0">
        
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
                <option @if(old('manufacturer',(isset($item) && $item->manufacturer) ? $item->manufacturer : 0) == $key) selected="selected" @endif value="{{ $key }}">{{ $man }}</option>
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
                <option @if(old('model',(isset($item) && $item->model) ? $item->model : 0) == $keyModel) selected="selected" @endif value="{{ $keyModel }}">{{ $model }}</option>
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
        <input id="date_of_purchased" required readonly="" type="text" class="form-control datepicker {{ $errors->has('date_of_purchased') ? ' is-invalid' : '' }}" name="date_of_purchased" value="{{ old('date_of_purchased',(isset($item) && $item->date_of_purchased) ? $item->date_of_purchased : date('d-m-Y')) }}">

        @if ($errors->has('date_of_purchased'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('date_of_purchased') }}</strong>
            </span>
        @endif
    </div>
</div>