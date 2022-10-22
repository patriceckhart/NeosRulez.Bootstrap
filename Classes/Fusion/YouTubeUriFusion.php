<?php
namespace NeosRulez\Bootstrap\Fusion;

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Neos\Fusion\FusionObjects\AbstractFusionObject;

class YouTubeUriFusion extends AbstractFusionObject {

    /**
     * @var array
     */
    protected $settings;

    /**
     * @param array $settings
     * @return void
     */
    public function injectSettings(array $settings): void
    {
        $this->settings = $settings;
    }

    /**
     * @return string
     */
    public function evaluate(): string
    {
        $link = $this->fusionValue('link');
        $result = '';
        if($link) {
            $youTubeUri = $this->settings['useYouTubeNoCookie'] ? 'https://www.youtube-nocookie.com' : 'https://www.youtube.com';
            if (strpos($link, 'watch') !== false) {
                $youtubeId = substr($link, strpos($link, "=") + 1);
                $result = $youTubeUri . '/embed/'.$youtubeId;
            }
            if (strpos($link, 'youtu.be') !== false) {
                $youtube_id = str_replace('https://youtu.be/', '', $link);
                $result = $youTubeUri . '/embed/'.$youtube_id;
            }
        }
        return $result;
    }

}
