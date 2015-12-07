<?php

namespace KumamidoriSnippet\UserRegistration\Resource\App\Users;

use BEAR\Resource\ResourceObject;
use Ray\Di\Di\Inject;
use KumamidoriSnippet\UserRegistration\Module\Entity\User;
use KumamidoriSnippet\UserRegistration\Module\Usecase\UserRegistrationUsecase;

class Registration extends ResourceObject
{
    /**
     * @var UserRegistrationUsecase
     */
    private $usecase;

    /**
     * @param UserRegistrationUsecase $usecase
     *
     * @Inject
     */
    public function setUserRegistrationUsecase(UserRegistrationUsecase $usecase)
    {
        $this->usecase = $usecase;
    }

    public function onPost($lastName, $firstName, $email, $password)
    {
        $user = new User();
        $user->setlastName($lastName);
        $user->setFirstName($firstName);
        $user->setEmail($email);
        $user->setPassword($password);

        $this->usecase->run($user);

        return $this;
    }
}
