<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Ticker extends Model
{
    protected $table = 'tickers';
    protected $guarded = ['id', '_token', 'author'];
    protected $casts = ['start' => 'datetime'];
	protected $dates = ['start'];

	public function refreshPosts() {
		// with Author Username
		return $this->posts()->load('author:id,username');

	}


	public function posts() {

		if (empty($this->posts)) {
			return [];
		}

		$postIDs = explode(',',$this->posts);
		return Post::whereIn('id', $postIDs)->orderByRaw('FIELD (id, '.$this->posts.')')->get();

		// Find won´t work because it is not considering the ID order :(
		// return Post::find(explode(',',$this->posts));
	}

	public function add_post($request) {

		$newPost = new Post();
		$newPost->content = $request->content;
		$newPost->time = date('G:i');
		$newPost->date = now();
		$newPost->save();

		if (empty($this->posts)) {
			$this->posts = $newPost->id;
		}
		else {
			$this->posts = $newPost->id . ',' . $this->posts;
		}

		$this->save();

	}

	public function edit_post($postID, $request) {
		$post = Post::find($postID);
		$post->content = $request->content;
		$post->save();
	}


	public function delete_post($postID) {

		if (Post::find($postID)->delete()) {
			return [
				'message' => 'Post ' . $postID . ' deleted',
				'deleted' => true
			];
		}

		else {
			return [
				'message' => 'Post ' . $postID . ' could not be deleted',
				'deleted' => false
			];
		}

	}

	public function author() {
		return $this->hasOne(User::class, 'id', 'author_id');
	}

}
