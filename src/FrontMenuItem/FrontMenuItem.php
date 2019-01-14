<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since : 19.09.17
 */

namespace GepurIt\MainMenuBundle\FrontMenuItem;

/**
 * Class FrontMainMenuItem
 * @package AppBundle\MainMenu\FrontMainMenuItem
 * @JMS\ExclusionPolicy("all")
 */
class FrontMenuItem implements \JsonSerializable
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
     * @var FrontMenuItem[]
     */
    private $children = [];

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @param string $route
     */
    public function setRoute(string $route)
    {
        $this->route = $route;
    }

    /**
     * @return FrontMenuItem[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param FrontMenuItem $child
     */
    public function addChild(FrontMenuItem $child)
    {
        $this->children[] = $child;
    }

    /**
     * @return bool
     */
    public function hasChildren(): bool
    {
        return !empty($this->children);
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
            'label'    => $this->getLabel(),
            'url'      => $this->getRoute(),
            'children' => $this->getChildren(),
        ];
    }
}
