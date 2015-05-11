<?php


namespace Locastic\CoreBundle\Security;


use Locastic\CoreBundle\Entity\User;
use Locastic\CoreBundle\Repositories\UserRepository;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CustomUserProvider implements UserProviderInterface
{
    private $container;
    private $kernel;

    public function __construct($container, $kernel) {
        $this->container = $container;
        $this->kernel = $kernel;
    }

    public function loadUserByUsername($username)
    {
        $userRepo = new UserRepository($this->container->get('doctrine'));
        $user = $userRepo->getUserByUsername($username);

        if($user === null) {
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $username)
            );
        }

        // if the user is not verified, he is not allowed to login
        if($user->getVerified() === 0) {
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $username)
            );
        }

        if ($user) {
            return $user;
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Locastic\CoreBundle\Entity\User';
    }
}