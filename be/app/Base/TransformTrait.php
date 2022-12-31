<?php
namespace App\Base;

trait TransformTrait
{
    /**
     * Take the FIRST key value pair and transform into the standard code description format.
     * Gernally used before the frontend would have to use it.
     *
     * @param array $array
     * @return array
     */
    public static function t_firstCodeDesc($array)
    {
        return [
            'code' => key($array),
            'description' => current($array)
        ];
    }
}
