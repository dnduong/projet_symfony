<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * rdv
 *
 * @ORM\Table(name="rdv")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\rdvRepository")
 */
class rdv
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="proposant", type="string", length=255)
     */
    private $proposant;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenant", type="string", length=255, nullable=true)
     */
    private $prenant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

     /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, unique=true)
     */
    private $url;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set proposant.
     *
     * @param string $proposant
     *
     * @return rdv
     */
    public function setProposant($proposant)
    {
        $this->proposant = $proposant;

        return $this;
    }

    /**
     * Get proposant.
     *
     * @return string
     */
    public function getProposant()
    {
        return $this->proposant;
    }

    /**
     * Set prenant.
     *
     * @param string|null $prenant
     *
     * @return rdv
     */
    public function setPrenant($prenant = null)
    {
        $this->prenant = $prenant;

        return $this;
    }

    /**
     * Get prenant.
     *
     * @return string|null
     */
    public function getPrenant()
    {
        return $this->prenant;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return rdv
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
