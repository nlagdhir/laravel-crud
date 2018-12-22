<?php

namespace App\Http\Controllers;

use Auth;
use View;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the items for current user.
     */
    public function index()
    {   
        return view('items.index');
    }

    /**
     * Show the form for creating a new item.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created item in storage.
     */
    public function store(ItemRequest $request)
    {
        $user = Auth::user(); 

        if($user->items()->create($request->all())){
            flash('Item created.')->success();
        }else{
            flash('Item not created.')->error();
        }
        return redirect(route('item.index'));
    }

    /**
     * Display the specified item.
     */
    public function show($id)
    {
        $item = Item::where('id',$id)->first();
        return View::make('items.show')->with('item', $item)->render();
    }

    /**
     * Show the form for editing the specified item.
     */
    public function edit($id)
    {
        $user = Auth::user();

        $item = Item::where('id',$id)->first();
        if ($user->can('view', $item)) {
           if($item && $item->count() > 0){
                return view('items.edit',compact('item'));
            }else{
                return redirect()->back();
            } 
        }else{
            abort(403);
        }
        
    }

    /**
     * Update the specified item in storage.
     *
     */
    public function update(ItemRequest $request, $id)
    {
        $item = Item::find($id);
        if($item && $item->count() > 0){
            if($item->update($request->all())){
                flash('Item updated.')->success();
            }else{
                flash('Item not updated.')->error();    
            }
        }else{
            flash('Item could not found.')->error();
        }
        return redirect(route('item.index'));
    }

    /**
     * Remove the specified item from storage.
     *
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        if($item && $item->count() > 0){
            if($item->delete()){
                flash('Item deleted.')->success();
            }else{
                flash('Item not deleted.')->error();
            }    
        }
        return redirect()->back();
    }
}
