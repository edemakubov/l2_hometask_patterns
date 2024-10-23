# Proxy
## Create a class that wraps the PersonRepository interface from task #1.

It should cache the results to readPerson(string $name) and only reach out to the wrapped PersonRepository 

if no person with a matching name has been read.