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
        $render_file = 'resource://NeosRulez.Bootstrap/Private/Styles/theme.scss';
        if($render_file!=$scss) {
            file_put_contents($render_file, $scss);
        }
        return '';
    }
}