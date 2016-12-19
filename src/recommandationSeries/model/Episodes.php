<?php

namespace recommandationSeries\model;

use Illuminate\Database\Eloquent\Model;

class Episodes extends Model {

    protected $table='episodes';
    protected $primaryKey='id';
    public $timestamps=false;

}