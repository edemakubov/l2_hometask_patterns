## Composite
### Create a program that reflects a hierarchical file system. Create the following:

### FileSystemEntity interface:

```php 
public function getName(): string;
public function getSize(): int;
```

### File class:

Should implement FileSystemEntity interface

### Directory class

Should implement FileSystemEntity interface
Should have methods for FS operations:

```php
public function add(FileSystemEntity $fsEntity): void
public function remove(FileSystemEntity $fsEntity): void
public function listContent(): array
```
