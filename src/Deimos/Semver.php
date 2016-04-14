<?php

namespace Deimos;

class Semver
{

    /**
     * @var string
     */
    protected $major;

    /**
     * @var string
     */
    protected $minor;

    /**
     * @var string
     */
    protected $patch;

    /**
     * @var int
     */
    protected $preRelease;

    /**
     * @var string
     */
    protected $build;

    /**
     * @var string
     */
    protected $metadata = null;

    /**
     * Semver constructor.
     * @param $string string
     */
    public function __construct($string)
    {

        // ltrim for string
        $match = new Match('~(\d+[\w\W]*)~', $string);

        // ->get(0)
        $string = $match->current();
        $string = trim($string); // remove spaces

        // get(major, minor, patch)
        $match = new Match('~(\d+)\.*(\d*)\.*(\d*)~', $string);

        $this->major = $match->get(1, 0);
        $this->minor = $match->get(2, 0);
        $this->patch = $match->get(3, 0);

        // preRelease
        $match = new Match('~(alpha|beta|rc|release-candidate|production|stable|gm|gold-master)\.*(\d*)~i', $string);

        $preRelease = new PreRelease($match->get(1, 'stable'));

        $this->preRelease = (string)$preRelease;
        $this->build = $match->get(2, 0);

        // get metadata
        $match = new Match('~\+([\w-]+)~i', $string);

        $this->metadata = $match->get(1);

    }

    /**
     * @return string
     */
    public function getMajor()
    {
        return $this->major;
    }

    /**
     * @return string
     */
    public function getMinor()
    {
        return $this->minor;
    }

    /**
     * @return string
     */
    public function getPatch()
    {
        return $this->patch;
    }

    /**
     * @return string
     */
    public function getPreRelease()
    {
        return $this->preRelease;
    }

    /**
     * @return string
     */
    public function getBuild()
    {
        return $this->build;
    }

    /**
     * @return string
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @return string
     */
    public function __toString()
    {

        $data = array(
            $this->getMajor(),
            $this->getMinor(),
            $this->getPatch(),
            $this->getPreRelease(),
            $this->getBuild()
        );

        $data = implode('.', $data);

        return $data;

    }

}