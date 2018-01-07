<?php

namespace recommandationSeries\model;


use Illuminate\Database\Eloquent\Model;


class Creators extends Model {

    protected $table='creators';
    protected $primaryKey='id';
    public $timestamps=false;

    public function series(){
		return $this->belongsToMany('\recommandationSeries\model\Series','seriescreators','creator_id','series_id');
	}
    
}