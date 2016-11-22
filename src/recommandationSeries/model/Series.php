<?php

namespace recommandationSeries\model;

use Illuminate\Database\Eloquent\Model;

class Series extends Model {

		protected $table='series';
		protected $primaryKey='id';
		public $timestamps=false;
	    public function relationGenres() {
		    return $this->belongsToMany('Genres', 'seriesgenres', 'series_id', 'genre_id');
		}

}
?>
