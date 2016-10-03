<?php

namespace InlineCssProvider\Service;


use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class WrapperService
{
    /** @var CssToInlineStyles */
    private $cssToInlineStyles;

    /** @var  string */
    private $pathToCss;

    /**
     * WrapperService constructor.
     *
     * @param $cssPath
     */
    public function __construct($cssPath)
    {
        $this->pathToCss = $cssPath;
        $this->cssToInlineStyles = new CssToInlineStyles();
    }

    /**
     * @param string $pathToTemplate
     *
     * @return string
     */
    public function generateInlineCssFromPath($pathToTemplate)
    {
        return $this->generateInlineCssFromString(
            file_get_contents($pathToTemplate)
        );
    }

    /**
     * @param string $html
     *
     * @return string
     */
    public function generateInlineCssFromString($html)
    {
        return $this->cssToInlineStyles->convert(
            $html,
            file_get_contents($this->pathToCss)
        );
    }

}