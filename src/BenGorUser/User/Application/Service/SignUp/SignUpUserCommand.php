<?php

/*
 * This file is part of the BenGorUser package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BenGorUser\User\Application\Service\SignUp;

/**
 * Sign up user command class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class SignUpUserCommand
{
    /**
     * The user email.
     *
     * @var string
     */
    private $email;

    /**
     * The plain password.
     *
     * @var string
     */
    private $plainPassword;

    /**
     * Array which contains the roles.
     *
     * @var array
     */
    private $roles;

    /**
     * Constructor.
     *
     * @param string $anEmail        The email
     * @param string $aPlainPassword The plain password
     * @param array  $roles          Array which contains the roles
     */
    public function __construct($anEmail, $aPlainPassword, array $roles)
    {
        $this->email = $anEmail;
        $this->plainPassword = $aPlainPassword;
        $this->roles = $roles;
    }

    /**
     * Gets the email.
     *
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * Gets the user plain password.
     *
     * @return string
     */
    public function password()
    {
        return $this->plainPassword;
    }

    /**
     * Gets the roles.
     *
     * @return array
     */
    public function roles()
    {
        return $this->roles;
    }
}
