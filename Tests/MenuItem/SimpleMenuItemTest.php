<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 31.10.17
 */

namespace GepurIt\Tests\MainMenuBundle\MenuItem;

use GepurIt\MainMenuBundle\MenuItem\MenuItemInterface;
use GepurIt\MainMenuBundle\MenuItem\SimpleMenuItem;
use PHPUnit\Framework\TestCase;

/**
 * Class SimpleMenuItemTest
 * @package AppBundle\Tests\MainMenu\MenuItem
 */
class SimpleMenuItemTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $label = 'label';
        $route = 'route';
        $accessResource = 'accessResource';
        $accessRule = 'accessRule';
        $simpleMenuItem = new SimpleMenuItem($label, $route, $accessResource, $accessRule);

        $this->assertInstanceOf(MenuItemInterface::class, $simpleMenuItem);
        $this->assertEquals($label, $simpleMenuItem->getLabel());
        $this->assertEquals($route, $simpleMenuItem->getRoute());
        $this->assertEquals($accessResource, $simpleMenuItem->getAccessResource());
        $this->assertEquals($accessRule, $simpleMenuItem->getAccessRule());

        $this->assertEmpty($simpleMenuItem->getChildren());
        $this->assertFalse($simpleMenuItem->hasChildren());

        $menuItem = $this->getMenuItemInterfaceMock();

        $simpleMenuItem->addChild('key', $menuItem);
        $this->assertTrue($simpleMenuItem->hasChildren());
        $this->assertNotEmpty($simpleMenuItem->getChildren());
    }

    /**
     * @return MenuItemInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    public function getMenuItemInterfaceMock()
    {
        $mock = $this->getMockBuilder(MenuItemInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(
                [
                    'getLabel',
                    'getRoute',
                    'getAccessResource',
                    'getAccessRule',
                    'addChild',
                    'getChildren',
                    'hasChildren',
                ]
            )
            ->getMock();

        return $mock;
    }
}

