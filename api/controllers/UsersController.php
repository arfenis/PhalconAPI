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

        // Store and check for errors
        $success = $user->save();

        if ($success) {
            $message = "Thanks for registering!";
        } else {
            $message = "Sorry, the following problems were generated:" . implode($user->getMessages());
        }

        return [
            $message
        ];
    }

     /**
     * Updating existing user
     *
     * @param string $userId
     */
    public function update(string $userId)
    {
       
    }

    /**
     * Delete an existing user
     *
     * @param string $userId
     */
    public function delete(string $userId)
    {
       
    }

    /**
     * Login a user
     * @return array 
     */

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

        if($user) 
        {
            $response = $this->validatePassword($this->request->getpost('password'),$user->password);

            if($response == true) {
     
                 $payload = [
                     'sub'   => $user->id,
                     'email' => $user->email,
                     'iat' => time(),
                 ];
     
                $token = $this->getJwt($payload);
                return $token;
            }
            
            $message = 'Password incorrecta';
        } else {
            $message = 'Email incorrecto';
        }

        return [$message];

    }

    /**
     * Validation of the password with the DB password
     * @return bool
     * @param string $loginPassword
     * @param string $dataPassword
     */

    public function validatePassword(string $loginPassword, string $dataPassword) : bool
    {
        if($dataPassword){
            if (password_verify($loginPassword, $dataPassword)) {
                return true;
            }      
        } else {
            $this->security->hash(rand());
            return false;
        }
    }

    /**
     * Return the Token and the authorization type
     * @return array
     * @param array $payload
     */

    public function getJwt(array $payload) : array
    {
        return ['token' => $this->auth->make($payload),
                'auth_type' => 'Bearer'];
    }
}