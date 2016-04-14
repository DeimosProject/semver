<?php

namespace Deimos;

class Match
{

    /**
     * @var array
     */
    protected $value = array();

    /**
     * Match constructor.
     * @param $regexp string
     * @param $string string
     */
    public function __construct($regexp, $string)
    {
        preg_match($regexp, $string, $this->value);
    }

    /**
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function current()
    {
        if (count($this->value))
            return current($this->value);
        throw new \InvalidArgumentException;
    }

    /**
     * @param $ind
     * @param null $default
     * @return mixed
     */
    public function get($ind, $default = null)
    {
        if (!empty($this->value[$ind]))
            return $this->value[$ind];
        return $default;
    }

    /**
     * @return array
     */
    public function getValue()
    {
        return $this->value;
    }

}