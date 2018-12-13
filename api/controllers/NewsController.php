<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Users;
use App\Models\News;

class NewsController extends AbstractController
{
    private $user;

    public function onConstruct()
    {
        $this->user = $this->auth->data();
    }

    //Show all the news of the token owner user and returned an Array

    public function showAll() :array
    {
       $news = News::find(
           [
            'conditions' => 'owner = :ownerId:',
            'bind' => [
                'ownerId' => $this->user['sub']
            ],
            'columns' => 'id, title, body, views, created'
           ]
        );

        return [
            'news' => $news
        ];
    }

    public function store () :array
    {
        try {
            $new = new News();
            $new->title = $this->request->getpost('title');
            $new->body = $this->request->getpost('body');
            $new->owner = $this->user['sub'];
            $new->views = 0;
            $new->created = date();

            $success = $new->save();

            if ($success) {
                $message = "New posted";
            } else {
                $message = "Sorry, the following problems were generated:" . implode($new->getMessages());
            }

        } catch (Exception $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            $message
        ];
    }

    public function show ($id) :array
    {
        try {
            $new = News::findFirst($id);

            if($new->owner == $this->user['sub'])
            {
                return [
                    'news' => $new
                ];
            } else {
                return [
                    'message' => 'New not found'
                ];
            }

            
        } catch (Exception $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

    }

}