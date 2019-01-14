<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since : 14.01.19
 */

namespace GepurIt\MainMenuBundle;

use GepurIt\MainMenuBundle\DependencyInjection\CompilerPass\MainMenuCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class MainMenuBundle
 */
class MainMenuBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new MainMenuCompilerPass());
    }
}
