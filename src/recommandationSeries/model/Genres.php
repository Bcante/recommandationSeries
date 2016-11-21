<?php
namespace app\model;
require('vendor/autoload.php');


class Genres extends \illuminate\database\Illuminate\Database\Eloquent\Model{
		protected $table='genres';
		protected $primaryKey='id';
		public $timestamps=false;

}
?>
