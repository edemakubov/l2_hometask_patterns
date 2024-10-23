# Iterator
## Create an iterable StringCollection interface with an in-memory and a file implementation. Do not use PHP built-in iterator classes, methods, interfaces.

```php 
StringIterator interface:

public function hasNext(): bool;
public function getNext(): ?string;

StringCollection interface:

public function getIterator(): StringIterator;
```

Create a File implementation for the StringCollection interface

Create an InMemory implementation for the StringCollection interface

