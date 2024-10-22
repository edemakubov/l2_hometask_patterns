<?php

require_once 'Person.php';
require_once 'PersonRepositoryInterface.php';
require_once 'DBPersonRepository.php';
require_once 'FSPersonRepository.php';
require_once 'AbstractPersonFactory.php';
require_once 'DBPersonFactory.php';
require_once 'FSPersonFactory.php';
require_once 'PersonFactory.php';

$dbConfig = [
    'dsn' => 'mysql:host=localhost;dbname=abstract_factory',
    'user' => 'root',
    'password' => ''
];

$fsConfig = [
    'file_path' => "./people.json"
];

$dbFactory = new DBPersonFactory();
$fsFactory = new FSPersonFactory();

// Create repository factory
$personFactory = PersonFactory::getFactory($fsFactory, $fsConfig);

// Use repository
$person = new Person('Mrs Bean', 'bean@hotmail.com');
$personFactory->savePerson($person);

$allPeople = $personFactory->readPeople();

print_r($allPeople);
