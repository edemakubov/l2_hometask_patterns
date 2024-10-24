<?php

class Employee
{
    public function __construct(
        public string $name,
        public string $department,
        public int $salary
    )
    {
    }
}


enum SortOrder
{
    case ASC;
    case DESC;
}

interface SortStrategy
{
    public function sort(array $employees, SortOrder $order = SortOrder::ASC): array;
}

class DepartmentNameSorting implements SortStrategy
{
    public function sort(array $employees, SortOrder $order = SortOrder::ASC): array
    {
        usort($employees, function ($a, $b) {
            return strcmp($a->getDepartment(), $b->getDepartment());
        });
    }
}

class EmployeeCollection
{

    private ?SortStrategy $sortStrategy = null;

    public function __construct(public array $employees = [])
    {

    }

    public function setSortingStrategy(SortStrategy $sortingStrategy): void {
        $this->sortingStrategy = $sortingStrategy;
    }

    public function getSortedEmployees(): array {
        if ($this->sortingStrategy === null) {
            throw new Exception("Sorting strategy not set.");
        }
        return $this->sortingStrategy->sort($this->employees);
    }
}

$soringStrategy = new DepartmentNameSorting();

$collection = new EmployeeCollection([
    new Employee('Anna', 'HR', 1000),
    new Employee('John', 'IT', 1200),
]);

$collection->setSortingStrategy($soringStrategy);
$sortedEmployees = $collection->getSortedEmployees();