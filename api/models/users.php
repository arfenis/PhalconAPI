<?php

namespace App\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;

class Users extends Model
{
    public $id;

    public $name;

    public $created;

    public function initialize()
    {
            $this->hasMany(
                'id',
                'News',
                'owner'
            );
    }
}