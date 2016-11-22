<?php

namespace recommandationSeries\model;

use Illuminate\Database\Eloquent\Model;

class Genres extends Model {

	protected $table='genres';
	protected $primaryKey='id';
	public $timestamps=false;

	public function series() {
    	return $this->belongsToMany('\recommandationSeries\model\Series', 'seriesgenres', 'series_id', 'genre_id');
    }

}

?>
