<?php

class DBPersonFactory implements AbstractPersonFactory
{
    public function createPersonRepository(array $config): PersonRepositoryInterface
    {
        return new DBPersonRepository($config);
    }
}