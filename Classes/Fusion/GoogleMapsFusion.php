<?php
namespace NeosRulez\Bootstrap\Fusion;

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Neos\Fusion\FusionObjects\AbstractFusionObject;

class GoogleMapsFusion extends AbstractFusionObject
{

    /**
     * @return string
     */
    public function evaluate(): string
    {
        $address = $this->fusionValue('address');
        $zip = $this->fusionValue('zip');
        $city = $this->fusionValue('city');
        $country = $this->fusionValue('country');
        $source = $this->fusionValue('source');
        if(!empty($source)) {
            $result = $this->getStringBetween($source, 'src="', '"');
        } else {
            $sendAddress = $address.'+'.$zip.' '.$city.'+'.$country;
            $sendAddress = str_replace(' ', '+', $sendAddress);
            $result = $sendAddress;
        }
        return $result;
    }

    /**
     * @param string $string
     * @param string $start
     * @param string $end
     * @return string
     */
    private function getStringBetween(string $string, string $start, string $end): string
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

}
