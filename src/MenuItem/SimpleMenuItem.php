<?php

namespace GepurIt\MainMenuBundle\MenuItem;

/**
 * Class SimpleMenuItem
 * @package AppBundle\MainMenu\MenuItem
 */
class SimpleMenuItem implements MenuItemInterface, \JsonSerializable
{
    /**
     * @var string $label
     */
    private $label;

    /**
     * @var string $route
     */
    private $route;

    /**
     * @var string $accessResource
     */
    private $accessResource;

    /**
     * @var string $accessRule
     * */
    private $accessRule;

    /**
     * @var MenuItemInterface[]
     */
    private $children = [];

    /**
     * SimpleMenuItem constructor.
     *
     * @param string $label
     * @param string $route
     * @param string $accessResource
     * @param string $accessRule set "ANY" do disable access checking
     */
    public function __construct(string $label, string $route, string $accessResource, string $accessRule)
    {
        $this->label          = $label;
        $this->route          = $route;
        $this->accessResource = $accessResource;
        $this->accessRule     = $accessRule;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @return string
     */
    public function getAccessResource(): string
    {
        return $this->accessResource;
    }

    /**
     * @return string
     */
    public function getAccessRule(): string
    {
        return $this->accessRule;
    }

    /**
     * @param string            $key
     * @param MenuItemInterface $menuItem
     */
    public function addChild(string $key, MenuItemInterface $menuItem)
    {
        $this->children[$key] = $menuItem;
    }

    /**
     * @return MenuItemInterface[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @return bool
     */
    public function hasChildren(): bool
    {
        return (count($this->children) > 0);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'label'          => $this->getLabel(),
            'route'          => $this->getRoute(),
            'accessResource' => $this->getAccessResource(),
            'children'       => $this->getChildren(),
        ];
    }
}
