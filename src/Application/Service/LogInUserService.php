<?php

/*
 * This file is part of the User library.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BenGor\User\Application\Service;

use BenGor\User\Domain\Model\UserDoesNotExistException;
use BenGor\User\Domain\Model\UserInactiveException;
use BenGor\User\Domain\Model\UserInvalidPasswordException;
use BenGor\User\Domain\Model\UserPassword;
use BenGor\User\Domain\Model\UserPasswordEncoder;
use BenGor\User\Domain\Model\UserRepository;
use Ddd\Application\Service\ApplicationService;

/**
 * User login service class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class LogInUserService implements ApplicationService
{
    /**
     * The user repository.
     *
     * @var UserRepository
     */
    private $repository;

    /**
     * The user password encoder.
     *
     * @var UserPasswordEncoder
     */
    private $encoder;

    /**
     * Constructor.
     *
     * @param UserRepository      $aRepository The user repository
     * @param UserPasswordEncoder $anEncoder   The password encoder
     */
    public function __construct(UserRepository $aRepository, UserPasswordEncoder $anEncoder)
    {
        $this->repository = $aRepository;
        $this->encoder = $anEncoder;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($request = null)
    {
        $userId = $request->id();
        $plainPassword = $request->password();

        $user = $this->repository->userOfId($userId);
        if (null === $user) {
            throw new UserDoesNotExistException();
        }
        if (false === $user->isEnabled()) {
            throw new UserInactiveException();
        }

        $password = new UserPassword($plainPassword, $user->password()->salt(), $this->encoder);
        if (false === $user->password()->equals($password)) {
            throw new UserInvalidPasswordException();
        }
        $user->login();

        $this->repository->persist($user);
    }
}