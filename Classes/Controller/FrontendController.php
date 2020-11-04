<?php
namespace NeosRulez\Bootstrap\Controller;

/*
 * This file is part of the NeosRulez.Bootstrap package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Flow\ResourceManagement\Streams\StreamWrapperAdapter;
use Neos\Eel\FlowQuery\FlowQuery;
use Neos\Eel\FlowQuery\Operations;

class FrontendController extends ActionController
{

    /**
     * @var array
     */
    protected $settings;

    /**
     * @param array $settings
     * @return void
     */
    public function injectSettings(array $settings) {
        $this->settings = $settings;
    }

    /**
     * @return void
     */
    public function youTubeAction() {
        $link = $this->request->getInternalArgument('__link');
        if (strpos($link, 'watch') !== false) {
            $youtubeId = substr($link, strpos($link, "=") + 1);
            $link = 'https://www.youtube.com/embed/'.$youtubeId;
        }
        if (strpos($link, 'youtu.be') !== false) {
            $youtube_id = str_replace('https://youtu.be/', '', $link);
            $link = 'https://www.youtube.com/embed/'.$youtube_id;
        }
        $this->view->assign('link',$link);
        $this->view->assign('attributes',$this->request->getInternalArgument('__attributes'));
    }

    /**
     * @return void
     */
    public function vimeoAction() {
        $link = $this->request->getInternalArgument('__link');
        if (strpos($link, 'player') == false) {
            if(preg_match("/\/(\d+)$/",$link,$matches)) {
                $vimeoId = $matches[1];
            }
            $link = 'https://player.vimeo.com/video/'.$vimeoId;
        }
        $this->view->assign('link',$link);
        $this->view->assign('attributes',$this->request->getInternalArgument('__attributes'));
        $this->view->assign('autoplay',$this->request->getInternalArgument('__autoplay'));
        $this->view->assign('loop',$this->request->getInternalArgument('__loop'));
        $this->view->assign('introImage',$this->request->getInternalArgument('__introImage'));
        $this->view->assign('introTitle',$this->request->getInternalArgument('__introTitle'));
        $this->view->assign('introAuthor',$this->request->getInternalArgument('__introAuthor'));
    }

    /**
     * @return void
     */
    public function googleMapsAction() {
        $address = $this->request->getInternalArgument('__address');
        $zip = $this->request->getInternalArgument('__zip');
        $city = $this->request->getInternalArgument('__city');
        $country = $this->request->getInternalArgument('__country');
        $source = $this->request->getInternalArgument('__source');
        if(!empty($source)) {
            $this->view->assign('source',$source);
        } else {
            $sendAddress = $address.'+'.$zip.' '.$city.'+'.$country;
            $sendAddress = str_replace(' ', '+', $sendAddress);
            $this->view->assign('address',$sendAddress);
        }
        $this->view->assign('attributes',$this->request->getInternalArgument('__attributes'));
    }

}
