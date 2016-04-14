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
            array('v3.14.1592-beta2.+firefox', 3, 14, 1592, PreRelease::Beta, 2, 'firefox'),
            array('v3.14.1592-beta65+firefox', 3, 14, 1592, PreRelease::Beta, 65, 'firefox'),

            array('1', 1, 0, 0, PreRelease::Stable, 0, null),
            array('1.1', 1, 1, 0, PreRelease::Stable, 0, null),
            array('1.1.1', 1, 1, 1, PreRelease::Stable, 0, null),

            array('1-alpha.1', 1, 0, 0, PreRelease::Alpha, 1, null),
            array('1-alpha', 1, 0, 0, PreRelease::Alpha, 0, null),
            array('1-rc', 1, 0, 0, PreRelease::ReleaseCandidate, 0, null),
            array('1-rc+hello-world', 1, 0, 0, PreRelease::ReleaseCandidate, 0, 'hello-world'),

            array('1.1-alpha.1', 1, 1, 0, PreRelease::Alpha, 1, null),
            array('1.1-alpha', 1, 1, 0, PreRelease::Alpha, 0, null),
            array('1.1-rc', 1, 1, 0, PreRelease::ReleaseCandidate, 0, null),
            array('1.1-rc+hello-world', 1, 1, 0, PreRelease::ReleaseCandidate, 0, 'hello-world'),

            array('1.0.1-alpha.1', 1, 0, 1, PreRelease::Alpha, 1, null),
            array('1.0.1-alpha', 1, 0, 1, PreRelease::Alpha, 0, null),
            array('1.0.1-rc', 1, 0, 1, PreRelease::ReleaseCandidate, 0, null),
            array('1.0.1-rc+hello-world', 1, 0, 1, PreRelease::ReleaseCandidate, 0, 'hello-world'),

            array('1.1-alpha.1', 1, 1, 0, PreRelease::Alpha, 1, null),
            array('888345.111.123-alpha', 888345, 111, 123, PreRelease::Alpha, 0, null),
            array('1.0.1-beta+pre-release', 1, 0, 1, PreRelease::Beta, 0, 'pre-release'),
            array('1.0.1-rc.88+hello-world', 1, 0, 1, PreRelease::ReleaseCandidate, 88, 'hello-world'),

            array('1-gm', 1, 0, 0, PreRelease::GoldMaster, 0, null),
            array('1-gm+deimos-project', 1, 0, 0, PreRelease::GoldMaster, 0, 'deimos-project'),

            array('1.1-gm', 1, 1, 0, PreRelease::GoldMaster, 0, null),
            array('1.1-gold-master+deimos-project', 1, 1, 0, PreRelease::GoldMaster, 0, 'deimos-project'),

            array('1.0.1-gm', 1, 0, 1, PreRelease::GoldMaster, 0, null),
            array('1.0.1-gold-master+deimos-project', 1, 0, 1, PreRelease::GoldMaster, 0, 'deimos-project'),

            array('1.0.1-gm.88+deimos-project', 1, 0, 1, PreRelease::GoldMaster, 88, 'deimos-project'),
        );
    }

    /**
     * @dataProvider providerSmvCompare
     */
    public function testSmvCompare($semver1, $semver2, $greater, $less, $equal)
    {
        $semver1 = new Semver($semver1);
        $semver2 = new Semver($semver2);

        $this->assertTrue(Compare::greaterThan($semver1, $semver2) === $greater);
        $this->assertTrue(Compare::lessThan($semver1, $semver2) === $less);
        $this->assertTrue(Compare::equalTo($semver1, $semver2) === $equal);

        $this->assertTrue(Compare::greaterThanOrEqualTo($semver1, $semver2) === ($greater || $equal));
        $this->assertTrue(Compare::lessThanOrEqualTo($semver1, $semver2) === ($less || $equal));
    }

    public function providerSmvCompare()
    {
        return array(
            array('1.0.0', '1.0.1', false, true, false),
            array('1.0.1-rc', '1.0.1', false, true, false),

            array('1.0.0-rc.1', '1-rc.2', false, true, false),
            array('1.0.1-beta.1', '1.0.1-alpha.16', true, false, false),

            array('1.0.0-rc.1', '1-rc.1', false, false, true),

            array('1.0.0-rc.1', '1-rc1.+gold-master', false, false, true),

            array('1-beta.16', '1-alpha.16', true, false, false),
            array('1-beta16', '1-alpha.16', true, false, false),

            array('1-beta.16+hello', '1-alpha.16+world', true, false, false),

            array('1.999.113123-beta.16+hello', '1.999.113123-rc+world', false, true, false),

            array('v3.14.1592-beta2.+firefox', 'v3.14.1592-beta3.+firefox', false, true, false),
            array('v3.14.1592-beta65+firefox', 'v3.14.1592-beta65+firefox', false, false, true),
        );
    }

}
