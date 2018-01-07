<?php

namespace conf;

use Illuminate\Database\Capsule\Manager as DB;

class DbConf
{
    public static function init() {
        $conf = parse_ini_file('db.ini');

        if(!$conf) {
            throw new \Exception('Impossible to parse ' . $conf);
        }
        else {
            $db = new DB();
            $db->addConnection($conf);
            $db->setAsGlobal();
            $db->bootEloquent();
        }
    }
}