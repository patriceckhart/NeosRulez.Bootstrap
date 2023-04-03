<?php
namespace NeosRulez\Bootstrap\DataSource;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\PersistenceManagerInterface;
use Neos\Utility\TypeHandling;
use Neos\Neos\Service\DataSource\AbstractDataSource;
use Neos\ContentRepository\Domain\Model\NodeInterface;
use Symfony\Component\Yaml\Yaml;
use Neos\Flow\ResourceManagement\ResourceManager;
use Neos\Cache\Frontend\StringFrontend;

class FontAwesomeDataSource extends AbstractDataSource {

    /**
     * @var string
     */
    protected static $identifier = 'neosrulez-bootstrap-fa';

    /**
     * @Flow\Inject
     * @var ResourceManager
     */
    protected $resourceManager;

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
     * @var StringFrontend
     * @Flow\Inject
     */
    protected $fontAwesomeIconCache;

    /**
     * @inheritDoc
     * @return array
     */
    public function getData(NodeInterface $node = null, array $arguments = array()): array
    {
        $options = [];
        $metadata = $this->loadMetaData();
        $faVersion = $this->getFaVersion();
        if($metadata) {
            foreach ($metadata as $i => $option) {
                if($option['styles'][0] != 'regular') {
                    $iconPrefix = $option['styles'][0] == 'solid' ? 'fas fa-' : 'fab fa-';
                    $previewPath = false;
                    if((float) $faVersion >= 6) {
                        $iconPrefix = $option['styles'][0] == 'solid' ? 'fa-solid fa-' : 'fa-brands fa-';
                        $previewPath = $this->resourceManager->getPublicPackageResourceUriByPath($this->getPublicResourcePath()) . '/fontawesome-' . $this->getLicense() . '-' . $this->getFaVersion() . '-web/svgs/' . ($option['styles'][0] == 'solid' ? 'solid' : 'brands') . '/' . $i . '.svg';
                    }
                    $options[] = [
                        'label' => $option['label'],
                        'value' => $iconPrefix . $i,
                        (float) $faVersion >= 6 ? 'preview' : 'icon' => (float) $faVersion >= 6 ? ($previewPath) : ($iconPrefix . $i),
                        'group' => $option['styles'][0]
                    ];
                }
            }
        }
        return $options;
    }

    /**
     * @return array
     */
    private function loadMetaData(): array
    {
        if ($this->fontAwesomeIconCache->has('icons' )) {
             return json_decode($this->fontAwesomeIconCache->get('icons'), true);
        }

        $fileName = $this->getPublicResourcePath() . '/fontawesome-' . $this->getLicense() . '-' . $this->getFaVersion() . '-web/metadata/icons.yml';
        $icons = (array) Yaml::parseFile($fileName);
        $this->fontAwesomeIconCache->set('icons', json_encode($icons));
        return $icons;
    }

    /**
     * @return string
     */
    private function getFaVersion(): string
    {
        return $this->settings['fontawesome']['version'];
    }

    /**
     * @return string
     */
    private function getPublicResourcePath(): string
    {
        return $this->settings['fontawesome']['publicResourcePath'];
    }

    /**
     * @return string
     */
    private function getLicense(): string
    {
        return array_key_exists('licence', $this->settings['fontawesome']) ? ($this->settings['fontawesome']['licence'] == 'pro' ? 'pro' : 'free') : 'free';
    }

}
