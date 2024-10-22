<?php

interface AbstractPersonFactory
{
    public function createPersonRepository(array $config): PersonRepositoryInterface;
}