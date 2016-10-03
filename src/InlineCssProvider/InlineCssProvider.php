<?php

namespace InlineCssProvider;

use InlineCssProvider\Exception\MissingDependencyException;
use InlineCssProvider\Service\RenderService;
use InlineCssProvider\Service\WrapperService;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class InlineCssProvider implements ServiceProviderInterface
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
     * @param Container $appContainer A container instance
     */
    public function register(Container $appContainer)
    {
        $appContainer['inlinecss.inlinecss'] = new WrapperService($this->pathToCss);

        if (isset($appContainer['twig'])) {
            $appContainer['inlinecss.render'] = new RenderService($appContainer['inlinecss.inlinecss'], $appContainer['twig']);
        } else {
            $appContainer['inlinecss.render'] = new MissingDependencyException("In order to use the direct render service, you need to have a twig enviroment registered!");
        }
    }
}