<?php

interface FileSystemEntityInterface
{
    public function getName(): string;

    public function getSize(): int;
}


class FileClass implements FileSystemEntityInterface
{
    public function __construct(
        private string $name,
        private int    $size
    ){}

    public function getName(): string
    {
        return $this->name;
    }

    public function getSize(): int
    {
        return $this->size;
    }
}

class DirectoryClass implements FileSystemEntityInterface
{
    private array $children = [];

    public function __construct(private string $name){}

    public function getName(): string
    {
        return $this->name;
    }

    public function getSize(): int
    {
        $totalSize = 0;
        foreach ($this->children as $child) {
            $totalSize += $child->getSize();
        }
        return $totalSize;
    }

    public function add(FileSystemEntityInterface $fsEntity): void
    {
        $this->children[] = $fsEntity;
    }

    public function remove(FileSystemEntityInterface $fsEntity): void
    {
        $this->children = array_filter($this->children, fn($child) => $child !== $fsEntity);
    }

    public function listContent(): array
    {
        return $this->children;
    }
}


$fileA = new FileClass('fileA', 100);
$fileB = new FileClass('fileB', 150);
$fileC = new FileClass('fileC', 5000);
$fileD = new FileClass('fileD', 2);


$rootFolder = new DirectoryClass("root");

$folderA = new DirectoryClass('folderA');
$folderB = new DirectoryClass('folderB');
$folderC = new DirectoryClass('folderC');


$rootFolder->add($folderA);
$rootFolder->add($folderB);

$folderA->add($folderC);
$folderC->add($fileD);

$folderA->add($fileA);
$folderA->add($fileB);
$folderB->add($fileC);

print_r($rootFolder->getSize()); //why here 5254
print_r($rootFolder->listContent());