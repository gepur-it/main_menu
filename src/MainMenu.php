<?php

namespace GepurIt\MainMenuBundle;

use GepurIt\MainMenuBundle\MenuItem\MenuItemInterface;

class MainMenu
{
    /** @var array $menuItems */
    private $menuItems = [];

    /**
     * @param string            $key
     * @param MenuItemInterface $menuItem
     */
    public function addMenuItem(string $key, MenuItemInterface $menuItem)
    {
        $this->menuItems[$key] = $menuItem;
    }

    /**
     * @return MenuItemInterface[]
     */
    public function getMenuItems(): array
    {
        return $this->menuItems;
    }

    /**
     * @param $key
     *
     * @return MenuItemInterface
     */
    public function getMenuItem(string $key): ?MenuItemInterface
    {
        return $this->menuItems[$key] ?? null;
    }
}
