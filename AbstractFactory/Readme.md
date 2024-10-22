## Abstract Factory

### Write a program that can store information about people both in DB and in FS.

The user should choose if he/she wishes to work from FS or DB but that point forward the client code should be identical in both cases. The following operations should be supported in the *PersonRepository* interface:

```php
public function savePerson(Person $person): void
public function readPeople(): array
public function readPerson(string $name): ?Person
```

