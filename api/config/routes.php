<?php
use Phalcon\Mvc\Micro\Collection;

$usersCollection = new Collection();
$usersCollection->setHandler('\App\Controllers\UsersController', true);
$usersCollection->setPrefix('/v1');
$usersCollection->post('/register', 'register');
$usersCollection->post('/login', 'login');

$newsCollection = new Collection();
$newsCollection->setHandler('\App\Controllers\NewsController', true);
$newsCollection->setPrefix('/v1');
$newsCollection->post('/news', 'store'); // Create a new
$newsCollection->get('/news', 'showAll'); // Show all news of the login user
$newsCollection->get('/news/{id:[0-9]+}', 'show'); // Show a single new by ID
$newsCollection->put('/news/{id:[0-9]+}', 'update'); // Update a new by ID
$newsCollection->delete('/news/{id:[0-9]+}', 'delete'); // Delete a new by ID


$app->mount($usersCollection);
