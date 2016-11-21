<?php
namespace app\model;
require('vendor/autoload.php');


class Series extends \illuminate\database\Illuminate\Database\Eloquent\Model{
		protected $table='series';
		protected $primaryKey='id';
		public $timestamps=false;

}
?>
