<?php
namespace Budgetcontrol\SdkMailer\View\Render;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class Views
{
    protected string $dirPath = __DIR__.'/../../../resources/Templates/';
    private Environment $twig;
    protected string $templateName = 'template.twig';

    public function __construct()
    {
        $loader = new FilesystemLoader($this->dirPath);
        $this->twig = new Environment($loader);
    }

    /**
     * Renders the view with the given data.
     *
     * @param array $data The data to be passed to the view.
     * @return string The rendered view as a string.
     */
    public function render(array $data = []): string
    {
        $this->validate();
        return $this->twig->render($this->templateName, $data);
    }

    /**
     * Validates the view.
     *
     * @return void
     */
    private function validate()
    {
        if(!file_exists($this->dirPath.$this->templateName)) {
            throw new ViewRenderExceptions("File doesn't exist on path ".$this->dirPath.$this->templateName);
        }

        if(!is_readable($this->dirPath.$this->templateName)) {
            throw new ViewRenderExceptions("File is not readable on path ".$this->dirPath.$this->templateName);
        }

        if(!strpos($this->templateName,'.html')) {
            throw new ViewRenderExceptions();
        }
    }

    /**
     * Sets the cache path for the view.
     *
     * @param string $cachePath The path to the cache directory.
     * @return void
     */
    private function setCache(string $cachePath)
    {
        $this->twig->setCache($cachePath);
    }
}