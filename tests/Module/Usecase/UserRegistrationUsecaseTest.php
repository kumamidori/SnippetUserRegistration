<?php

namespace KumamidoriSnippet\UserRegistration\Module\Usecase;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Util\SecureRandomInterface;
use KumamidoriSnippet\UserRegistration\Module\Entity\User;
use KumamidoriSnippet\UserRegistration\Module\Repository\UserRepository;

class UserRegistrationUsecaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function registerUser()
    {
        $userRepository = \Phake::mock(UserRepository::class);
        $password = 'PASSWORD';
        $user = \Phake::mock(User::class);
        \Phake::when($user)->getPassword()->thenReturn($password);

        $entityManager = \Phake::mock(EntityManagerInterface::class);
        \Phake::when($entityManager)->getRepository(User::class)->thenReturn($userRepository);

        $passwordEncoder = \Phake::mock(PasswordEncoderInterface::class);
        \Phake::when($passwordEncoder)->encodePassword($this->anything(), $this->anything())->thenReturn($password);

        $activationKey = 'ACTIVATION_KEY';
        $secureRandom = \Phake::mock(SecureRandomInterface::class);
        \Phake::when($secureRandom)->nextBytes($this->anything())->thenReturn($activationKey);

        $userRegistrationUsecase = new UserRegistrationUsecase($entityManager, $passwordEncoder, $secureRandom);
        $userRegistrationUsecase->run($user);

        \Phake::verify($secureRandom)->nextBytes($this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_INT));
        \Phake::verify($user)->setActivationKey($this->equalTo(base64_encode($activationKey)));
        \Phake::verify($user)->getPassword();
        \Phake::verify($passwordEncoder)->encodePassword($this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_STRING), $this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_STRING));
        \Phake::verify($user)->setPassword($this->isType(\PHPUnit_Framework_Constraint_IsType::TYPE_STRING));
        \Phake::verify($user)->setRegistrationDate($this->isInstanceOf('DateTime'));
        \Phake::verify($userRepository)->add($this->identicalTo($user));
        \Phake::verify($entityManager)->flush();
    }
}
