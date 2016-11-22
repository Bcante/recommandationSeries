<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;


class Series extends Model {

		protected $table='series';
		protected $primaryKey='id';
		public $timestamps=false;

	   public function relationProduit() {
		    return $this->belongsToMany('Genres', "seriesgenres", 'series_id', 'genre_id');
		}

}
?>
