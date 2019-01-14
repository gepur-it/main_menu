<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since : 19.09.17
 */

namespace GepurIt\MainMenuBundle\FrontMenuItem;

use GepurIt\MainMenuBundle\MenuItem\MenuItemInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class MainMenuItemConverter
 * @package AppBundle\MainMenu\FrontMainMenuItem
 */
class MainMenuItemConverter
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /** @var AuthorizationCheckerInterface */
    private $authorisationChecker;

    /**
     * MainMenuItemConverter constructor.
     *
     * @param UrlGeneratorInterface         $urlGenerator
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->authorisationChecker = $authorizationChecker;
        $this->urlGenerator         = $urlGenerator;
    }

    /**
     * @param MenuItemInterface $menuItem
     *
     * @return null|FrontMenuItem
     */
    public function convert(MenuItemInterface $menuItem): ?FrontMenuItem
    {
        if ($menuItem->getAccessRule() !== 'ANY'
            && !$this->authorisationChecker->isGranted(
                $menuItem->getAccessRule(),
                $menuItem->getAccessResource()
            )
        ) {
            return null;
        }

        $frontMeuItem = new FrontMenuItem();
        $frontMeuItem->setLabel($menuItem->getLabel());
        $frontMeuItem->setRoute($this->urlGenerator->generate($menuItem->getRoute()));
        foreach ($menuItem->getChildren() as $menuItemChild) {
            $childItem = $this->convert($menuItemChild);
            if (null !== $childItem) {
                $frontMeuItem->addChild($childItem);
            }
        }

        return $frontMeuItem;
    }
}

