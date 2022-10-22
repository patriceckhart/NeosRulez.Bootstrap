<?php
namespace NeosRulez\Bootstrap\Fusion;

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Neos\Fusion\FusionObjects\AbstractFusionObject;

class VimeoUriFusion extends AbstractFusionObject {

    /**
     * @return string
     */
    public function evaluate(): string
    {
        $link = $this->fusionValue('link');
        $result = false;
        if($link) {
            if (strpos($link, 'player') == false) {
                if(preg_match("/\/(\d+)$/",$link,$matches)) {
                    $vimeoId = $matches[1];
                }
                $result = 'https://player.vimeo.com/video/' . $vimeoId;
            }
        }
        return $result;
    }

}
