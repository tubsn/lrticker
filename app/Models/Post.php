<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	protected $guarded = ['id', '_token'];

	public function author() {
		return $this->hasOne(User::class, 'id', 'author_id')->withDefault([
			'username' => 'Unbekannt',
			'description' => 'keine Angaben',
			'thumbnail' => '/styles/img/icons/no-thumb.svg',
		]);
	}

	public function ticker() {
		return $this->hasOne(Ticker::class, 'id', 'ticker_id')->withDefault();
	}

	public function save(array $options = []) {
		$saved = parent::save($options); // Save first to get ID
		$this->ticker->attach_post($this->id);
		return $saved;
	}

    public function delete() {
		$this->ticker->detach_post($this->id);
		return parent::delete();
    }

}
