<?php
namespace NeosRulez\Bootstrap\DataSource;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\PersistenceManagerInterface;
use Neos\Utility\TypeHandling;
use Neos\Neos\Service\DataSource\AbstractDataSource;
use Neos\ContentRepository\Domain\Model\NodeInterface;
use Symfony\Component\Yaml\Yaml;

class CountryDataSource extends AbstractDataSource {

    /**
     * @var string
     */
    protected static $identifier = 'neosrulez-bootstrap-countries';

    /**
     * @inheritDoc
     */
    public function getData(NodeInterface $node = null, array $arguments = array()) {
        $options = [];
        $metadata = $this->loadMetaData();
        if($metadata) {
            foreach ($metadata as $i => $option) {
                $options[] = [
                    'label' => $option['label'],
                    'value' => $i,
                ];
            }
        }
        return $options;
    }

    function loadMetaData() {
        $fileName = sprintf('resource://NeosRulez.Bootstrap/Private/Metadata/countries.yml');
        return (array) Yaml::parseFile($fileName);
    }

}
