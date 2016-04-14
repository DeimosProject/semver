<?php

namespace Deimos;

class Comparator
{

    /**
     * @param Semver $semver1
     * @param Semver $semver2
     * @return bool
     */
    public static function greaterThan(Semver $semver1, Semver $semver2)
    {
        return (string)$semver1 > $semver2;
    }

    /**
     * @param Semver $semver1
     * @param Semver $semver2
     * @return bool
     */
    public static function greaterThanOrEqualTo(Semver $semver1, Semver $semver2)
    {
        return (string)$semver1 >= $semver2;
    }

    /**
     * @param Semver $semver1
     * @param Semver $semver2
     * @return bool
     */
    public static function lessThan(Semver $semver1, Semver $semver2)
    {
        return (string)$semver1 < $semver2;
    }

    /**
     * @param Semver $semver1
     * @param Semver $semver2
     * @return bool
     */
    public static function lessThanOrEqualTo(Semver $semver1, Semver $semver2)
    {
        return (string)$semver1 <= $semver2;
    }

    /**
     * @param Semver $semver1
     * @param Semver $semver2
     * @return bool
     */
    public static function equalTo(Semver $semver1, Semver $semver2)
    {
        return (string)$semver1 == $semver2;
    }

    /**
     * @param Semver $semver1
     * @param Semver $semver2
     * @return bool
     */
    public static function notEqualTo(Semver $semver1, Semver $semver2)
    {
        return (string)$semver1 != $semver2;
    }
    
}