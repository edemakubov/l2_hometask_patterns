## Create an Employee and Company class. Create multiple company reports based on the visitor pattern.

### Employee:

```php
private string $name
private int $salary
private string $department
```


### Company:

Has name attribute and holds multiple employees inside them.

### Reports:

* TotalSallaryReport: Report on the sum of employee salaries in the Company.
* TotalNumberOfEmployeesReport: Report on the total number of employees for a Company.
* AvarageSallaryReport: Report on the average employee salary in the Company.
* NumberOfEmployeeperDepartmentReport: Report that summarizes the number of employees per department.

