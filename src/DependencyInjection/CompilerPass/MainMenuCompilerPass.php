<?php

namespace GepurIt\MainMenuBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MainMenuCompilerPass implements CompilerPassInterface
{
    const MAIN_MENU__SERVICE_NAME = 'app.main_menu';
    const MAIN_MENU__ITEM_TAG     = 'app.main_menu_item';

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(self::MAIN_MENU__SERVICE_NAME)) {
            return;
        }

        $definition     = $container->findDefinition(self::MAIN_MENU__SERVICE_NAME);
        $taggedServices = $container->findTaggedServiceIds(self::MAIN_MENU__ITEM_TAG);

        foreach (array_keys($taggedServices) as $key) {
            $menuItem = $container->getDefinition($key);
            $definition->addMethodCall('addMenuItem', [$key, $menuItem]);
        }
    }
}
