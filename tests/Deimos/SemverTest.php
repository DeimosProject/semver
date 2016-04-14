<?php

namespace Deimos;

class SemverTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerSmv
     */
    public function testSmv($string, $major, $minor, $patch, $preRelease, $build, $metadata)
    {
        $sv = new Semver($string);
        $this->assertEquals($sv->getMajor(), $major);
        $this->assertEquals($sv->getMinor(), $minor);
        $this->assertEquals($sv->getPatch(), $patch);
        $this->assertEquals($sv->getBuild(), $build);
        $this->assertEquals($sv->getPreRelease(), $preRelease);
        $this->assertEquals($sv->getMetadata(), $metadata);
    }

    public function providerSmv()
    {
        return array(
            array('1', 1, 0, 0, PreRelease::Stable, 0, null),
            array('1.1', 1, 1, 0, PreRelease::Stable, 0, null),
            array('1.1.1', 1, 1, 1, PreRelease::Stable, 0, null),

            array('1-alpha.1', 1, 0, 0, PreRelease::Alpha, 1, null),
            array('1-alpha', 1, 0, 0, PreRelease::Alpha, 0, null),
            array('1-rc', 1, 0, 0, PreRelease::ReleaseCandidate, 0, null),
            array('1-rc+hello-world', 1, 0, 0, PreRelease::ReleaseCandidate, 0, 'hello-world'),

            array('1.1-alpha.1', 1, 1, 0, PreRelease::Alpha, 1, null),
            array('888345.111.123-alpha', 888345, 111, 123, PreRelease::Alpha, 0, null),
            array('1.0.1-beta+pre-release', 1, 0, 1, PreRelease::Beta, 0, 'pre-release'),
            array('1.0.1-rc.88+hello-world', 1, 0, 1, PreRelease::ReleaseCandidate, 88, 'hello-world'),
        );
    }

    /**
     * @dataProvider providerSmvCompare
     */
    public function testSmvCompare($s1, $s2, $g, $l, $e)
    {
        $s1 = new Semver($s1);
        $s2 = new Semver($s2);

        $this->assertTrue(($s1 > $s2) === $g);
        $this->assertTrue(($s1 < $s2) === $l);
        $this->assertTrue(($s1 == $s2) === $e);

        $this->assertTrue(($s1 >= $s2) === ($g || $e));
        $this->assertTrue(($s1 <= $s2) === ($l || $e));
    }

    public function providerSmvCompare()
    {
        return array(
            array('1.0.0', '1.0.1', false, true, false),
            array('1.0.1-rc', '1.0.1', false, true, false),

            array('1.0.0-rc.1', '1-rc.2', false, true, false),
            array('1.0.1-beta.1', '1.0.1-alpha.16', true, false, false),

            array('1.0.0-rc.1', '1-rc.1', false, false, true),
            array('1-beta.16', '1-alpha.16', true, false, false),

            array('1-beta.16+hello', '1-alpha.16+world', true, false, false),

            array('1.999.113123-beta.16+hello', '1.999.113123-rc+world', false, true, false),
        );
    }

}
