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
        $style_file = 'resource://NeosRulez.Bootstrap/Private/Styles/styles.scss';
        $theme_file = 'resource://NeosRulez.Bootstrap/Private/Styles/theme.scss';
        $theme_file_1 = file_get_contents($theme_file);
        if($theme_file_1!=$scss) {
            file_put_contents($theme_file, $scss);
            $style_file_content = file_get_contents($style_file);
            file_put_contents($style_file, $style_file_content);
        }
        return '';
    }
}