<?php

namespace KumamidoriSnippet\UserRegistration\Module\Usecase;

use Ray\Di\AbstractModule;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Symfony\Component\Security\Core\Util\SecureRandomInterface;
use KumamidoriSnippet\UserRegistration\Module\Doctrine\DoctrineModule;
use KumamidoriSnippet\UserRegistration\Module\Usecase\Provider\PasswordEncoderProvider;

class UsecaseModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->install(new DoctrineModule);
        $this->bind(PasswordEncoderInterface::class)->toProvider(PasswordEncoderProvider::class);
        $this->bind(SecureRandomInterface::class)->to(SecureRandom::class);

        $this->bind(UserRegistrationUsecase::class);
    }
}
