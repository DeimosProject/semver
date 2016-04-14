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
     * @var string
     */
    private $value;

    /**
     * PreRelease constructor.
     * @param $string
     */
    public function __construct($string)
    {
        $this->value = $string;
    }

    /**
     * @return string
     */
    public function __toString()
    {

        $string = mb_strtolower($this->value);

        switch ($string) {

            case 'dev':
                return (string)self::DEV;

            case 'rc':
            case 'release-candidate':
                return (string)self::RELEASE_CANDIDATE;

            case 'gm':
            case 'gold-master':
                return (string)self::GOLD_MASTER;

            case 'alpha':
                return (string)self::ALPHA;

            case 'beta':
                return (string)self::BETA;

            case 'stable':
            default:
                return (string)self::STABLE;

        }

    }

}