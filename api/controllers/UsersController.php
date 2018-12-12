<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Users;

/**
 * Operations with Users: CRUD
 */
class UsersController extends Controller
{
    /**
     * Adding user
     */
    public function register()
    {
        $user = new Users();
        $request = $this->request->getPost();

        $options = [
            'cost' => 12,
        ];

        $password = $this->request->getPost('password');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $created = $this->request->getPost('created');

        $user->password = $this->security->hash($password);
        $user->name = $name;
        $user->email = $email;
        $user->created = $created;

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