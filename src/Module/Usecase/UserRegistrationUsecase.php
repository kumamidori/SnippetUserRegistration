<?php

namespace KumamidoriSnippet\UserRegistration\Module\Usecase;

use Ray\Di\Di\Inject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Util\SecureRandomInterface;
use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Usecase\CommandUsecaseInterface;
use KumamidoriSnippet\UserRegistration\Module\Entity\User;

class UserRegistrationUsecase implements CommandUsecaseInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var PasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var SecureRandomInterface
     */
    private $secureRandom;

    /**
     * @param EntityManagerInterface   $entityManager
     * @param PasswordEncoderInterface $passwordEncoder
     * @param SecureRandomInterface    $secureRandom
     *
     * @Inject
     */
    public function __construct(EntityManagerInterface $entityManager, PasswordEncoderInterface $passwordEncoder, SecureRandomInterface $secureRandom)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->secureRandom = $secureRandom;
    }

    /**
     * {@inheritDoc}
     *
     * @return void
     */
    public function run(EntityInterface $user)
    {
        $user->setActivationKey(base64_encode($this->secureRandom->nextBytes(24)));
        $user->setPassword($this->passwordEncoder->encodePassword($user->getPassword(), User::SALT));
        $user->setRegistrationDate(new \DateTime());

        $this->entityManager->getRepository(User::class)->add($user);
        $this->entityManager->flush();
    }
}
