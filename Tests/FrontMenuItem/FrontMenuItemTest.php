<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 31.10.17
 */

namespace GepurIt\Tests\MainMenuBundle\FrontMenuItem;

use GepurIt\MainMenuBundle\FrontMenuItem\FrontMenuItem;
use PHPUnit\Framework\TestCase;

class FrontMenuItemTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $frontMenuItem = new FrontMenuItem();
        $label = 'label';
        $route = 'route';
        $frontMenuItem->setRoute($route);
        $frontMenuItem->setLabel($label);
        $this->assertEquals($label, $frontMenuItem->getLabel());
        $this->assertEquals($route, $frontMenuItem->getRoute());
        $this->assertEmpty($frontMenuItem->getChildren());
        $this->assertFalse($frontMenuItem->hasChildren());
        $frontMenuItem->addChild(new FrontMenuItem());
        $this->assertTrue($frontMenuItem->hasChildren());
        $this->assertNotEmpty($frontMenuItem->getChildren());
    }
}

