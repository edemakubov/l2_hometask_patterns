<?php

class PersonFactory
{
    public static function getFactory(AbstractPersonFactory $abstractPersonFactory, array $config): PersonRepositoryInterface
    {
       return $abstractPersonFactory->createPersonRepository($config);
    }
}