<?php

namespace recommandationSeries\model;

use Illuminate\Database\Eloquent\Model;

class Genres extends Model {

		protected $table='genres';
		protected $primaryKey='id';
		public $timestamps=false;

<<<<<<< HEAD
 public function relationSeries() {
        return $this->hasManyThrough('series', 'seriesgenres', 'series_id', 'genre_id');
=======
 	public function relationGenres() {
        return $this->hasManyThrough('Series', 'seriesgenres', 'series_id', 'genre_id');
>>>>>>> 102557863fde084bcd649c1e3f268532e2f700b2
    }

}

?>
