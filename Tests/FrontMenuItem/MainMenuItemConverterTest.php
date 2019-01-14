<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 31.10.17
 */

namespace GepurIt\Tests\MainMenuBundle\FrontMenuItem;

use GepurIt\MainMenuBundle\FrontMenuItem\FrontMenuItem;
use GepurIt\MainMenuBundle\FrontMenuItem\MainMenuItemConverter;
use GepurIt\MainMenuBundle\MenuItem\MenuItemInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class MainMenuItemConverterTest
 * @package AppBundle\Tests\MainMenu\FrontMenuItem
 */
class MainMenuItemConverterTest extends TestCase
{
    public function testWithoutChildrenConvert()
    {
        $route = 'route';
        $label = 'label';
        $menuItem = $this->getMenuItemInterfaceMock();
        $menuItem->expects($this->once())
            ->method('getRoute')
            ->willReturn($route);
        $menuItem->expects($this->once())
            ->method('getLabel')
            ->willReturn($label);
        $menuItem->expects($this->once())
            ->method('getChildren')
            ->willReturn([]);

        $urlGenerator = $this->getUrlGeneratorInterfaceMock();
        $urlGenerator->expects($this->once())
            ->method('generate')
            ->with($route)
            ->willReturn($route);
        $authChecker = $this->createMock(AuthorizationCheckerInterface::class);
        $authChecker->expects($this->once())
            ->method('isGranted')
            ->willReturn(true);
        $converter = new MainMenuItemConverter($urlGenerator, $authChecker);
        $frontMenuItem = $converter->convert($menuItem);
        $this->assertInstanceOf(FrontMenuItem::class, $frontMenuItem);
        $this->assertEquals($label, $frontMenuItem->getLabel());
        $this->assertEquals($route, $frontMenuItem->getRoute());
    }

    public function testWithChildrenConvert()
    {
        $route = 'route';
        $label = 'label';
        $childLabel = 'childLabel';
        $childRoute = 'childRoute';

        $childItem = $this->getMenuItemInterfaceMock();
        $menuItem = $this->getMenuItemInterfaceMock();

        $childItem->expects($this->once())
            ->method('getRoute')
            ->willReturn($childRoute);
        $childItem->expects($this->once())
            ->method('getLabel')
            ->willReturn($childLabel);
        $childItem->expects($this->once())
            ->method('getChildren')
            ->willReturn([]);

        $menuItem->expects($this->once())
            ->method('getRoute')
            ->willReturn($route);
        $menuItem->expects($this->once())
            ->method('getLabel')
            ->willReturn($label);
        $menuItem->expects($this->once())
            ->method('getChildren')
            ->willReturn([$childItem]);

        $urlGenerator = $this->getUrlGeneratorInterfaceMock();

        $urlGenerator->expects($this->at(0))
            ->method('generate')
            ->with($route)
            ->willReturn($route);

        $urlGenerator->expects($this->at(1))
            ->method('generate')
            ->with($childRoute)
            ->willReturn($childRoute);

        $authChecker = $this->createMock(AuthorizationCheckerInterface::class);
        $authChecker->expects($this->exactly(2))
            ->method('isGranted')
            ->willReturn(true);
        $converter = new MainMenuItemConverter($urlGenerator, $authChecker);

        $this->assertInstanceOf(FrontMenuItem::class, $converter->convert($menuItem));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|UrlGeneratorInterface
     */
    public function getUrlGeneratorInterfaceMock()
    {
        $mock = $this->getMockBuilder(UrlGeneratorInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(
                [
                    'generate',
                    'setContext',
                    'getContext',
                ]
            )
            ->getMock();

        return $mock;
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

