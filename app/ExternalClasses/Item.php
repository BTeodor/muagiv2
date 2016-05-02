<?php
namespace App\ExternalClasses;

class Item {
	var $start_date;
	var $start_time;
	var $end_time;
	var $new_price;
	var $old_price;
	var $channel_id;
	var $description;
	var $available_time;
	var $product_link;
	var $image_link;
	var $video_link;
	var $title;
	var $item_type;
	function __construct($product, $item_type){
		$this->start_time = $product->start_time;
		$this->end_time = $product->end_time;
		$this->start_date = $product->start_date;
		$this->new_price = $product->new_price;
		$this->old_price = $product->old_price;
		$this->channel_id = $product->channel_id;
		$this->description = $product->description;
		$this->available_time = $product->available_time;
		$this->product_link = $product->product_link;
		$this->image_link = $product->image_link;
		$this->video_link = $product->video_link;
		$this->item_type = $item_type;
		$this->title = $product->title;
	}
}