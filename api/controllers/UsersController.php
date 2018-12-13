<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Users;

/**
 * Operations with Users: CRUD
 */
class UsersController extends AbstractController
{
    /**
     * Adding user
     * @return array 
     */
    public function register()
    {
        
        $user = new Users();

        $options = [
            'cost' => 12,
        ];

        $user->password = $this->security->hash($this->request->getPost('password'));
        $user->name = $this->request->getPost('name');
        $user->email = $this->request->getPost('email');
        $user->created = $this->request->getPost('created');

        // Store and check for errors
        $success = $user->save();

        if ($success) {
            $message = "Thanks for registering!";
        } else {
            $message = "Sorry, the following problems were generated:" . implode($user->getMessages());
        }

        return [$message];
    }

    /**
     * Returns user list
     *
     * @return array
     */
    public function list()
    {
       return ['2'];
       
    }

     /**
     * Updating existing user
     *
     * @param string $userId
     */
    public function update(int $userId)
    {
       
    }

    /**
     * Delete an existing user
     *
     * @param string $userId
     */
    public function delete(int $userId)
    {
       
    }

    public function indexMethod(){
        echo '1'; die();
    }
}