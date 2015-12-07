<?php

namespace KumamidoriSnippet\UserRegistration\Module;

use BEAR\Package\PackageModule;
use Ray\Di\AbstractModule;

class AppModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        // default
        $this->install(new PackageModule);

        // custom
        $this->install(new Doctrine\DoctrineModule);
    }
}
