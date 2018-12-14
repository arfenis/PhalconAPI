<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Users;
use App\Models\News;
use Phalcon\Mvc\Model\Query;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;


class NewsController extends AbstractController
{
    private $user;

    public function onConstruct()
    {
        $this->user = $this->auth->data();
    }

    /**
     * Show all the news of the token owner user and returned an Array
     * @return array
     */
    public function showAll() :array
    {
        //echo $this->request->get('sort'); die();
       $news = News::find(
           [
            'conditions' => 'owner = :ownerId: AND deleted = 0',
            'bind' => [
                'ownerId' => $this->user['sub']
            ],
            'columns' => 'id, title, views, created'
           ]
        );

        $currentPage = $this->request->get('page');
        $perPage = $this->request->get('perPage');
        if(empty($perPage) || $perPage = 0){
            $perPage = 10;
        }
        $paginator = new PaginatorModel(
            [
                'data'  => $news,
                'limit' => $perPage,
                'page'  => $currentPage,
            ]
        );

        $data = $paginator->getPaginate();

        return [
            'news' => $data
        ];
    }

    /**
     * Store a new News
     * @return array
     */

    public function store () :array
    {
        try {
            $new = new News();
            $new->title = $this->request->getpost('title');
            $new->body = $this->request->getpost('body');
            $new->owner = $this->user['sub'];
            $new->views = 0;

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

    /**
     * Show a news by ID
     * @return array
     * @param string $id
     */
    public function show (string $id) :array
    {
        try {
            $new = News::findFirst(           
                [
                    'conditions' => 'id = :id: AND owner = :ownerId: AND deleted = 0',
                    'bind' => [
                        'id' => $id,
                        'ownerId' => $this->user['sub']
                    ]
               ]
            );
            
            if($new) 
            {
                $data = $new;
                $views = $new->views + 1;
                $new->views = $views;
                $new->update();

            } else {
                $data = 'Not found';
            }

        } catch (Exception $e) {

            return [
                'message' => $e->getMessage()
            ];

        }

        return [
            $data
        ];

    }

    /**
     * Update a news by ID
     * @return array
     * @param string $id
     */
    public function update(string $id) :array
    {
        try {
            $new = News::findFirst(
                [
                    'conditions' => 'id = :id: AND owner = :ownerId:',
                    'bind' => [
                        'id' => $id,
                        'ownerId' => $this->user['sub']
                    ]
                ]
            );

            if(!empty($this->request->getPut('title')))
            {
               $new->title = $this->request->getPut('title');
            }

            if(!empty($this->request->getPut('body')))
            {
                $new->body = $this->request->getPut('body');
            }

            $new->updated = date("Y/m/d");

            $success = $new->update();

            if ($success) {
                $message = "New updated";
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

    /**
     * Delete a news by ID
     * @return array
     * @param string $id
     */
    public function delete(string $id) :array
    {
        try {

            $new = News::findFirst(
                [
                    'conditions' => 'id = :id: AND owner = :ownerId: AND deleted = 0',
                    'bind' => [
                        'id' => $id,
                        'ownerId' => $this->user['sub']
                    ]
                ]
            );

            $success = $new->delete();

            if ($success) {
                $message = "New deleted";
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
}