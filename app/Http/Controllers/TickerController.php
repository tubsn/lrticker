<?php

namespace App\Http\Controllers;

use App\Models\Ticker;
use App\Models\Post;
use Illuminate\Http\Request;

class TickerController extends Controller
{

	function __construct() {

		$this->middleware('auth')->except(['preview']);

	}

    public function index(Ticker $ticker) {
    	return view('ticker/index')->with(
			['tickers' => $ticker->orderBy('id','desc')->get()]
		);
    }

	public function preview($tickerID) {

		$tickerJson = \Storage::disk('ticker')->get($tickerID . '.js');
		$ticker = json_decode($tickerJson, true);

    	return view('ticker/preview')->with([
			'ticker' => $ticker
		]);
	}

	public function get_live_posts(Ticker $ticker) {
		return $ticker->refresh_posts();
	}

    public function reorder_posts(Request $request, Ticker $ticker) {

		$ticker->update($request->all());
		return [
			'message' => 'Posts rearranged in Ticker: ' . $ticker->id,
			'success' => true
		];

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

    public function update(Request $request, Ticker $ticker) {

		// non Ajax Call
		if ($request->js == false) {
			$request->validate([
				'name' => 'required',
			]);
			$ticker->update($request->all());
			return redirect('/ticker/' . $ticker->id);
		}

		// Ajax Calls
		if ($request->headline) {$ticker->headline = $request->headline;}
		$ticker->save();

    }

    public function destroy(Ticker $ticker) {
		$id = $ticker->id;
		$ticker->delete();

		Post::where('ticker_id', $id)->delete();

		//return redirect('/ticker/');
		return [
			'message' => 'Ticker ' . $id  . 'deleted',
			'success' => true
		];


    }
}
