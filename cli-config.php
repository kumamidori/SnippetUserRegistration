<?php

use Ray\Di\Injector;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use KumamidoriSnippet\UserRegistration\Module\AppModule;

load: {
    /* @var $loader \Composer\Autoload\ClassLoader */
    $loader = require __DIR__ . '/vendor/autoload.php';
    AnnotationRegistry::registerLoader([$loader, 'loadClass']);
    AnnotationReader::addGlobalIgnoredName('visible');
}

$entityManager = (new Injector(new AppModule))->getInstance(EntityManagerInterface::class);

return ConsoleRunner::createHelperSet($entityManager);
