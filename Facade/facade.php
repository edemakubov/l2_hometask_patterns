<?php

class Person
{
    public function __construct(
        public string $name,
        public int    $iq,
    )
    {
    }
}
class PersonRepository
{

    protected array $persons = [];
    public function __construct()
    {
        $this->persons = [
            'John' => new Person('John', 100),
            'Jane' => new Person('Jane', 110),
            'Jack' => new Person('Jack', 120),
        ];
    }

    public function readPerson(string $name): Person
    {
        return $this->persons[$name];
    }

    public function readPeople(): array
    {
        return $this->persons;
    }

}
class Facade
{
    public function __construct(
        private readonly PersonRepository $personRepository)
    {

    }

    public function whoIsTheSmarter(
        string $person1Name,
        string $person2Name
    ): Person {
        $person1 = $this->personRepository->readPerson($person1Name);
        $person2 = $this->personRepository->readPerson($person2Name);
        return $person1->iq > $person2->iq ? $person1 : $person2;
    }

    public function transferIq(
        string $fromName,
        string $toName,
        int $amountToTransfer
    ): void
    {
        $from = $this->personRepository->readPerson($fromName);
        $to = $this->personRepository->readPerson($toName);
        $from->iq -= $amountToTransfer;
        $to->iq += $amountToTransfer;
    }

    public function changeIqByDelta(string $personName, int $delta): void
    {
        $person = $this->personRepository->readPerson($personName);
        $person->iq += $delta;
    }
}

$repo = new PersonRepository();
$facade = new Facade($repo);
$facade->transferIq('John', 'Jane', 100);
print_r($facade->whoIsTheSmarter('John', 'Jane'));


print_r($repo->readPeople());



