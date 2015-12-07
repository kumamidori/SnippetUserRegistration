<?php

namespace KumamidoriSnippet\UserRegistration\Module\Doctrine;

use Ray\Di\AbstractModule;
use Doctrine\ORM\EntityManagerInterface;
use KumamidoriSnippet\UserRegistration\Module\Doctrine\Provider\DoctrineORMProvider;

class DoctrineModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $dbConfig = [
            'driver' => 'pdo_sqlite',
            'path' =>  dirname(__DIR__) . '/../../var/db/example.sq3',
        ];
        $this->bind()->annotatedWith('master_db')->toInstance($dbConfig);
        $this->bind(EntityManagerInterface::class)->toProvider(DoctrineORMProvider::class);
    }
}
