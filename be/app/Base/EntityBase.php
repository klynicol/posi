<?php
namespace App\Base;

/**
 * Base class for all entities.
 */
abstract class EntityBase
{
    /**
     * Create a new entity instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct($attributes = [])
    {
        $this->fill($attributes);
    }

    /**
     * Fill the entity with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function fill($attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Convert the entity to its array representation.
     *
     * @return array
     */
    protected function toArray()
    {
        return get_object_vars($this);
    }
}