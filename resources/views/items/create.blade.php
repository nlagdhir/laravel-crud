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
                    <form method="POST" action="{{ route('item.store') }}" class="form-validate">
                        @csrf

                        @include('items.form')

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
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

