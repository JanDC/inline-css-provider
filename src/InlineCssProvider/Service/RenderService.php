<?php

namespace InlineCssProvider\Service;

use Twig_Environment;

class RenderService
{
    /** @var WrapperService */
    private $wrapperService;

    /** @var Twig_Environment */
    private $twig;

    /**
     * RenderService constructor.
     *
     * @param WrapperService $wrapperService
     * @param Twig_Environment $twig
     */
    public function __construct(WrapperService $wrapperService, Twig_Environment $twig)
    {
        $this->wrapperService = $wrapperService;
        $this->twig = $twig;
    }

    /**
     * @param string $template
     * @param array $context
     *
     * @return string Rendered Template with inline styles
     */
    public function RenderAndInlineTemplate($template, array $context)
    {
        $resolvedAndRenderedTemplate = $this->twig->render($template, $context);
        return $this->wrapperService->generateInlineCssFromString($resolvedAndRenderedTemplate);
    }
}