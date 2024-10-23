<?php

interface StringIteratorInterface
{
    public function hasNext(): bool;
    public function getNext(): ?string;
}

interface StringCollectionInterface
{
    public function getIterator(): StringIteratorInterface;
}



class InMemoryStringIterator implements StringIteratorInterface {
    private array $collection;
    private int $position = 0;

    public function __construct(array $collection) {
        $this->collection = $collection;
    }

    public function hasNext(): bool {
        return isset($this->collection[$this->position]);
    }

    public function getNext(): ?string {
        if ($this->hasNext()) {
            return $this->collection[$this->position++];
        }
        return null;
    }
}

class InMemoryStringCollection implements StringCollectionInterface {
    private $strings = [];

    public function __construct(array $strings) {
        $this->strings = $strings;
    }

    public function getIterator(): StringIteratorInterface {
        return new InMemoryStringIterator($this->strings);
    }
}
class FileStringIterator implements StringIteratorInterface {
    private $fileHandle;
    private $currentLine;

    public function __construct(string $filePath) {
        $this->fileHandle = fopen($filePath, 'r');
        $this->currentLine = fgets($this->fileHandle);
    }

    public function hasNext(): bool {
        return $this->currentLine !== false;
    }

    public function getNext(): ?string {
        if ($this->hasNext()) {
            $line = $this->currentLine;
            $this->currentLine = fgets($this->fileHandle);
            return $line;
        }
        return null;
    }

    public function __destruct() {
        fclose($this->fileHandle);
    }
}

class FileStringCollection implements StringCollectionInterface {
    private $filePath;

    public function __construct(string $filePath) {
        $this->filePath = $filePath;
    }

    public function getIterator(): StringIteratorInterface {
        return new FileStringIterator($this->filePath);
    }
}



echo "InMemoryStringCollectionInterface\n";
$inMemoryCollection = new InMemoryStringCollection(["bmw", "mercedes", "ford", "opel"]);
$inMemoryIterator = $inMemoryCollection->getIterator();

while ($inMemoryIterator->hasNext()) {
    echo $inMemoryIterator->getNext() . "\n";
}

echo "FileStringCollection\n";
$fileCollection = new FileStringCollection(__DIR__.'/countries.txt');
$fileIterator = $fileCollection->getIterator();

while ($fileIterator->hasNext()) {
    echo $fileIterator->getNext();
}