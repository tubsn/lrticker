<?php

namespace App\Http\Controllers;

use App\Models\Ticker;
use App\Models\Post;
use Illuminate\Http\Request;

class TickerController extends Controller
{
    public function index(Ticker $ticker) {
    	return view('ticker/index')->with(
			['tickers' => $ticker->orderBy('id','desc')->get()]
		);
    }

	public function get_live_posts(Ticker $ticker) {
		return $ticker->refreshPosts();
	}

    public function create() {
        return view('ticker/create-ticker');
    }

    public function store(Request $request) {
		$request->validate([
			'name' => ['required','min:3'],
		]);
		$newTicker = Ticker::create($request->all());
		return redirect('/ticker/' . $newTicker->id);
    }

    public function show(Ticker $ticker) {
        return view('ticker/show')->with(['ticker' => $ticker]);
    }

    public function edit(Ticker $ticker) {
        return view('ticker/edit-ticker')->with(['ticker' => $ticker]);
    }

	public function add_post(Request $request, Ticker $ticker) {
		$request->validate([
			'content' => 'required',
		]);
		$ticker->add_post($request);
		return ['ticker' => $ticker->id, 'added' => 1];
		//return redirect('/ticker/' . $ticker->id);
	}

	public function edit_post(Ticker $ticker, $postID, Request $request) {
		$ticker->edit_post($postID, $request);
		return ['post' => $postID, 'edited' => 1];
	}

	public function delete_post(Ticker $ticker, $postID) {
		return $ticker->delete_post($postID);
		//return ['ticker' => $ticker->id, 'deleted' => 1];
	}


    public function update(Request $request, Ticker $ticker) {
		$request->validate([
			'name' => 'required',
		]);
		$ticker->update($request->all());
		return redirect('/ticker/' . $ticker->id);
    }

    public function destroy(Ticker $ticker) {
        $ticker->delete();
		return redirect('/ticker/');
    }
}
