<?php

class Person
{
    public function __construct(
        public string $name,
        public string $email
    ) {}

    public function toArray(): array
    {
        return ['name' => $this->name, 'email' => $this->email];
    }

    public static function fromArray(array $data): Person
    {
        return new self(
            name: $data['name'],
            email: $data['email']
        );
    }
}