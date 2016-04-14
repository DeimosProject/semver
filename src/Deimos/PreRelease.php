<?php

namespace Deimos;

class PreRelease
{

    const GOLD_MASTER = 4;
    const RELEASE_CANDIDATE = 3; // rc
    
    const ALPHA = 1;
    const BETA = 2;
    const DEV = 0;
    
    const STABLE = 9;

    /**
     * @param $string
     * @return int
     */
    public static function getValue($string)
    {

        $string = mb_strtolower($string);

        switch ($string) {

            case 'dev':
                return self::DEV;

            case 'rc':
            case 'release-candidate':
                return self::RELEASE_CANDIDATE;

            case 'gm':
            case 'gold-master':
                return self::GOLD_MASTER;

            case 'alpha':
                return self::ALPHA;

            case 'beta':
                return self::BETA;

            case 'stable':
            default:
                return self::STABLE;

        }

    }

}