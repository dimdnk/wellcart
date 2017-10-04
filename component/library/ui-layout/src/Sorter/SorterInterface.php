<?php
/**
 * @package
 
 */

namespace WellCart\Ui\Layout\Sorter;

interface SorterInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function sort(array $data);
}
