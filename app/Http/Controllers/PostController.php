<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Events\TickerUpdated;
use Illuminate\Http\Request;

class PostController extends Controller
{

	function __construct() {
		$this->middleware('auth');
	}

    public function index() {
		return 'nothing to see here';
    }

    public function create(){
		return 'nothing to see here';
    }

    public function store(Request $request){

		$request->validate([
			//'content' => ['required'],
			'ticker_id' => ['required'],
		]);

		$newPost = new Post();
		$newPost->content = $request->content;
		$newPost->media = $request->media;
		$newPost->ticker_id = $request->ticker_id;
		$newPost->author_id = auth()->user()->id;

		if ($request->time) {
			$newPost->time = $request->time;
		} else {
			$newPost->time = date('G:i');
		}

		$newPost->date = date('d.m.Y');

		$newPost->save();

		if (empty($newPost->id)) {
			abort(500, 'Post could not be saved');
		}

		$newPost->ticker->attach_post($newPost->id);

		return [
			'message' => 'New Post added ID:' . $newPost->id,
			'success' => true
		];
    }

    public function show(Post $post){

		return $post;

    }

    public function edit(Post $post) {
		return 'nothing to see here';
    }

    public function update(Request $request, Post $post) {
		if ($request->content) {$post->content = $request->content;}
		if ($request->time) {$post->time = $request->time;}
		if ($request->date) {$post->date = $request->date;}
		$post->save();
		event(new TickerUpdated($post->ticker));
    }

    public function destroy(Post $post){

		if ($post->delete()) {
			return [
				'message' => 'Post ' . $post->id . ' deleted',
				'success' => true
			];
		}

		else {
			return [
				'message' => 'Post ' . $post->id . ' could not be deleted',
				'success' => false
			];
		}

    }
}
