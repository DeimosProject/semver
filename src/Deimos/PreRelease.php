<?php

namespace Deimos;

class PreRelease
{

    const ReleaseCandidate = 3; // rc
    const Alpha = 1;
    const Beta = 2;
    const Dev = 0;
    
    const Production = 9;

    /**
     * @param $string
     * @return int
     */
    public static function getValue($string)
    {

        $string = mb_strtolower($string);

        switch ($string) {

            case 'dev':
                return self::Dev;

            case 'rc':
            case 'release-candidate':
                return self::ReleaseCandidate;

            case 'alpha':
                return self::Alpha;

            case 'beta':
                return self::Beta;

            case 'stable':
            default:
                return self::Production;

        }

    }

}