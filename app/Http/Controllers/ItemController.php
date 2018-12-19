<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Item_comment;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::latest()->paginate(5);

        return view('items.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
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
    public function store(Request $request)
    {
        $item = new Item;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->save();
        return redirect('items/'.$item->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show', ['item' => $item]);
    }

    public function showfromkey($key)
    {
        $item_search_result = Item::where('key',$key);
        $item = $item_search_result->first();
        $item_id = $item_search_result->value('id');
        $item_comments = Item_comment::where('item_id',$item_id)->latest()->paginate(5);;
        return view('items.show', compact('item','item_comments'));
        // return view('items.show', ['item' => $item]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('items.edit', ['item' => $item]);
    }

    public function editfromkey($key)
    {
        $item = Item::where('key',$key)->first();
        return view('items.edit', ['item' => $item]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item->name = $request->name;
        $item->description = $request->description;
        $item->save();
        return redirect('items/' . $item->id);
    }

    public function updatefromkey(Request $request, $key)
    {
        $item = Item::where('key',$key)->first();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->save();
        return redirect('items/' . $item->key);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect('items');
    }

    
    public function destroyfromkey($key)
    {
        $item = Item::where('key',$key)->first();
        $item->delete();
        return redirect('items');
    }
}
