<?php
namespace NeosRulez\Bootstrap\Fusion;

use Neos\Flow\Annotations as Flow;
use Neos\Fusion\FusionObjects\AbstractFusionObject;

class VideoImplementation extends AbstractFusionObject {

    /**
     * @return array
     */
    public function evaluate() {
        $link = $this->fusionValue('video');
        if (strpos($link, 'youtube') !== false) {
            // if (strpos($link, 'watch') !== false) {
            //     $youtubeId = substr($link, strpos($link, "=") + 1);
            //     $link = 'https://www.youtube.com/embed/'.$youtubeId;
            // } else {
            //     $link = $this->fusionValue('video');
            // }
            $link = substr($link, strpos($link, "=") + 1);
            $platform = 'youtube';
        } else {
            if (strpos($link, 'player') == false) {
                if(preg_match("/\/(\d+)$/",$link,$matches)) {
                    $vimeoId = $matches[1];
                }
                $link = 'https://player.vimeo.com/video/'.$vimeoId;
            }
            $platform = 'vimeo';
        }
        $result = ['url' => $link, 'platform' => $platform];
        return $result;
    }
}