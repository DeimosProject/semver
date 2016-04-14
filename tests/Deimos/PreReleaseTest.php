<?php

namespace Deimos;

class PreReleaseTest extends \PHPUnit_Framework_TestCase
{

    public function testGetValue()
    {
        $this->assertEquals(PreRelease::getValue('beta'), PreRelease::Beta);

        $this->assertEquals(PreRelease::getValue('alpha'), PreRelease::Alpha);
        $this->assertEquals(PreRelease::getValue('Alpha'), PreRelease::Alpha);

        $this->assertEquals(PreRelease::getValue('rc'), PreRelease::ReleaseCandidate);
        $this->assertEquals(PreRelease::getValue('release-candidate'), PreRelease::ReleaseCandidate);

        $this->assertEquals(PreRelease::getValue('dev'), PreRelease::Dev);

        $this->assertEquals(PreRelease::getValue('undef'), PreRelease::Production); // default
    }

}