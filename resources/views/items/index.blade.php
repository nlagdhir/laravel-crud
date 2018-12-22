@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-body">
                    <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h4>My Items</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped party-view">
                                <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Manufacturer</th>
                                        <th>Model</th>
                                        <th>Date of purchased</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(auth()->user()->items()->count() > 0)
                                    @foreach(auth()->user()->items()->latest()->get() as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ config('setting')['manufacturer'][$item->manufacturer] }}</td>
                                        <td>{{ config('setting')['models'][$item->model] }}</td>
                                        <td>{{ $item->date_of_purchased }}</td>
                                        <td>
                                            <a href="javascript:void(0)" data-url="{{route('item.show', $item->id)}}" class="btn btn-success btn-xs showItemDetails"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                            <a href="{{route('item.edit', $item->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <a href="javascript:void(0)" data-url="{{ route('item.destroy',$item->id) }}" class="btn btn-danger btn-xs deleteItem"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                     @else
                                    <tr>
                                      <td colspan="8">No record found!</td>
                                      <td style="display: none"></td>
                                      <td style="display: none"></td>
                                      <td style="display: none"></td>
                                      <td style="display: none"></td>
                                      <td style="display: none"></td>
                                      <td style="display: none"></td>
                                      <td style="display: none"></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        
    </div>
</div>
<div id="itemDetailModal" tabindex="-1" role="dialog" class="modal fade text-left" style="display: none;" aria-hidden="true">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="exampleModalLabel" class="modal-title">View Item</h4>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body item-details-container">
                
            </div>
        </div>
    </div>
</div>

<form id="deleteItem" action="#" method="post">
  @method('delete')
  @csrf
</form>

@endsection

@section('js')
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function () {
    $('.party-view').DataTable();

    $(document).on('click','.deleteItem',function(){
      if(confirm('Are you sure to want to delete item?')){
       var deleteUrl = $(this).data('url');
       $('#deleteItem').attr('action',deleteUrl);
       $('#deleteItem').submit(); 
      }
    });

    $(document).on("click", ".showItemDetails", function (e) {
        $(".item-details-container").html("");
        var url = $(this).data('url');
        $.ajax({
            url: url,
            type: "GET",
            success: function (res) {
                $(".item-details-container").html(res);
                $("#itemDetailModal").modal('show');
            },
            error: function () {
                $(".item-details-container").html("No Data found");
            }
        });
    });
});
</script>

@endsection

