<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomTypeCreateRequest;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function getRoomType(){
        $allRoomType = RoomType::orderBy('id','desc')->get();

        return view('backend.allroom.roomtype.view_roomtype',compact('allRoomType'));
    }

    public function createRoomType(){
        return view('backend.allroom.roomtype.add_roomtype');
    }// End Method

    public function storeRoomType(RoomTypeCreateRequest $request){
        RoomType::insert([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'RoomType created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('room.type.list')->with($notification);
    }
}
