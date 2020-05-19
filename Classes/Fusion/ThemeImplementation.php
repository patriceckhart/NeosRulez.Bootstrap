<?php
namespace NeosRulez\Bootstrap\Fusion;

use Neos\Flow\Annotations as Flow;
use Neos\Fusion\FusionObjects\AbstractFusionObject;

class ThemeImplementation extends AbstractFusionObject {

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
     * @return string
     */
    public function evaluate() {
        $colors = $this->settings['colors'];
        $rounded = $this->settings['enableRounded'];
        $responsiveFonts = $this->settings['enableResponsiveFontSizes'];
        $scss = '';
        foreach($colors as $key=>$data) {
            $scss .= '$'.$key.': '.$data.'; ';
        }
        if($rounded==true) {
            $scss .= '$enable-rounded: true; ';
        } else {
            $scss .= '$enable-rounded: false; ';
        }
        if($responsiveFonts==true) {
            $scss .= '$enable-responsive-font-sizes: true; ';
        } else {
            $scss .= '$enable-responsive-font-sizes: false; ';
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