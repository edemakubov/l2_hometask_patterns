## Decorator
### Create the following decorators for the PersonRepository interface from task #1:

LowerCaseReadPersonDecorator: 
Both the readPerson and readPeople methods should return Persons with their names converted to lower case.

UppercaseWritePersonDecorator: writePerson should convert a person’s name to uppercase before saving it.

Create a composition with the decorators so every loaded Person will have lowercase names but when they are saved, they will be saved with an uppercase name.

