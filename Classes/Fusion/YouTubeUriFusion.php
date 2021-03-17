<?php
namespace NeosRulez\Bootstrap\Fusion;

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Neos\Fusion\FusionObjects\AbstractFusionObject;

class YouTubeUriFusion extends AbstractFusionObject {

    /**
     * @return string
     */
    public function evaluate() {
        $link = $this->fusionValue('link');
        $result = false;
        if($link) {
            if (strpos($link, 'watch') !== false) {
                $youtubeId = substr($link, strpos($link, "=") + 1);
                $result = 'https://www.youtube.com/embed/'.$youtubeId;
            }
            if (strpos($link, 'youtu.be') !== false) {
                $youtube_id = str_replace('https://youtu.be/', '', $link);
                $result = 'https://www.youtube.com/embed/'.$youtube_id;
            }
        }
        return $result;
    }

}
