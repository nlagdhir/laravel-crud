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
     * Display a listing of the items.
     */
    public function index()
    {   
        return view('items.index');
    }

    /**
     * Show the form for creating a new item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $user = Auth::user(); 

        if($user->items()->create($request->all())){
            flash('item created')->success();
        }else{
            flash('item not created')->error();
        }
        return redirect(route('item.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::where('id',$id)->first();
        return View::make('items.show')->with('item', $item)->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, $id)
    {
        $item = Item::find($id);
        if($item && $item->count() > 0){
            if($item->update($request->all())){
                flash('item updated')->success();
            }else{
                flash('item not updated')->error();    
            }
        }else{
            flash('item could not found!')->error();
        }
        return redirect(route('item.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
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
