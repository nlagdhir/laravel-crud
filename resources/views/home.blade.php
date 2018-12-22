@extends('layouts.app')

@section('content')
<div class="container">
    <form class="form-inline" action="{{route('home')}}" id="searchform">
      <div class="form-group">
        <label for="exampleInputName2">Filter</label>
        <input type="text" class="form-control" name="filterText" id="exampleInputName2" placeholder="">
      </div>
      <button type="submit" class="btn btn-default searchbtn">Search</button>
    </form>
    <div class="clearfix"></div>
    <div class="search-result">
    <div class="table-responsive">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Qty</th>
      <th scope="col">Manufacturer</th>
      <th scope="col">Model</th>
      <th scope="col">Date of purchased</th>
    </tr>
  </thead>
  <tbody class="Item-lists">
    @foreach($items as $key=> $item)
        <tr class="item-row">
          <th scope="row">{{ $key+1 }}</th>
          <td>{{ $item->name }}</td>
          <td>{{ $item->price }}</td>
          <td>{{ $item->qty }}</td>
          <td>{{ config('setting')['manufacturer'][$item->manufacturer] }}</td>
          <td>{{ config('setting')['models'][$item->model] }}</td>
          <td>{{ $item->date_of_purchased }}</td>
        </tr>    
    @endforeach
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
            }
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
