<?php

namespace InlineCssProvider;

use InlineCssProvider\Exception\MissingDependencyException;
use InlineCssProvider\Service\RenderService;
use InlineCssProvider\Service\WrapperService;
use Silex\Api\BootableProviderInterface;
use Silex\Application;

class InlineCssProvider implements BootableProviderInterface
{
    /** @var  string */
    private $pathToCss;

    public function __construct($pathToCss)
    {
        $this->pathToCss = $pathToCss;
    }

    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app A container instance
     */
    public function register(Application $app)
    {
        $app['inlinecss.inlinecss'] = new WrapperService($this->pathToCss);

        if (isset($app['twig'])) {
            $app['inlinecss.render'] = new RenderService($app['inlinecss.inlinecss'], $app['twig']);
        } else {
            $app['inlinecss.render'] = new MissingDependencyException("In order to use the direct render service, you need to have a twig enviroment registered!");
        }
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     *
     * @param Application $app
     */
    public function boot(Application $app)
    {
        // TODO: Implement boot() method.
    }
}