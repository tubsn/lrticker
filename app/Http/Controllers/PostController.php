<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Events\TickerUpdated;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index() {
		return 'nothing to see here';
    }

    public function create(){
		return 'nothing to see here';
    }

    public function store(Request $request){

		$request->validate([
			'content' => ['required'],
			'ticker_id' => ['required'],
		]);

		$newPost = new Post();
		$newPost->content = $request->content;
		$newPost->ticker_id = $request->ticker_id;
		$newPost->time = date('G:i');
		$newPost->date = now();
		$newPost->save();

		return [
			'message' => 'New Post added ID:' . $newPost->id,
			'added' => true
		];
    }

    public function show(Post $post){

		return $post;

    }

    public function edit(Post $post) {
		return 'nothing to see here';
    }

    public function update(Request $request, Post $post) {
		$post->content = $request->content;
		$post->save();
		event(new TickerUpdated($post->ticker)); 
    }

    public function destroy(Post $post){

		if ($post->delete()) {
			return [
				'message' => 'Post ' . $post->id . ' deleted',
				'deleted' => true
			];
		}

		else {
			return [
				'message' => 'Post ' . $post->id . ' could not be deleted',
				'deleted' => false
			];
		}

    }
}