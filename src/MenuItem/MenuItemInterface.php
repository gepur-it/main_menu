<?php

namespace GepurIt\MainMenuBundle\MenuItem;

/**
 * Interface MenuItemInterface
 * @package AppBundle\MainMenu\MenuItem
 */
interface MenuItemInterface
{
    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @return string
     */
    public function getRoute(): string;

    /**
     * @return string
     */
    public function getAccessResource(): string;

    /**
     * @return string
     */
    public function getAccessRule(): string;

    /**
     * @param string            $key
     * @param MenuItemInterface $menuItem
     */
    public function addChild(string $key, MenuItemInterface $menuItem);

    /**
     * @return MenuItemInterface[]
     */
    public function getChildren(): array;

    /**
     * @return bool
     */
    public function hasChildren(): bool;
}
