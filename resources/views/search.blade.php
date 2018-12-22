 <div class="table-responsive">
    <table class="table">
  <thead>
    <tr>
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