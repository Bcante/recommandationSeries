<?php
namespace app\model;
require('vendor/autoload.php');


class Users extends \illuminate\database\Illuminate\Database\Eloquent\Model{
		protected $table='users';
		protected $primaryKey='id';
		public $timestamps=false;

	// Relation avec les Users Episodes
	public function usersEpisodes(){
		return $this->hasMany('\model\UsersEpisodes','user_id');
	}
	
}
?>
