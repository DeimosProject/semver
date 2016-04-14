<?php

namespace Deimos;

class PreReleaseTest extends \PHPUnit_Framework_TestCase
{

    public function testGetValue()
    {
        
        $pr = new PreRelease('beta');
        $this->assertEquals((string)$pr, (string)PreRelease::BETA);

        $pr = new PreRelease('alpha');
        $this->assertEquals((string)$pr, (string)PreRelease::ALPHA);

        $pr = new PreRelease('Alpha');
        $this->assertEquals((string)$pr, (string)PreRelease::ALPHA);

        $pr = new PreRelease('rc');
        $this->assertEquals((string)$pr, (string)PreRelease::RELEASE_CANDIDATE);

        $pr = new PreRelease('release-candidate');
        $this->assertEquals((string)$pr, (string)PreRelease::RELEASE_CANDIDATE);

        $pr = new PreRelease('gm');
        $this->assertEquals((string)$pr, (string)PreRelease::GOLD_MASTER);

        $pr = new PreRelease('gold-master');
        $this->assertEquals((string)$pr, (string)PreRelease::GOLD_MASTER);

        $pr = new PreRelease('dev');
        $this->assertEquals((string)$pr, (string)PreRelease::DEV);

        $pr = new PreRelease('undef');
        $this->assertEquals((string)$pr, (string)PreRelease::STABLE); // default
        
    }

}