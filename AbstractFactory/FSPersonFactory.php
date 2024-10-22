<?php

class FSPersonFactory implements AbstractPersonFactory
{
    public function createPersonRepository(array $config): PersonRepositoryInterface
    {
        return new FSPersonRepository($config);
    }
}