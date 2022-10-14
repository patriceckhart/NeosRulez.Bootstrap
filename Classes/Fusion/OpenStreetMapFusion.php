<?php
namespace NeosRulez\Bootstrap\Fusion;

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Neos\Fusion\FusionObjects\AbstractFusionObject;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class OpenStreetMapFusion extends AbstractFusionObject
{

    /**
     * @return mixed
     */
    public function evaluate()
    {
        $address = $this->fusionValue('address');
        $zip = $this->fusionValue('zip');
        $city = $this->fusionValue('city');
        $country = $this->fusionValue('country');
        $string = false;

        if($address && $zip && $city && $country) {
            $wayFromOSMData = $this->getWayFromOSMData($address, $zip, $city, $country);
            $string = 'https://www.openstreetmap.org/export/embed.html?bbox=' . $wayFromOSMData['boundingbox'][2] . '%2C' . $wayFromOSMData['boundingbox'][0] . '%2C' . $wayFromOSMData['boundingbox'][3] . '%2C' . $wayFromOSMData['boundingbox'][1] . '&amp;layer=mapnik&amp;marker=' . $wayFromOSMData['lat'] . '%2C' . $wayFromOSMData['lon'];
        }

        return $string;
    }

    /**
     * @param string $address
     * @param string $zip
     * @param string $city
     * @param string $country
     * @return array
     */
    private function getWayFromOSMData(string $address, string $zip, string $city, string $country):array
    {
        $osmData = $this->fetchOSMData($address, $zip, $city, $country);
        $result = [];
        if(!empty($osmData)) {
            foreach ($osmData as $osmDataItem) {
                if($osmDataItem['osm_type'] == 'way') {
                    $result = $osmDataItem;
                    break;
                }
            }
        }
        return $result;
    }

    /**
     * @param string $address
     * @param string $zip
     * @param string $city
     * @param string $country
     * @return array
     */
    private function fetchOSMData(string $address, string $zip, string $city, string $country):array
    {
        $client = new Client();
        $request = new Request('GET', 'https://nominatim.openstreetmap.org/search?street=' . $this->paramReplacement($address) . '&city=' . $this->paramReplacement($city) . '&country=' . $this->paramReplacement($country) . '&postalcode=' . $this->paramReplacement($zip) . '&format=json');
        $res = $client->sendAsync($request)->wait();
        return json_decode($res->getBody(), true);
    }

    /**
     * @param string $string
     * @return string
     */
    private function paramReplacement(string $string):string
    {
        return str_replace(' ', '+', $string);
    }

}
