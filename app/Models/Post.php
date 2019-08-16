<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	protected $guarded = ['id', '_token'];
	//protected $with = ['author'];

	public function author() {
		return $this->hasOne(User::class, 'id', 'author_id');
	}

}
