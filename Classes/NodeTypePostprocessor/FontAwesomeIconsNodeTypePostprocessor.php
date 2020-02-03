<?php
namespace NeosRulez\Bootstrap\NodeTypePostprocessor;

use Neos\Flow\Annotations as Flow;
use Composer\Semver\Comparator;
use Neos\ContentRepository\Domain\Model\NodeType;
use Neos\ContentRepository\NodeTypePostprocessor\NodeTypePostprocessorInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class FontAwesomeIconsNodeTypePostprocessor
 * @package NeosRulez\Bootstrap\NodeTypePostprocessor
 */
class FontAwesomeIconsNodeTypePostprocessor implements NodeTypePostprocessorInterface
{
    const STYLE_SOLID = 'solid';
    const STYLE_LIGHT = 'light';
    const STYLE_REGULAR = 'regular';
    const STYLE_BRAND = 'brands';

    protected $styleCode = [
        self::STYLE_SOLID => 'fas',
        self::STYLE_LIGHT => 'fal',
        self::STYLE_REGULAR => 'far',
        self::STYLE_BRAND => 'fab'
    ];

    /**
     * @Flow\InjectConfiguration()
     */
    protected $configuration;

    public function process(NodeType $nodeType, array &$configuration, array $options)
    {
        $installedVersion = $this->configuration['fontawesome']['version'] ?? '5.0.0';
        $licence = in_array($this->configuration['fontawesome']['licence'], ['free','pro'], true) ? $this->configuration['fontawesome']['licence'] : 'free';

        $editorOptionValues = [];
        $iconMetaData = $this->loadIconMetaData($licence);

        foreach ($iconMetaData as $name => $data) {
            $lowestChangeVersion = current($data['changes']);
            if (!Comparator::lessThanOrEqualTo($lowestChangeVersion, $installedVersion)) {
                continue;
            }

            foreach ($data['styles'] as $style) {
                $optionKey = $this->getIconCode($style, $name);
                $editorOptionValues[$optionKey] = [
                    'label' => $data['label'],
                    'group' => $style,
                    'icon' => $this->getIconCode($style, $name)
                ];
            }

        }

        foreach ($options['properties'] as $property) {
            $configuration['properties'][$property]['ui']['inspector']['editorOptions']['values'] = $editorOptionValues;
        }
    }

    protected function loadIconMetaData(string $currentLicence) : array
    {
        $fileName = sprintf( 'resource://NeosRulez.Bootstrap/Private/Metadata/icons-%s.yml',  $currentLicence);
        return (array) Yaml::parseFile($fileName);
    }

    protected function getIconCode($style, $name)
    {
        $styleCode = $this->styleCode[$style] ?? $this->styleCode[self::STYLE_SOLID];
        return sprintf('%s fa-%s', $styleCode, $name);
    }
}
