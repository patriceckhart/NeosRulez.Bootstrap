<?php
namespace NeosRulez\Bootstrap\Eel;

use Neos\Flow\Annotations as Flow;
use Neos\Eel\ProtectedContextAwareInterface;

class ImageSizeHelper implements ProtectedContextAwareInterface
{

    /**
     * @param string|int $width
     * @param string|int $height
     * @param string|int $maximumWidth
     * @return int
     */
    public function getHeight(string|int $width, string|int $height, string|int $maximumWidth): int
    {
        $width = (int) $width;
        $height = (int) $height;
        $maximumWidth = (int) $maximumWidth;
        if($width <= $maximumWidth) {
            $maximumWidth = $width;
        }
        return (int) ($maximumWidth / ($width / $height));
    }

    /**
     * All methods are considered safe, i.e. can be executed from within Eel
     *
     * @param string $methodName
     * @return boolean
     */
    public function allowsCallOfMethod($methodName)
    {
        return true;
    }

}
