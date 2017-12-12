<?php

namespace Pixelfederation\ConfigurationHandler\Processor\Factory;

use Composer\IO\IOInterface;
use Pixelfederation\ConfigurationHandler\Configuration\Factory\ConfigurationFactory;
use Pixelfederation\ConfigurationHandler\Processor\ArrayProcessor;
use Pixelfederation\ConfigurationHandler\Processor\Exception\InvalidProcessorTypeException;
use Pixelfederation\ConfigurationHandler\Processor\Common\ProcessorInterface;
use Pixelfederation\ConfigurationHandler\Processor\NullProcessor;

/**
 * Class ProcessorFactory
 *
 * @package Pixelfederation\ConfigurationHandler
 */
class ProcessorFactory
{
    /**
     * Composer Input IO
     *
     * @var IOInterface
     */
    private $composerIo;

    /**
     * Configuration Factory
     *
     * @var ConfigurationFactory
     */
    private $configurationFactory;

    /**
     * ProcessorFactory constructor.
     *
     * @param IOInterface $composerIo
     * @param ConfigurationFactory $configurationFactory
     */
    public function __construct(IOInterface $composerIo, ConfigurationFactory $configurationFactory)
    {
        $this->composerIo = $composerIo;
        $this->configurationFactory = $configurationFactory;
    }

    /**
     * Get Configuration Parameters Processor
     *
     * @param array $configuration
     *
     * @return ProcessorInterface
     *
     * @throws \Pixelfederation\ConfigurationHandler\Processor\Exception\InvalidProcessorTypeException
     */
    public function getProcessor(array $configuration)
    {
        $parsedConfiguration = $this->configurationFactory->buildConfiguration($configuration);

        switch ($parsedConfiguration->getProcessor()) {
            case ProcessorInterface::PROCESSOR_TYPE_ARRAY:
                return new ArrayProcessor($this->composerIo, $parsedConfiguration);
            case ProcessorInterface::PROCESSOR_TYPE_NULL:
                return new NullProcessor($this->composerIo, $parsedConfiguration);
            default:
                throw new InvalidProcessorTypeException(
                    "Given Processor type {$parsedConfiguration->getProcessor()} is not supported."
                );
        }
    }
}
