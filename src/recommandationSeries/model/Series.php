<?php

namespace recommandationSeries\model;

use Illuminate\Database\Eloquent\Model;

class Series extends Model{

	protected $table='series';
	protected $primaryKey='id';
	public $timestamps=false;

    /*public function relationGenres() {
	    //return $this->belongsToMany('\recommandationSeries\model\Genres', 'seriesgenres', 'series_id', 'genre_id');
		return $this->belongsTo('\recommandationSeries\model\Genres', 'seriesgenres', 'serie_id', 'genre_id');
	}*/

	//relation Users <> Episodes
	public function users() {	
		return $this->belongsToMany('\recommandationSeries\model\Users', 'userseries', 'serie_id', 'user_id');
	}

	//relation Series <> Genres
	public function genres() {	
		return $this->belongsToMany('\recommandationSeries\model\Genres', 'usergenres', 'serie_id', 'genre_id');
	}

}
?>
