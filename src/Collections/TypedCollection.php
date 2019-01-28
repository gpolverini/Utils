<?php

namespace Utils\Collections;

use ArrayAccess;
use Countable;
use Iterator;
use InvalidArgumentException;
use OutOfRangeException;

/**
 * A class to hold a collection of objects of  the same type.
 *
 * There are tow purposes:
 * - to ensure that all elements are of the same type
 * - to be enumerable by the foreach loop
 */
abstract class TypedCollection implements Countable, Iterator, ArrayAccess
{
    /**
     * The array that contains collection elements
     * @var array
     */
    protected $innerArray = array();

    /**
     * The collection type
     * @var \ReflectionClass
     */
    protected $type;

    /**
     * Child classes pass the collection type to this constructor
     *
     * @param string $typeName The name of the underlying class
     * @throws /InvalidArgumentException If the class can't be found by reflection
     */
    public function __construct($typeName)
    {
        if (!class_exists($typeName)) {
            throw new InvalidArgumentException("The class $typeName does not exist.");
        }
        $this->type = new \ReflectionClass($typeName);
    }

    /* Implement Countable */

    /**
     * Returns the count of the elements in the collection
     * @return int
     */
    public function count()
    {
        return count($this->innerArray);
    }

    /* Implement Iterator */

    /**
     * Returns the current element of the collection
     * @return Object
     */
    public function current()
    {
        return current($this->innerArray);
    }

    /**
     * Return the key of the current element
     * @return int
     */
    public function key()
    {
        return key($this->innerArray);
    }

    /**
     * Move forward to next element
     */
    public function next()
    {
        next($this->innerArray);
    }

    /**
     * Rewind to its first element
     */
    public function rewind()
    {
        reset($this->innerArray);
    }

    /**
     * Checks if the current position is valid
     * @return bool
     */
    public function valid()
    {
        return $this->current() !== false;
    }

    /* Implement ArrayAccess */

    /**
     * Whether an offset exists
     * @param int $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->innerArray[$offset]);
    }

    /**
     * Returns the value at the specified offset
     * @param int $offset
     * @return int
     */
    public function offsetGet($offset)
    {
        if (isset($this->innerArray[$offset])) {
            return $this->innerArray[$offset];
        }

        return null;
    }

    /**
     * Assigns a value to the specified offset
     * @param int $offset
     * @param mixed $object
     * @throws InvalidArgumentException If $object is not of the underlying type
     */
    public function offsetSet($offset, $object)
    {
        if (!($object instanceof $this->type->name)) {
            throw new InvalidArgumentException("Object needs to be a $this->type->name instance.");
        }

        if (is_null($offset)) {
            $this->innerArray[] = $object;
            return;
        }

        $this->innerArray[$offset] = $object;
    }

    /**
     * Unsets an offset
     * @param int $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->innerArray[$offset]);
        $this->innerArray = array_values($this->innerArray);
    }

    /* TypedCollection functions */

    /**
     * Adds an object to the collection.
     * @param mixed $object The object to add to the collection
     */
    public function add($object)
    {
        $this->offsetSet(null, $object);
    }

    /**
     * Removes all elements from the collection
     */
    public function clear()
    {
        $this->innerArray = array();
    }

    /**
     * Checks if an object belongs to the collection
     * @param mixed $object
     * @return bool
     */
    public function contains($object)
    {
        return in_array($object, $this->innerArray, true);
    }

    /**
     * Return an object index
     * @param mixed $object
     * @return int
     */
    public function indexOf($object)
    {
        return array_search($object, $this->innerArray);
    }

    /**
     * Inserts an object at the specified offset in the collection
     * @param int $offset
     * @param mixed $object
     * @throws InvalidArgumentException If the object is not of the underlying type
     * @throws OutOfRangeException If the offset does not exist
     */
    public function insert($offset, $object)
    {
        if (!array_key_exists($offset, $this->innerArray)) {
            throw new OutOfRangeException("The index $offset does not exist in the collection.");
        }

        if (!($object instanceof $this->type->name)) {
            throw new InvalidArgumentException("Object needs to be a $this->type->name instance.");
        }

        $tempArray = array($object, $this->offsetGet($offset));
        array_splice($this->innerArray, $offset, 1, $tempArray);
        $this->innerArray = array_values($this->innerArray);
    }

    /**
     * Removes the specified object from the collection
     * @param mixed $object
     */
    public function remove($object)
    {
        if ($this->contains($object)) {
            $this->offsetUnset(array_search($object, $this->innerArray));
            $this->innerArray = array_values($this->innerArray);
        }
    }

    /**
     * Removes the object at the specified offset in the collection
     * @param int $offset
     */
    public function removeAt($offset)
    {
        $this->offsetUnset($offset);
        $this->innerArray = array_values($this->innerArray);
    }

    /**
     * Return collection
     */
    public function toArray()
    {
        return $this->innerArray;
    }
}
