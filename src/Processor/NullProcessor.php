<?php

namespace Pixelfederation\ConfigurationHandler\Processor;

use Pixelfederation\ConfigurationHandler\Processor\Common\ProcessorInterface;

/**
 * Class NullProcessor
 * @package Pixelfederation\ConfigurationHandler\Processor\Factory
 */
final class NullProcessor extends AbstractProcessor implements ProcessorInterface
{
    /**
     * Process Given Configuration
     *
     * @return void
     */
    public function processConfiguration()
    {
        // NULL do nothing ;)
    }

    /**
     * Load Values From Dist File
     *
     * @param string $filePath
     *
     * @return array
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function getParametersFromFile($filePath)
    {
        //
    }
}
