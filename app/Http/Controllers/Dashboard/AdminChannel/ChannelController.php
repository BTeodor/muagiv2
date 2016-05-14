<?php

namespace App\Http\Controllers\Dashboard\AdminChannel;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use App;
use Illuminate\Support\Facades\Input;

class ChannelController extends Controller
{
    //
    /**
     * index all channels
     */
    public function index(){
        $perPage = 30;
        $query_channel = App\Channels::query();
        $search = Input::get('search');
        if (Input::get('search')) {
            $query_channel->where('name', "like", "%{$search}%")->orWhere('description', "like", "%{$search}%")->orWhere('homepage', "like", "%{$search}%");
        }
        $channels = $query_channel->orderBy('name', 'asc')->paginate($perPage);
        if (Input::get('search')) {
            $channels->appends(['search' => Input::get('search')]);
        }
    	if ($channels == NULL) {
    		return "No channel found";
    	}
    	return view('dashboard.adminchannel.channel', compact('channels'));
    }

    public function edit($id){
        $channel = App\Channels::find($id);
        if ($channel == NULL) {
            return "Channel not found";
        }
        return view('dashboard.adminchannel.edit', compact('channel'));
    }

    public function update(Request $request){
        $channel_id = $request->id;
        $channel = App\Channels::find($channel_id);
        if ($channel == NULL) {
            return "Channel not found";
        }
        $channel->update(['maximum_no_hot_product' => $request->maximum_no_hot_product]);
        return redirect()->back()->withSuccess('Successfully updated');
    }

    public function delete($id){
        $channel = App\Channels::find($id);
        if ($channel == NULL) {
            return "Channel not found";
        }
        $channel->delete();
        return redirect()->back()->withSuccess('Successfully deleted');
    }
}
