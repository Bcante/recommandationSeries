<?php

namespace recommandationSeries\model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model{

    protected $table='users';
    protected $primaryKey='id';
    public $timestamps=false;

	// Relation avec les Users Episodes
	public function episodes(){
		return $this->belongsToMany('\model\Episodes','usersepisodes','user_id','episode_id');
	}

	//relation Users <> Episodes
	public function series() {
		return $this->belongsToMany('\recommandationSeries\model\Series', 'userseries', 'user_id', 'serie_id');
	}
}
?>
