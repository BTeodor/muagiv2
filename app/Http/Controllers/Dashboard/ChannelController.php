<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Events\Channels\ChangedLogo;
use App;
use App\Http\Requests\UpdateChannelRequest;
use App\Http\Requests\CreateChannelRequest;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;

class ChannelController extends Controller
{
    //
	protected $channel;

	protected $user;

	public function __construct(){
		$this->middleware('auth');
		$this->middleware('session.database', ['only' => ['sessions', 'invalidateSession']]);       
		$this->user = \Auth::user();
		$channel = $this->user->channel()->get()->toArray();
		$this->channel = isset($channel[0]) ? App\Channels::find($channel[0] ['id']) : NULL;
	}

	public function index(){
		$edit = true;
		$this->user = \Auth::user();
		$channel = $this->user->channel()->get()->toArray();
		$this->channel = isset($channel[0]) ? App\Channels::find($channel[0] ['id']) : NULL;
		$user = $this->user;
		$channel = $this->channel;
		return view('dashboard.channel.channel', compact('edit', 'user', 'channel'));
	}

	public function updateDetails(UpdateChannelRequest $request){
		$data = [
			'name' => $request->name,
			'hotline' => $request->hotline,
			'homepage' => $request->homepage,
			'description' => $request->description,
		];
		$this->channel->update($data);

		return redirect()->route('channel.index')->withSuccess('Successfully Updated');
	}

	public function createDetails(CreateChannelRequest $request){
		if (($request->file('logo')) != NULL) {
			$desPath = "upload/channel/";
			$imageName = $this->user->id . '.' . $request->file('logo')->getClientOriginalExtension();
			$request->file('logo')->move($desPath, $imageName);
			$image_path = '/upload/channel/' . $imageName;
			$image_full_path = \URL::to('/') . $image_path;
		}
		else {
			$image_path = '/assets/img/profile.png';
			$image_full_path = \URL::to('/') . $image_path;
		}
		$data = [
			'name' => $request->name,
			'hotline' => $request->hotline,
			'homepage' => $request->homepage,
			'description' => $request->description,
			'user_id' => $this->user->id,
			'logo' => $image_full_path,
			'relative_logo_link' => $image_path
		];
		$channel = App\Channels::firstOrCreate($data);
		$this->channel = $channel;
		return redirect()->route('channel.index')->withSuccess('Successfully Created');
	}

	public function updateChannelAvatar(Request $request){
		if (($request->file('logo')) != NULL) {
			$desPath = "upload/channel/";
			$imageName = $this->user->id . '.' . $request->file('logo')->getClientOriginalExtension();
			$request->file('logo')->move($desPath, $imageName);
			$image_path = '/upload/channel/' . $imageName;
			$image_full_path = \URL::to('/') . $image_path;
		}
		else {
			$image_path = '/assets/img/profile.png';
			$image_full_path = \URL::to('/') . $image_path;
		}
		$this->channel->update(['logo' => $image_full_path, 'relative_logo_link' => $image_path]);

		return redirect()->route('channel.index')->withSuccess('Logo successfully changed');
	}

    public function createEvent(CreateEventRequest $request){
		$image_path = '/assets/img/profile.png';
		$image_full_path = \URL::to('/') . $image_path;
		$clock = new App\ExternalClasses\MyClock();
		$start_time = $clock->get_unix_time_UTC_from_GMT_7("07:00", $request->start_time_string);
		$end_time = $clock->get_unix_time_UTC_from_GMT_7("07:00", $request->end_time_string);
    	$data = [
    		'title' => $request->title,
    		'event_link' => $request->event_link,
    		'start_time' => $start_time,
    		'end_time' => $end_time,
    		'description' => $request->description,
    		'image_link' => $image_full_path,
    		'relative_image_link' => $image_path,
    		'channel_id' => $this->channel->id,
    		'start_time_string' => $request->start_time_string,
    		'end_time_string' => $request->end_time_string
    	];

    	$event = App\Event::firstOrCreate($data);

    	return redirect()->route('channel.event.index')->withSuccess('Successfully created event');
    }

    /**
     * @ Index event
     */
    public function indexEvent(){
    	$channel = $this->channel;

    	if ($channel == NULL) {
    		$events = NULL;
    	}
    	$user = $this->user;
    	
    	$edit = true;
    	$channel = $this->channel;
    	$events = App\Event::where('channel_id', $channel['id'])->get();
    	return view('dashboard.channel.event', compact('events', 'user', 'edit', 'channel'));
    }

    /**
     * @ Update Event
     */
    public function updateEvent(UpdateEventRequest $request){
		$clock = new App\ExternalClasses\MyClock();
		$start_time = $clock->get_unix_time_UTC_from_GMT_7("07:00", $request->start_time_string);
		$end_time = $clock->get_unix_time_UTC_from_GMT_7("07:00", $request->end_time_string);
    	$data = [
    		'title' => $request->title,
    		'event_link' => $request->event_link,
    		'start_time' => $start_time,
    		'end_time' => $end_time,
    		'description' => $request->description,
    		'channel_id' => $this->channel->id,
    		'start_time_string' => $request->start_time_string,
    		'end_time_string' => $request->end_time_string
    	];

    	App\Event::find($request->id)->update($data);
    	return redirect()->route('channel.event.index')->withSuccess('Successfully updated event');
    }

    public function updatePoster(Request $request){
		if (($request->file('poster')) != NULL) {
			$desPath = "upload/channel/event/";
			$imageName = $request->id . '.' . $request->file('poster')->getClientOriginalExtension();
			$request->file('poster')->move($desPath, $imageName);
			$image_path = '/upload/channel/event/' . $imageName;
			$image_full_path = \URL::to('/') . $image_path;
		}
		else {
			$image_path = '/assets/img/profile.png';
			$image_full_path = \URL::to('/') . $image_path;
		}

		App\Event::find($request->id)->update(['image_link' => $image_full_path, 'relative_image_link' => $image_path]);

		return redirect()->route('channel.event.index')->withSuccess('Successfully updated poster');
    }

    public function deleteEvent(Request $request){
    	$event_id = $request->event_id;
    	App\Event::destroy($event_id);
    	return redirect()->route('channel.event.index')->withSuccess('Successfully deleted');
    }

}
