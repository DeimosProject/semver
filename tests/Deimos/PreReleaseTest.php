<?php

namespace Deimos;

class PreReleaseTest extends \PHPUnit_Framework_TestCase
{

    public function testGetValue()
    {
        $this->assertEquals(PreRelease::getValue('beta'), PreRelease::BETA);

        $this->assertEquals(PreRelease::getValue('alpha'), PreRelease::ALPHA);
        $this->assertEquals(PreRelease::getValue('Alpha'), PreRelease::ALPHA);

        $this->assertEquals(PreRelease::getValue('rc'), PreRelease::RELEASE_CANDIDATE);
        $this->assertEquals(PreRelease::getValue('release-candidate'), PreRelease::RELEASE_CANDIDATE);

        $this->assertEquals(PreRelease::getValue('gm'), PreRelease::GOLD_MASTER);
        $this->assertEquals(PreRelease::getValue('gold-master'), PreRelease::GOLD_MASTER);

        $this->assertEquals(PreRelease::getValue('dev'), PreRelease::DEV);

        $this->assertEquals(PreRelease::getValue('undef'), PreRelease::STABLE); // default
    }

}