<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Item;
use App\Item_comment;

class Item_commentController extends Controller
{

    //コメント一覧のhtmlを返却
    public function main($key)
    {
        $page = Input::get('page');
        $item_search_result = Item::where('key',$key);
        $item_id = $item_search_result->value('id');
        $item_comments = Item_comment::where('item_id',$item_id)->latest()->paginate(5);
        return view('item_comments.main',compact('page','item_comments'));
    }

    //jsonを返す※使用しないことに
    public function json($key)
    {
        $item_search_result = Item::where('key',$key);
        $item_id = $item_search_result->value('id');
        $item_comments = Item_comment::where('item_id',$item_id)->latest()->paginate(5);
        return \Response::json($item_comments);
    }

    //ajaxでページネート※使用しないことに
    public function ajax()
    {
        $page = Input::get('page');
        if(empty($page)) $page = 1;
        return view('item_comments.ajax')->with('page',$page);
    }

}
