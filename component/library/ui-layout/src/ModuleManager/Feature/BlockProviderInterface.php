<?php

namespace WellCart\Ui\Layout\ModuleManager\Feature;

/**
 * @package WellCart\Ui\Layout

 */
interface BlockProviderInterface
{
    /**
     * retrieve block config
     *
     * @return array
     */
    public function getBlockConfig();
}
