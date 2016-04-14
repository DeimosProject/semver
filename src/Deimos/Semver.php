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

        $match = new Match('~(\d+[\w\W]*)~', $string);

        $string = $match->current();
        $string = trim($string);

        $match = new Match('~(\d+)\.*(\d+){0,1}\.*(\d+){0,1}~', $string);

        $this->major = $match->get(1, 0);
        $this->minor = $match->get(2, 0);
        $this->patch = $match->get(3, 0);

        $match = new Match('~(alpha|beta|rc|release-candidate|production|stable)\.*(\d*)~i', $string);

        $this->preRelease = PreRelease::getValue($match->get(1, 'stable'));
        $this->build = $match->get(2, 0);

        $match = new Match('~\+([\w-]+)~i', $string);

        $this->metadata = $match->get(1);

    }

    /**
     * @return mixed
     */
    public function getMajor()
    {
        return $this->major;
    }

    /**
     * @return int
     */
    public function getMinor()
    {
        return $this->minor;
    }

    /**
     * @return int
     */
    public function getPatch()
    {
        return $this->patch;
    }

    /**
     * @return int
     */
    public function getPreRelease()
    {
        return $this->preRelease;
    }

    /**
     * @return int
     */
    public function getBuild()
    {
        return $this->build;
    }

    /**
     * @return mixed
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

        return implode('.', $data);
        
    }

}