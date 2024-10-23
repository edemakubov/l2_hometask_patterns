<?php

class Employee
{
    public function __construct(
        public string $name,
        public int    $salary,
        public string $department
    )
    {
    }
}

class Company
{
    /**
     * @param string $name
     * @param array<Employee> $employees
     */
    public function __construct(
        public string $name,
        public array  $employees,
    )
    {
    }


    public function makeReport(Visitor $visitor)
    {
        return $visitor->handle($this);
    }
}

class Report
{
    public function __construct(
        public string $title,
        public string $content)
    {
    }
}

interface Visitor
{
    public function handle(Company $company): Report;
}

class TotalSallaryReport implements Visitor
{
    const TITLE = 'Total Salary Report';

    public function handle(Company $company): Report
    {

        return new Report(
            title: self::TITLE,
            content: array_sum(array_map(fn($employee) => $employee->salary, $company->employees))
        );
    }
}

class TotalNumberOfEmployeesReport implements Visitor
{
    const TITLE = 'Total Numbers Of Employees Report';

    public function handle(Company $company):Report
    {
        return new Report(
            title: self::TITLE,
            content: count($company->employees)
        );
    }
}

class AvgSalaryReport implements Visitor{

    const TITLE = 'Average Salary Report';

    public function handle(Company $company): Report
    {
        return new Report(
            title: self::TITLE,
            content: array_sum(array_map(fn($employee) => $employee->salary, $company->employees)) / count($company->employees)
        );
    }
}

class NumberOfEmployeeperDepartmentReport implements Visitor
{
    const TITLE = 'Number Of Employeeper Department Report';

    public function handle(Company $company): Report
    {
        $departmentCounts = array_count_values(
            array_map(fn($employee) => $employee->department, $company->employees)
        );

        $formattedContent = implode(", ", array_map(
            fn($department, $count) => "$department: $count",
            array_keys($departmentCounts),
            $departmentCounts
        ));

        return new Report(
            title: self::TITLE,
            content: $formattedContent
        );
    }
}


$company = new Company(
    name: 'Best Company',
    employees: [
        new Employee(name: 'John Doe', salary: 1000, department: 'IT'),
        new Employee(name: 'mr. Bean', salary: 900, department: 'IT'),
        new Employee(name: 'John Cina', salary: 900, department: 'IT'),
        new Employee(name: 'Jane Doe', salary: 1500, department: 'HR'),
        new Employee(name: 'jn HR', salary: 500, department: 'HR'),
    ]
);

$totalSallaryReport = $company->makeReport( new TotalSallaryReport());
print_r($totalSallaryReport);

$totalNumberOfEmployeesReport = $company->makeReport(new TotalNumberOfEmployeesReport());
print_r($totalNumberOfEmployeesReport);

$avgSalaryReport = $company->makeReport(new AvgSalaryReport());
print_r($avgSalaryReport);


$numberOfEmployeeperDepartmentReport = $company->makeReport(new NumberOfEmployeeperDepartmentReport());
print_r($numberOfEmployeeperDepartmentReport);