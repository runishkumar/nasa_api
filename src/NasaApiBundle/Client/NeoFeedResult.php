<?php
namespace NasaApiBundle\Client;

/**
 * @author runish.kumar<runish.kumar@rocket-internet.de>
 */
class NeoFeedResult
{
    private $links;

    private $nearEarthObjects;

    private $elementCount;

    function getLinks()
    {
        return $this->links;
    }

    function getNearEarthObjects()
    {
        return $this->nearEarthObjects;
    }

    function setLinks($links)
    {
        $this->links = $links;
    }

    function setNearEarthObjects($nearEarthObjects)
    {
        $this->nearEarthObjects = $nearEarthObjects;
    }

    function getElementCount()
    {
        return $this->elementCount;
    }

    function setElementCount($elementCount)
    {
        $this->elementCount = $elementCount;
    }
}
