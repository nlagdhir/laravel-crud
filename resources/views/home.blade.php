@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <form action="{{route('home')}}" id="searchform"> 
        <div class="row">
          <div class="col-xs-6 col-md-4">
            <div class="input-group">
              <input type="text" class="form-control" required="required" name="filterText"  placeholder="Search" id="search"/>
              <div class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>

      <hr>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="search-result">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Qty</th>
            <th scope="col">Created By</th>
            <th scope="col">Manufacturer</th>
            <th scope="col">Model</th>
            <th scope="col">Date of purchased</th>
          </tr>
        </thead>
        <tbody class="Item-lists">
          @if($items && $items->count() > 0)
          @foreach($items as $key=> $item)
          <tr class="item-row">
            <td>{{ $item->name }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->qty }}</td>
            <td>{{ $item->user->name }}</td>
            <td>{{ config('setting')['manufacturer'][$item->manufacturer] }}</td>
            <td>{{ config('setting')['models'][$item->model] }}</td>
            <td>{{ $item->date_of_purchased }}</td>
          </tr>    
          @endforeach
          @else
          <tr class="item-row text-center">
            <td colspan="7">No record found</td>
          </tr> 
          @endif
        </tbody>
      </table>
      {!!$items->render()!!}
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{asset('js/infinite-scroll.pkgd.js')}}" type="text/javascript"></script>
<script type="text/javascript">
var $grid= $(".Item-lists");
jQuery(document).ready(function($){
  if($(".pagination").length>0){
    $grid.infiniteScroll({
      path: '.pagination a[rel="next"]',
      hideNav: ".pagination",
      append: ".item-row",
      history: false,
    });
  }

  $(document).on("submit","#searchform",function(){
    var data = $("#searchform").serialize();
    var url =$("#searchform").attr('action');
    $.ajax({
      url:url,
      type:"get",
      data:data,
      success:function(res){
        $(".search-result").html(res);
        setTimeout(updateScroll,1000);    
      },
      error:function(error){
        alert('server not responding');
      },
    });
    return false;
  });

})
function updateScroll(){
  $grid= $(".Item-lists");
  $grid.infiniteScroll({
    path: '.pagination a[rel="next"]',
    hideNav: ".pagination",
    append: ".item-row",
    history: false,
  });
}
</script>
@endsection
