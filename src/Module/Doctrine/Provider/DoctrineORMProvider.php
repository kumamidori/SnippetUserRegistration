<?php

namespace KumamidoriSnippet\UserRegistration\Module\Doctrine\Provider;

use Ray\Di\ProviderInterface;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class DoctrineORMProvider implements ProviderInterface
{
    /**
     * @param array $masterDb
     *
     * @Inject
     * @Named("masterDb=master_db")
     */
    public function __construct(array $masterDb)
    {
        $this->masterDb = $masterDb;
    }

    public function get()
    {
        $paths = [__DIR__ . '/../../../Module/Entity'];
        $isDevMode = false;

        $config = Setup::createAnnotationMetadataConfiguration(
            $paths,
            $isDevMode
        );
        $conn = $this->masterDb;

        return EntityManager::create($conn, $config);
    }
}
