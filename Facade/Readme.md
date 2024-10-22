## Create a program that initiates several Person objects using the classes created in the Abstract Factory, and define a class which can do the following operations:

### Check which of two persons is smarter by name:

```php
public function whoIsTheSmarter(
string $person1Name,
string $person2Name
): Person
```

Move some IQ from one person to another by name and store the changes

```php 
public function transferIq(
string $fromName,
string $toName,
int $amountToTransfer
): void
```

Increment or reduce a person's IQ by name and store the changes
```php
public function changeIqByDelta(string $personName, int $delta): void
```

* If a person with that name couldn’t be found, then an exception should be thrown.
* If multiple persons are found with that name, then the operation should be done on the first one.

