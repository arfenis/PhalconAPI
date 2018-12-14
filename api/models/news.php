<?php

namespace App\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\SoftDelete;

class News extends Model
{
    const DELETED     = 1;
    const NOT_DELETED = 0;

    public function beforeValidationOnCreate()
    {
        $this->created =  date("Y/m/d");
        $this->deleted = News::NOT_DELETED;
    }

     public function initialize()
    {
        $this->belongsTo(
            'owner',
            'Users',
            'id'
        );

        $this->addBehavior(
            new SoftDelete(
                [
                    'field' => 'deleted',
                    'value' => News::DELETED,
                ]
            )
        );
    }


}