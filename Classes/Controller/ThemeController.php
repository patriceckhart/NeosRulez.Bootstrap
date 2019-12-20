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

class ThemeController extends ActionController
{

    /**
     * @Flow\Inject
     * @var \NeosRulez\Bootstrap\Domain\Repository\ThemeRepository
     */
    protected $themeRepository;

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
    public function generateThemeAction() {
        $colors = $this->settings['colors'];
        $scss = '';
        foreach($colors as $key=>$data) {
            $scss .= '$'.$key.': '.$data.'; ';
        }
        $styleFile = 'resource://NeosRulez.Bootstrap/Private/Styles/styles.scss';
        $themeFile = 'resource://NeosRulez.Bootstrap/Private/Styles/theme.scss';
        $oldThemeFile = file_get_contents($themeFile);
        if($oldThemeFile!=$scss) {
            file_put_contents($themeFile, $scss);
            $styleFileContent = file_get_contents($styleFile);
            file_put_contents($styleFile, $styleFileContent);
        }
        return '';
    }

}
