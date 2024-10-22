<?php

class IntegerStackToASCIIAdapter implements ASCIIStackInterface
{
    public function __construct(
        private readonly IntegerStackInterface $integerStack)
    {
    }

    public function push(string $ascii): void
    {
        $this->integerStack->push($ascii);
    }

    public function pop(): string
    {
        return $this->integerStack->pop();
    }
}


class IntegerStack implements IntegerStackInterface
{
    private array $stack = [];
    public function push(int $integer): void
    {
        $this->stack[] = $integer;
    }

    public function pop(): int
    {
        if (empty($this->stack)) {
            throw new UnderflowException("Stack is empty");
        }
        return array_pop($this->stack);
    }
}

class ASCIIStack implements ASCIIStackInterface
{
    private array $stack = [];
    public function push(string $ascii): void
    {
        $this->stack[] = $ascii;
    }

    public function pop(): string
    {
        if (empty($this->stack)) {
            throw new UnderflowException("Stack is empty");
        }
        return array_pop($this->stack);
    }
}

interface IntegerStackInterface
{
    public function push(int $integer): void;

    public function pop(): ?int;
}

interface ASCIIStackInterface
{
    public function push(string $ascii): void;

    public function pop(): ?string;
}

$a = new IntegerStack();
$b = new IntegerStackToASCIIAdapter($a);
$b->push(1);
$b->push(2);
$b->push(3);


$b->pop();

print_r($b);