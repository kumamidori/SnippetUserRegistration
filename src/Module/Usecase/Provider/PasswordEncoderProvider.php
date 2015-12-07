<?php

namespace KumamidoriSnippet\UserRegistration\Module\Usecase\Provider;

use Ray\Di\ProviderInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\PlaintextPasswordEncoder;
use Symfony\Component\Security\Core\User\User as SecurityUser;
use KumamidoriSnippet\UserRegistration\Module\Entity\User;

class PasswordEncoderProvider implements ProviderInterface
{
    /**
     * Get object
     *
     * @return mixed
     */
    public function get()
    {
        $encoders = [
            SecurityUser::class => [
                'class' => PlaintextPasswordEncoder::class,
                'argument' => [false],
            ],
            User::class => [
                'class' => MessageDigestPasswordEncoder::class,
                'arguments' => [
                    'sha1',
                    'true',
                    '5000',
                ]
            ]
        ];
        $factory = new EncoderFactory($encoders);

        return $factory->getEncoder(new User);
    }
}
