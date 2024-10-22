<?php
require_once 'Person.php';
require_once 'PersonRepositoryInterface.php';

class PersonRepository implements PersonRepositoryInterface
{
    private array $people = [];

    public function savePerson(Person $person): void
    {
        $this->people[$person->name] = $person;
    }

    public function readPeople(): array
    {
        return $this->people;
    }

    public function readPerson(string $name): ?Person
    {
        return $this->people[$name] ?? null;
    }
}


class LowerCaseDecorator implements PersonRepositoryInterface
{

    public function __construct(public PersonRepositoryInterface $repository)
    {
    }

    public function savePerson(Person $person): void
    {
        $this->repository->savePerson($person);
    }

    public function readPeople(): array
    {
        $people = $this->repository->readPeople();
        foreach ($people as $person) {
            /** @var Person $person */
            $person->name = strtolower($person->name);
        }

        return $people;
    }


    public function readPerson(string $name): ?Person
    {
        $person = $this->repository->readPerson($name);

        if ($person) {
            $person->name = strtolower($person->name);
        }
        return $person;
    }
}

class UppercaseDecorator implements PersonRepositoryInterface
{
    public function __construct(public PersonRepositoryInterface $repository)
    {
    }

    public function savePerson(Person $person): void
    {
        $this->repository->savePerson($person);
    }

    public function readPeople(): array
    {
        $people = $this->repository->readPeople();
        foreach ($people as $person) {
            /** @var Person $person */
            $person->name = strtoupper($person->name);
        }

        return $people;
    }


    public function readPerson(string $name): ?Person
    {
        $person = $this->repository->readPerson($name);

        if ($person) {
            $person->name = strtoupper($person->name);
        }
        return $person;
    }
}

$person = new Person('John Doe');

$personRepository = new PersonRepository();
$personRepository->savePerson($person);


$lowerCaseDecorator = new LowerCaseDecorator($personRepository);
print_r($lowerCaseDecorator->readPeople());

$upperCaseDecorator = new UppercaseDecorator($personRepository);
print_r($upperCaseDecorator->readPeople());