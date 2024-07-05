<?php
namespace NeosRulez\Bootstrap\Eel;

use Neos\Flow\Annotations as Flow;
use Neos\Eel\ProtectedContextAwareInterface;

class ImageSizeHelper implements ProtectedContextAwareInterface
{

    /**
     * @param string|int|null $width
     * @param string|int|null $height
     * @param string|int|null $maximumWidth
     * @return int
     */
    public function getHeight(string|int|null $width = null, string|int|null $height = null, string|int|null $maximumWidth = null): int
    {
        if($width && $height && $maximumWidth) {
            $width = (int) $width;
            $height = (int) $height;
            $maximumWidth = (int) $maximumWidth;
            if($width <= $maximumWidth) {
                $maximumWidth = $width;
            }
            return (int) ($maximumWidth / ($width / $height));
        }
        return 0;
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
