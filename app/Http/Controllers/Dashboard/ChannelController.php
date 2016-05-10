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
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Input;
use DB;
class ChannelController extends Controller
{
    //
	protected $channel;

	protected $user;

	public function __construct(){
		$this->middleware('auth');
		$this->middleware('session.database', ['only' => ['sessions', 'invalidateSession']]);       
		$this->user = \Auth::user();
        if (!\Auth::check()) {
            return redirect()->route('user.getLogin')->withErrors('Login first');
        }
        $channel = $this->user->channel;
		$this->channel = count($channel) ? $channel : NULL;
	}

	public function index(){
		$edit = true;
		$this->user = \Auth::user();
        $channel = $this->user->channel;
        $this->channel = count($channel) ? $channel : NULL;
        $user = $this->user;
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
    	$events = App\Event::where('channel_id', $channel->id)->get();
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

    public function indexProduct(){
    	$channel = $this->channel;
    	if ($channel == NULL) {
    		$products == NULL;
    		return response()->json([
    			'status' => false
    		]);
    	}
        $perPage = 10;
        $query = App\Products::query()->withTrashed()->where('channel_id', $channel->id);
        if (Input::get('category')) {
            if(Input::get('category') != 1000)
            $query->whereIn('id', function($q){
                $q->select('product_id')->from('category_product')->where('category_id', Input::get('category'));  
            });
        }
        $search = Input::get('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', "like", "%{$search}%");
                $q->orWhere('description', 'like', "%{$search}%");
            });
        }
        $products = $query->paginate($perPage);
        if ($search) {
            $products->appends(['search' => $search]);
        }

        $user = $this->user;
    	$events = App\Event::where('channel_id', $channel->id)->get();
    	$categories = App\Category::all();
        $category_name = array();
        $id = array();
        $name_en = array();
        array_push($id, 1000);
        array_push($name_en, "All");

        foreach($categories as $category){
            array_push($id, $category->id);
            array_push($name_en, $category->name_en);
        }

        $category_name = array_combine($id, $name_en);
        $channel = $this->channel;

		return view('dashboard.channel.product', compact('products', 'events', 'categories', 'user', 'category_name', 'channel'));
    }

    public function createProduct(){
        $channel = $this->channel;
        if ($channel == NULL) {
            $products == NULL;
            return response()->json([
                'status' => false
            ]);
        }
        $channel = $this->channel;
        $user = $this->user;
        $products = App\Products::where('channel_id', $channel->id)->get();
        $events = App\Event::where('channel_id', $channel->id)->get();
        $categories = App\Category::all();
        return view('dashboard.channel.product.add', compact('products', 'events', 'categories', 'user', 'channel'));
    }

    public function storeProduct(CreateProductRequest $request){
    	$data = [
    		'title' => $request->title,
    		'old_price' => $request->old_price,
    		'new_price' => $request->new_price,
    		'description' => $request->description,
    		'channel_id' => $this->channel->id,
            'video_link' => $request->video_link
    	];

    	$product = App\Products::firstOrCreate($data);

    	/**
    	 * generate product link
    	 */
        $link = \URL::to('/').'/'.'product/'.$product->id;
    	if (empty($request->product_link)) {
    		$product->update(['product_link' => $link, 'auto_link' => $link]);
    	}
    	else $product->update(['product_link' => $request->product_link, 'auto_link' => $link]);

    	/**
    	 * image processing
    	 */
        $image_link = "";
        $relative_image_link = "";
		if (($request->file('image_file')) != NULL) {
			$desPath = "upload/channel/product/";
			$imageName = $product->id . '.' . $request->file('image_file')->getClientOriginalExtension();
			$request->file('image_file')->move($desPath, $imageName);
			$relative_image_link = '/upload/channel/product/' . $imageName;
			$image_link = \URL::to('/') . $relative_image_link;
		}
		if (!empty($request->image_link)) {
			$image_link = $request->image_link;
			$relative_image_link = "";
		}
		$product->update(['image_link' => $image_link, 'relative_image_link' => $relative_image_link]);

    	/**
    	 * Categorize
    	 */
    	$list_category_id = array();
    	$categories = $request->category;
    	if ($categories != "") {
    		foreach ($categories as $key => $value) {
    			if ($value != "") {
    				array_push($list_category_id, intval($value));
    			}
    		}
    		$product->categories()->sync($list_category_id);
    	}

    	/**
    	 * Add to event
    	 */
        if(empty($request->event)) $product->events()->detach();
        else {
        	$list_event_id = array();
        	$events = $request->event;
        	if ($events != "") {
        		foreach ($events as $key => $value) {
        			if ($value != "") {
        				array_push($list_event_id, intval($value));
        			}
        		}
        		$product->events()->sync($list_event_id);
        	}
        }
    	return redirect()->route('channel.product.index')->withSuccess('Product successfully added');
    	// print_r($categories);
    	// var_dump($list_category_id);
    	// print_r($events);
    	// var_dump($list_event_id);
    }

    public function editProduct($id){
        $product = App\Products::withTrashed()->where('id', $id)->first();
        $categories = App\Category::all();
        $chosen_categories = $product->categories;
        
        $channel = $product->channel;
        $events = $this->channel->event;
        $chosen_events = $product->events;
        // return response()->json($categories);
        // return response()->json(['1' => count($categories), '2' => count($chosen_categories)]);
        return view('dashboard.channel.product.edit', compact('product', 'events', 'channel', 'chosen_events', 'categories', 'chosen_categories'));
    }

    public function updateProduct(UpdateProductRequest $request){
        $id = $request->product_id;
        $product = App\Products::withTrashed()->where('id', $id)->first();

        $data = [
            'title' => $request->title,
            'old_price' => $request->old_price,
            'new_price' => $request->new_price,
            'description' => $request->description,
            'channel_id' => $this->channel->id,
            'video_link' => $request->video_link
        ];
        $product->update($data);
        /**
         * generate product link
         */
        $link = \URL::to('/').'/'.'product/'.$product->id;
        if (empty($request->product_link)) {
            $product->update(['product_link' => $link, 'auto_link' => $link]);
        }
        else $product->update(['product_link' => $request->product_link, 'auto_link' => $link]);

        /**
         * image processing
         */
        $image_link = "";
        $relative_image_link = "";
        if (($request->file('image_file')) != NULL) {
            $desPath = "upload/channel/product/";
            $imageName = $product->id . '.' . $request->file('image_file')->getClientOriginalExtension();
            $request->file('image_file')->move($desPath, $imageName);
            $relative_image_link = '/upload/channel/product/' . $imageName;
            $image_link = \URL::to('/') . $relative_image_link;
        }
        if (!empty($request->image_link)) {
            $image_link = $request->image_link;
            $relative_image_link = "";
        }
        $product->update(['image_link' => $image_link, 'relative_image_link' => $relative_image_link]);

        /**
         * Categorize
         */
        $list_category_id = array();
        $categories = $request->category;
        if ($categories != "") {
            foreach ($categories as $key => $value) {
                if ($value != "") {
                    array_push($list_category_id, intval($value));
                }
            }
            $product->categories()->sync($list_category_id);
    }

        /**
         * Add to event
         */
        if(empty($request->event)) $product->events()->detach();
        else {
            $list_event_id = array();
            $events = $request->event;
            if ($events != "") {
                foreach ($events as $key => $value) {
                    if ($value != "") {
                        array_push($list_event_id, intval($value));
                    }
                }
                $product->events()->sync($list_event_id);
            }
        }
        return redirect()->route('channel.product.edit', $product->id)->withSuccess('Product successfully updated');
    }

    public function deleteProduct($id){
        $product = App\Products::find($id);
        if ($product->channel->id != $this->channel->id) {
            return redirect()->route('channel.product.index')->withErrors('You do not have permission to do this');
        }
        if(count($product)) $product->delete();

        return redirect()->route('channel.product.index')->withSuccess('Successfully deleted');
    }

    public function restoreProduct($id){
        $product = App\Products::onlyTrashed()->where('id', $id)->first();
        if(count($product)) $product->restore();

        return redirect()->route('channel.product.index')->withSuccess('Successfully restored');
    }

    /**
     * For schedule controller
     */
    public function indexSchedule(){
        $channel = $this->channel;
        if ($channel == NULL) {
            $products == NULL;
            return response()->json([
                'status' => false
            ]);
        }
        $perPage = 10;
        $query = App\Products::query()->where('channel_id', $channel->id);
        if (Input::get('category')) {
            if(Input::get('category') != 1000)
            $query->whereIn('id', function($q){
                $q->select('product_id')->from('category_product')->where('category_id', Input::get('category'));  
            });
        }
        $search = Input::get('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', "like", "%{$search}%");
                $q->orWhere('description', 'like', "%{$search}%");
            });
        }
        $products = $query->paginate($perPage);
        if ($search) {
            $products->appends(['search' => $search]);
        }

        $user = $this->user;
        $events = App\Event::where('channel_id', $channel->id)->get();
        $categories = App\Category::all();
        $category_name = array();
        $id = array();
        $name_en = array();
        array_push($id, 1000);
        array_push($name_en, "All");

        foreach($categories as $category){
            array_push($id, $category->id);
            array_push($name_en, $category->name_en);
        }

        $category_name = array_combine($id, $name_en);
        $channel = $this->channel;

        return view('dashboard.channel.schedule', compact('products', 'events', 'categories', 'user', 'category_name', 'channel'));
    }
}
