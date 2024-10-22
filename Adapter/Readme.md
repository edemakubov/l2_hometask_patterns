## Adapter

### Create an implementation for the IntegerStackInterface, and an adapter for the IntegerStackInterface implementation and the ASCIIStackInterface.

*IntegerStackInterface*:

```php
public function push(int $integer): void;		  
public function pop(): int
```

*ASCIIStackInterface*:

```php
public function push(string $char): void;		  
public function pop(): ?string;
```
