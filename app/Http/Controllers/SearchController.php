<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use View;
use DB;
class SearchController extends Controller
{
    /**
    * Get all items from all users
    * 
    */
    public function index(Request $request)
    {
    	$filterText = $request->get('filterText','');
    	if($request->ajax() && !empty($filterText)){
    		$items = Item::select('items.*',DB::raw('users.name as uname'))->join('users','items.user_id','=','users.id')
    		->where(function($query) use($filterText){
    			return $query->orWhereRaw("users.name LIKE '%$filterText%'")
    			->orWhereRaw("items.name LIKE '%$filterText%'")
    			->orWhereRaw("items.qty LIKE '%$filterText%'")
    			->orWhereRaw("items.price LIKE '%$filterText%'");
    		})
    		->groupBy('items.id')
    		->paginate(17);
    		$querystringArray = ['filterText' => $filterText];
			$items->appends($querystringArray);
    		return View::make('search')->with(['items'=>$items])->render();
    	}

    	$items = Item::latest()->paginate(17);
    	return view('home',compact('items'));
    }
}
