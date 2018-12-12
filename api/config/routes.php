<?php

$usersCollection = new \Phalcon\Mvc\Micro\Collection();
$usersCollection->setHandler('\App\Controllers\UsersController', true);
$usersCollection->setPrefix('/v1');
$usersCollection->get('/', 'indexMethod');
$usersCollection->post('/register', 'register');
$usersCollection->post('/login', 'login');
$usersCollection->get('/list', 'getUserListAction');
$usersCollection->put('/{userId:[1-9][0-9]*}', 'updateUserAction');
$usersCollection->delete('/{userId:[1-9][0-9]*}', 'deleteUserAction');
$app->mount($usersCollection);