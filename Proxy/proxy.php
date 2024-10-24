<?php

class Person{
    public function __construct(public string $name, public int $age)
    {
    }
}

interface PersonRepositoryInterface
{
    public function savePerson(Person $person): void;
    public function readPeople(): array;
    public function readPerson(string $name): ?Person;
}

class PersonRepository implements PersonRepositoryInterface {

    private $list = [];

    public function savePerson(Person $person): void
    {
        $this->list[$person->name] = $person;
    }

    public function readPeople(): array
    {
        return $this->list;
    }

    public function readPerson(string $name): ?Person
    {
       return $this->list[$name] ?? null;
    }
}

class CachedPersonRepository implements PersonRepositoryInterface
{
    protected array $cache = [];
    public function __construct(private readonly PersonRepositoryInterface $repository)
    {
    }

    public function readPerson(string $name): ?Person
    {
        if (!isset($this->cache[$name])) {
            echo 'adding person to cache' . PHP_EOL;
            return $this->cache[$name] = $this->repository->readPerson($name);
        }
        echo 'read from cache' . PHP_EOL;
        return $this->cache[$name];
    }

    public function savePerson(Person $person): void
    {
        $this->repository->savePerson($person);
    }

    public function readPeople(): array
    {
        return $this->repository->readPeople();
    }
}

$person = new Person('John', 30);
$person2 = new Person('Anna', 25);

$repository = new PersonRepository();
$repository->savePerson($person);

$repositoryCached = new CachedPersonRepository($repository);
$repositoryCached->savePerson($person2);


var_dump($repositoryCached->readPerson('John'));
var_dump($repositoryCached->readPerson('John'));

