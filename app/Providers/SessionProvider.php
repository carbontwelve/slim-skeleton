<?php namespace App\Providers;

use Interop\Container\ContainerInterface;
use Aura\Session\SessionFactory;
use Pimple\ServiceProviderInterface;
use Slim\Views\PhpRenderer;
use Aura\Session\Segment;
use Aura\Session\Session;
use Pimple\Container;

class SessionProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container|ContainerInterface $pimple A container instance
     * @return PhpRenderer
     */
    public function register(Container $pimple)
    {
        $sessionFactory = new SessionFactory();
        $session = $sessionFactory->newInstance($_COOKIE);
        $pimple[Session::class] = $session;
        $pimple[Segment::class] = $session->getSegment('App');
    }
}
