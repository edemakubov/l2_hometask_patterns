<?php

class DBPersonRepository implements PersonRepositoryInterface
{
    private PDO $pdo;

    public function __construct(array $config)
    {
        $this->pdo = new PDO($config['dsn'], $config['user'], $config['password']);
    }

    public function savePerson(Person $person): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO people (name, email) VALUES (:name, :email)');
        $stmt->execute(['name' => $person->name, 'email' => $person->email]);
    }

    public function readPeople(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM people');
        $people = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $people[] = Person::fromArray($row);
        }
        return $people;
    }

    public function readPerson(string $name): ?Person
    {
        $stmt = $this->pdo->prepare('SELECT * FROM people WHERE name = :name');
        $stmt->execute(['name' => $name]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? Person::fromArray($data) : null;
    }
}