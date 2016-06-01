<?php
/**
 * @author Petr Grishin <petr.grishin@grishini.ru>
 */

namespace Grav\Plugin;

use Grav\Common\Plugin;

class ImageCollagePlugin extends Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized'  => ['onPluginsInitialized', 0],
        ];
    }

    public function onPluginsInitialized()
    {
        $this->enable([
            'onTwigExtensions'    => ['onTwigExtensions', 0],
        ]);
    }

    public function onTwigExtensions()
    {
        require_once(__DIR__ . '/image_collage_twig_extension.php');
        $this->grav['twig']->twig->addExtension(new \ImageCollageTwigExtension());
    }
}