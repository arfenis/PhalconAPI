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
    public function register() : array
    {
        
        $user = new Users();


        $user->password = password_hash($this->request->getpost('password'),PASSWORD_BCRYPT);
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
    public function list() :array
    {
        echo $this->auth->data('sub'); die();
       
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

    public function login() :array
    {

        $email = $this->request->getpost("email");

        $user = Users::findFirst(
            [
                'conditions' => 'email = :email:',
                'bind' => [
                    'email' => $email
                ]
            ]
                );
       $response = $this->validatePassword($this->request->getpost('password'),$user->password);

       if($response == true) {

            $payload = [
                'sub'   => $user->id,
                'email' => $user->email,
                'iat' => time(),
            ];

           $token = $this->getJwt($payload);
       }

       return $token;
    }

    public function validatePassword($loginPassword, $dataPassword)
    {
        if($dataPassword){
            if (password_verify($loginPassword, $dataPassword)) {
                return true;
            } else {
                return false;
            }        
        } else {
            $this->security->hash(rand());
            return 'no valida';
        }
    }

    public function getJwt($payload) 
    {
        return ['token' => $this->auth->make($payload),
                'auth_type' => 'Bearer'];
    }
}