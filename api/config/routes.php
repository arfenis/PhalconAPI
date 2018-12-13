<?php

$usersCollection = new \Phalcon\Mvc\Micro\Collection();
$usersCollection->setHandler('\App\Controllers\UsersController', true);
$usersCollection->setPrefix('/v1');
$usersCollection->post('/register', 'register');
$usersCollection->post('/login', 'login');
$usersCollection->get('/list', 'list');
$usersCollection->put('/{userId:[1-9][0-9]*}', 'update');
$usersCollection->delete('/{userId:[1-9][0-9]*}', 'delete');
$app->mount($usersCollection);
