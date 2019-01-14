<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 31.10.17
 */

namespace GepurIt\Tests\MainMenuBundle\MainMenu;

use GepurIt\MainMenuBundle\MenuItem\MenuItemInterface;
use GepurIt\MainMenuBundle\MainMenu;
use PHPUnit\Framework\TestCase;

/**
 * Class GlobalMenuTest
 * @package AppBundle\Tests\MainMenu
 */
class MainMenuTest extends TestCase
{
    public function testSetters()
    {
        $menuItem = $this->getMenuItemInterfaceMock();
        $key = 'someKey';
        $globalMenu = new MainMenu();
        $globalMenu->addMenuItem($key, $menuItem);
        $this->assertNull($globalMenu->getMenuItem('invalid_key'));
        $this->assertInstanceOf(MenuItemInterface::class, $globalMenu->getMenuItem($key));
        $this->assertEquals([$key=>$menuItem], $globalMenu->getMenuItems());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MenuItemInterface
     */
    public function getMenuItemInterfaceMock()
    {
        $mock =  $this->getMockBuilder(MenuItemInterface::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'getLabel',
                'getRoute',
                'getAccessResource',
                'getAccessRule',
                'addChild',
                'getChildren',
                'hasChildren',
            ])
            ->getMock();

        return $mock;
    }
}

