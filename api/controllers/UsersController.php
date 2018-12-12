<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;

/**
 * Operations with Users: CRUD
 */
class UsersController extends Controller
{
    /**
     * Adding user
     */
    public function addAction()
    {
    }

    /**
     * Returns user list
     *
     * @return array
     */
    public function getUserListAction()
    {
       return ['2'];
       
    }

     /**
     * Updating existing user
     *
     * @param string $userId
     */
    public function updateUserAction($userId)
    {
       
    }

    /**
     * Delete an existing user
     *
     * @param string $userId
     */
    public function deleteUserAction($userId)
    {
       
    }

    public function indexMethod(){
        echo '1'; die();
    }
}