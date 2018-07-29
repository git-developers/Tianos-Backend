<?php

declare(strict_types=1);

namespace Bundle\FacultadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * Facultad
 */
class Facultad
{

    /**
     * @var integer
     *
     * @JMSS\Groups({
     *     "crud",
     *     "associative-academic"
     * })
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     *
     * @JMSS\Groups({"crud"})
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @JMSS\Groups({"crud"})
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $userCreate;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $userUpdate;

    /**
     * @var boolean
     */
    private $isActive = '1';

    /**
     * @var string
     *
     * @JMSS\Accessor(getter="getNameBox", setter="setNameBox")
     * @JMSS\Groups({
     *     "associative-academic"
     * })
     */
    private $nameBox;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Bundle\AreaacademicaBundle\Entity\Areaacademica", mappedBy="facultad")
     */
    private $areaacademica;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Bundle\EscuelaBundle\Entity\Escuela", inversedBy="facultad")
     * @ORM\JoinTable(name="facultad_has_escuela",
     *   joinColumns={
     *     @ORM\JoinColumn(name="facultad_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="escuela_id", referencedColumnName="id")
     *   }
     * )
     * @JMSS\Groups({
     *     "associative-academic"
     * })
     */
    private $escuela;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->areaacademica = new \Doctrine\Common\Collections\ArrayCollection();
        $this->escuela = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Facultad
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Facultad
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Facultad
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Facultad
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set userCreate
     *
     * @param integer $userCreate
     *
     * @return Facultad
     */
    public function setUserCreate($userCreate)
    {
        $this->userCreate = $userCreate;

        return $this;
    }

    /**
     * Get userCreate
     *
     * @return integer
     */
    public function getUserCreate()
    {
        return $this->userCreate;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Facultad
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set userUpdate
     *
     * @param integer $userUpdate
     *
     * @return Facultad
     */
    public function setUserUpdate($userUpdate)
    {
        $this->userUpdate = $userUpdate;

        return $this;
    }

    /**
     * Get userUpdate
     *
     * @return integer
     */
    public function getUserUpdate()
    {
        return $this->userUpdate;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Facultad
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     *
     * @return string
     */
    public function getNameBox()
    {
        return $this->name;
    }

    /**
     * @param string $nameBox
     */
    public function setNameBox($nameBox)
    {
        $this->nameBox = $nameBox;
    }


    /**
     * Add areaacademica
     *
     * @param \Bundle\AreaacademicaBundle\Entity\Areaacademica $areaacademica
     *
     * @return Facultad
     */
    public function addAreaacademica(\Bundle\AreaacademicaBundle\Entity\Areaacademica $areaacademica)
    {
        $this->areaacademica[] = $areaacademica;

        return $this;
    }

    /**
     * Remove areaacademica
     *
     * @param \Bundle\AreaacademicaBundle\Entity\Areaacademica $areaacademica
     */
    public function removeAreaacademica(\Bundle\AreaacademicaBundle\Entity\Areaacademica $areaacademica)
    {
        $this->areaacademica->removeElement($areaacademica);
    }

    /**
     * Get areaacademica
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAreaacademica()
    {
        return $this->areaacademica;
    }

    /**
     * Add escuela
     *
     * @param \Bundle\EscuelaBundle\Entity\Escuela $escuela
     *
     * @return Facultad
     */
    public function addEscuela(\Bundle\EscuelaBundle\Entity\Escuela $escuela)
    {
        $this->escuela[] = $escuela;

        return $this;
    }

    /**
     * Remove escuela
     *
     * @param \Bundle\EscuelaBundle\Entity\Escuela $escuela
     */
    public function removeEscuela(\Bundle\EscuelaBundle\Entity\Escuela $escuela)
    {
        $this->escuela->removeElement($escuela);
    }

    /**
     * Get escuela
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEscuela()
    {
        return $this->escuela;
    }
}

