<?php

interface PersonRepositoryInterface
{
    public function savePerson(Person $person): void;
    public function readPeople(): array;
    public function readPerson(string $name): ?Person;
}

class CachePersonRepository implements PersonRepositoryInterface
{
    protected array $cache = [];
    public function __construct(private readonly PersonRepositoryInterface $repository)
    {
    }

    public function readPerson(string $name): ?Person
    {
        if (!isset($this->cache[$name])) {
            $this->cache[$name] = $this->repository->readPerson($name);
        }

        return $this->cache[$name];
    }

    public function savePerson(Person $person): void
    {
        // TODO: Implement savePerson() method.
    }

    public function readPeople(): array
    {
        // TODO: Implement readPeople() method.
    }
}


