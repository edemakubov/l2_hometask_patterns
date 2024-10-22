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

class Facade
{
    public function __construct()
    {

    }

    public function whoIsTheSmarter(
        string $person1Name,
        string $person2Name
    ): Person{

    }

    public function transferIq(
        string $fromName,
        string $toName,
        int $amountToTransfer
    ): void
    {

    }

    public function changeIqByDelta(string $personName, int $delta): void
    {

    }

}


