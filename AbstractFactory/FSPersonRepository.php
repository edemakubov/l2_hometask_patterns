<?php

class FSPersonRepository implements PersonRepositoryInterface
{
    private string $filePath;

    public function __construct(array $config)
    {
        $this->filePath = $config['file_path'];
    }

    public function savePerson(Person $person): void
    {
        $people = $this->readPeople();
        $people[] = $person->toArray();
        file_put_contents($this->filePath, json_encode($people));
    }

    public function readPeople(): array
    {
        if (!file_exists($this->filePath)) {
            return [];
        }
        $data = json_decode(file_get_contents($this->filePath), true);
        return array_map(fn($item) => Person::fromArray($item), $data);
    }

    public function readPerson(string $name): ?Person
    {
        $people = $this->readPeople();
        foreach ($people as $person) {
            if ($person->name === $name) {
                return $person;
            }
        }
        return null;
    }
}