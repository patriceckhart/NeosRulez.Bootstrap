<?php
namespace NeosRulez\Bootstrap\DataSource;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\PersistenceManagerInterface;
use Neos\Utility\TypeHandling;
use Neos\Neos\Service\DataSource\AbstractDataSource;
use Neos\ContentRepository\Domain\Model\NodeInterface;
use Symfony\Component\Yaml\Yaml;

class FontAwesomeDataSource extends AbstractDataSource {

    /**
     * @var string
     */
    protected static $identifier = 'neosrulez-bootstrap-fa';

    /**
     * @inheritDoc
     */
    public function getData(NodeInterface $node = null, array $arguments = array()) {
        $options = [];
        $metadata = $this->loadMetaData();
        if($metadata) {
            foreach ($metadata as $i => $option) {
                if($option['styles'][0] != 'regular') {
                    $iconPrefix = $option['styles'][0] == 'solid' ? 'fas fa-' : 'fab fa-';
                    $options[] = [
                        'label' => $option['label'],
                        'value' => $iconPrefix . $i,
                        'icon' => $iconPrefix . $i,
                        'group' => $option['styles'][0]
                    ];
                }
            }
        }
        return $options;
    }

    function loadMetaData() {
        $fileName = sprintf('resource://NeosRulez.Bootstrap/Private/Metadata/font-awesome-icons-free.yml');
        return (array) Yaml::parseFile($fileName);
    }

}
