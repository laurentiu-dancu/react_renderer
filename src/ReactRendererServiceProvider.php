<?php

namespace Drupal\react_renderer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Symfony\Component\DependencyInjection\Reference;

class ReactRendererServiceProvider extends ServiceProviderBase
{
    /**
     * {@inheritdoc}
     */
    public function register(ContainerBuilder $container)
    {
        $path = DRUPAL_ROOT . '/../assets/build/server.js';

        $container->register(
            'react_renderer.php_exec_js_renderer',
            'Limenius\ReactRenderer\Renderer\PhpExecJsReactRenderer')
            ->addArgument($path)
            ->addArgument(false)
            ->addArgument(new Reference('react_renderer.context_provider'));

        $container->register(
            'react_renderer.twig_extension',
            'Limenius\ReactRenderer\Twig\ReactRenderExtension')
            ->addArgument(new Reference('react_renderer.php_exec_js_renderer'))
            ->addArgument(new Reference('react_renderer.context_provider'))
            ->addArgument('both')
            ->addTag('twig.extension');
    }
}
