<?php

namespace recommandationSeries\model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model{

    protected $table='users';
    protected $primaryKey='id';
    public $timestamps=false;

	// Relation avec les Users Episodes
	public function usersEpisodes(){
		return $this->hasMany('\model\UsersEpisodes','user_id');
	}
	
}
?>
