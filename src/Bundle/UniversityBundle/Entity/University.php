<?php

declare(strict_types=1);

namespace Bundle\UniversityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * University
 */
class University
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
     */
    private $abbreviation;

    /**
     * @var string
     *
     * @JMSS\Groups({
     *     "crud"
     * })
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
     * @ORM\ManyToMany(targetEntity="Bundle\AreaacademicaBundle\Entity\Areaacademica", inversedBy="university")
     * @ORM\JoinTable(name="university_has_areaacademica",
     *   joinColumns={
     *     @ORM\JoinColumn(name="university_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="areaacademica_id", referencedColumnName="id")
     *   }
     * )
     * @JMSS\Groups({
     *     "associative-academic"
     * })
     */
    private $areaacademica;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->areaacademica = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return sprintf('%s - %s', $this->id, $this->name);
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
     * @return University
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
     * @return string
     */
    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    /**
     * @param string $abbreviation
     */
    public function setAbbreviation(string $abbreviation)
    {
        $this->abbreviation = $abbreviation;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return University
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
     * @return University
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
     * @return University
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
     * @return University
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
     * @return University
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
     * @return University
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
     * @return University
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
     * @return University
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
}

