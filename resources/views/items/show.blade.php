@if($item && $item->count() > 0)
<table class="table table-bordered table-striped">
    <tbody>
        
        <tr>
            <th>Name</th>
            <td>{{ $item->name }}</td>
        </tr>
        <tr>
            <th>Price</th>
            <td>{{ $item->price }}</td>
        </tr>
        <tr>
            <th>Qty</th>
            <td>{{ $item->qty }}</td>
        </tr>
        <tr>
            <th>Manufacturer</th>
            <td>{{ config('setting')['manufacturer'][$item->manufacturer] }}</td>
        </tr>
        <tr>
            <th>Model</th>
            <td>{{ config('setting')['models'][$item->model] }}</td>
        </tr>
        <tr>
            <th>Date of purchased</th>
            <td>{{ $item->date_of_purchased }}</td>
        </tr>
    </tbody>
</table>
@else
    No record found
@endif