<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\TickerUpdated;

class Ticker extends Model
{
    protected $table = 'tickers';
    protected $guarded = ['id', '_token', 'author'];
    protected $casts = ['start' => 'datetime'];
	protected $dates = ['start'];
    protected $dispatchesEvents = [
        'saved' => TickerUpdated::class,
    ];
	protected $attributes = [
		'status' => 1 // Sets Ticker Active by Default
	];

	public function refresh_posts() {

		if (count($this->posts()) > 0) {
			return $this->posts()->load('author:id,username');
		}

	}

	public function update_cachefile() {
		\Storage::disk('ticker')->put($this->id . '.js', $this->as_json_with_posts());
	}

	public function posts() {

		// Attention posts() is a Method!
		//this is no eloquent relationship

		if (empty($this->post_ids)) {return [];}
		$postIDs = explode(',', $this->post_ids);

		return Post::whereIn('id', $postIDs)->orderByRaw('FIELD (id, '.$this->post_ids.')')->get();
	}

	public function attach_post($postID) {

		if (empty($this->post_ids)) {
			$this->post_ids = $postID;
		}
		else {
			$this->post_ids = $postID . ',' . $this->post_ids;
		}

		$this->save();

	}

	public function detach_post($postID) {

		// Find and remove given PostID
		$posts = explode(",", $this->post_ids);
		$key = array_search($postID,$posts);
		unset($posts[$key]);

		// Save to "," seperated list
		$this->post_ids = implode(",", $posts);
		$this->save();
	}

	public function author() {
		return $this->hasOne(User::class, 'id', 'author_id')->withDefault([
			'username' => 'Unbekannt',
			'description' => 'keine Angaben',
			//'thumbnail' => '/styles/img/icons/no-thumb.svg',
		]);
	}


	private function as_json_with_posts() {

		if ($this->posts()) {
			$posts = $this->posts()->load('author:id,username,thumbnail')->toArray();
		}
		else { $posts = '';}

		return json_encode([
			'ticker' => $this->load('author:id,username'),
			'posts' => $posts,
		]);
	}

}
