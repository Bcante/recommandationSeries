<?php

namespace recommandationSeries\model;

use Illuminate\Database\Eloquent\Model;

class Genres extends Model {

	protected $table='genres';
	protected $primaryKey='id';
	public $timestamps=false;

	/*public function relationSeries() {
    	//return $this->belongsToMany('\recommandationSeries\model\Series', 'seriesgenres', 'series_id', 'genre_id');
        return $this->hasManyThrough('\recommandationSeries\model\Series', 'seriesgenres', 'serie_id', 'genre_id');
        // return $this->hasMany('\recommandationSeries\model\SeriesGenres', 'genre_id', 'id');
    }*/

    //relation Genres <> Series
	public function series() {
		return $this->belongsToMany('\recommandationSeries\model\Series', 'usersgenres', 'genre_id', 'serie_id');
	}
}

?>
