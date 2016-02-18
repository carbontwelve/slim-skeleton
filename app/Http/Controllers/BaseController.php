<?php

namespace App\Http\Controllers;

use Aura\Session\Segment;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

class BaseController
{
    /** @var null|ContainerInterface */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return ContainerInterface|null
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Returns an PSR-7 response object containing the rendered view. Use this abstraction throughout your app, then
     * you can replace the actual view engine here rather than in 100+ places if you change your mind down the road.
     *
     * @param $view
     * @param ResponseInterface $response
     * @param array             $args
     *
     * @return ResponseInterface
     */
    protected function view($view, ResponseInterface $response, array $args = [])
    {
        /** @var Segment $session */
        $session = $this->container->get(Segment::class);

        $args['router'] = $this->container->get('router');
        $args['old_input'] = $session->getFlash('old');

        $messageBag = [];
        $messageBag['error'] = $session->getFlash('error');
        $messageBag['success'] = $session->getFlash('success');
        $args['message_bag'] = $messageBag;

        /** @var \Carbontwelve\SlimPlates\PlatesRenderer $renderer */
        $renderer = $this->container['renderer'];

        return $renderer->render($response, $view, $args);
    }
}
