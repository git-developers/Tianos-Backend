<?php

declare(strict_types=1);

namespace Bundle\PointofsaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Pointofsale
 *
 * @UniqueEntity(
 *     fields={"slug"},
 *     message="El slug fue registrado anteriormente"
 * )
 *
 * @UniqueEntity(
 *     fields={"code"},
 *     message="El codigo fue registrado anteriormente"
 * )
 */
class Pointofsale
{

    /**
     * @var integer
     *
     * @JMSS\Groups({
     *     "api",
     *     "crud",
     *     "one-to-many-left",
     *     "one-to-many-right",
     *     "one-to-many-search",
     *     "order-in-left",
     *     "one-to-many-search-userhaspointofsale",
     *     "one-to-many-left-userhaspointofsale",
     *     "order-report"
     * })
     */
    private $id;

    /**
     * @var string
     *
     * @JMSS\Groups({"api", "crud", "one-to-many-right"})
     */
    private $code;

    /**
     * @var string
     *
     * @JMSS\Groups({"api", "crud"})
     */
    private $name;

    /**
     * @var string
     *
     */
    private $slug;

    /**
     * @var string
     *
     * @JMSS\Groups({"api", "crud"})
     */
    private $latitude;

    /**
     * @var string
     *
     * @JMSS\Groups({"api", "crud"})
     */
    private $longitude;

    /**
     * @var string
     *
     */
    private $description;

    /**
     * @var string
     *
     * @JMSS\Groups({"crud"})
     */
    private $address;

    /**
     * @var string
     *
     */
    private $phone;

    /**
     * @var \DateTime
     *
     * @JMSS\Groups({"crud"})
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     */
    private $createdAt;

    /**
     * @var integer
     *
     */
    private $userCreate;

    /**
     * @var \DateTime
     *
     */
    private $updatedAt;

    /**
     * @var integer
     *
     */
    private $userUpdate;

    /**
     * @var boolean
     *
     */
    private $isActive = '1';

    /**
     * @var \Bundle\PointofsaleBundle\Entity\Pointofsale
     *
     * @ORM\ManyToOne(targetEntity="Bundle\PointofsaleBundle\Entity\Pointofsale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="point_of_sale_id", referencedColumnName="id")
     * })
     *
     * @JMSS\Groups({"crud"})
     */
    private $pointOfSale;

    private $pointOfSaleChildren;

    /**
     * @var string
     *
     * @JMSS\Accessor(getter="getNameBox", setter="setNameBox")
     * @JMSS\Groups({
     *     "one-to-many-left",
     *     "one-to-many-right",
     *     "order-in-left",
     *     "one-to-many-left-userhaspointofsale",
     *     "order-report"
     * })
     */
    private $nameBox;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Bundle\UserBundle\Entity\User", inversedBy="pointOfSale")
     * @ORM\JoinTable(name="point_of_sale_has_user",
     *   joinColumns={
     *     @ORM\JoinColumn(name="point_of_sale_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   }
     * )
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Bundle\ModuleBundle\Entity\Module", inversedBy="pointOfSale")
     * @ORM\JoinTable(name="point_of_sale_has_module",
     *   joinColumns={
     *     @ORM\JoinColumn(name="point_of_sale_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     *   }
     * )
     */
    private $module;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pointOfSaleChildren = new \Doctrine\Common\Collections\ArrayCollection();
        $this->module = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return sprintf('%s', $this->name);
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
     * @return Pointofsale
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
     * @return PointOfSale
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
     * @return PointOfSale
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
     * Set latitude
     *
     * @param string $latitude
     *
     * @return PointOfSale
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return PointOfSale
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return PointOfSale
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PointOfSale
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
     * @return PointOfSale
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
     * @return PointOfSale
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
     * @return PointOfSale
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
     * @return PointOfSale
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
     * Set pointOfSale
     *
     * @param \Bundle\PointofsaleBundle\Entity\Pointofsale $pointOfSale
     *
     * @return PointOfSale
     */
    public function setPointOfSale(\Bundle\PointofsaleBundle\Entity\Pointofsale $pointOfSale = null)
    {
        $this->pointOfSale = $pointOfSale;

        return $this;
    }

    /**
     * Get pointOfSale
     *
     * @return \Bundle\PointofsaleBundle\Entity\Pointofsale
     */
    public function getPointOfSale()
    {
        return $this->pointOfSale;
    }

    /**
     * Add user
     *
     * @param \Bundle\UserBundle\Entity\User $user
     *
     * @return PointOfSale
     */
    public function addUser(\Bundle\UserBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Bundle\UserBundle\Entity\User $user
     */
    public function removeUser(\Bundle\UserBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add module
     *
     * @param \Bundle\ModuleBundle\Entity\Module $module
     *
     * @return PointOfSale
     */
    public function addModule(\Bundle\ModuleBundle\Entity\Module $module)
    {
        $this->module[] = $module;

        return $this;
    }

    /**
     * Remove module
     *
     * @param \Bundle\ModuleBundle\Entity\Module $module
     */
    public function removeModule(\Bundle\ModuleBundle\Entity\Module $module)
    {
        $this->module->removeElement($module);
    }

    /**
     * Get module
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     *
     * @return string
     */
    public function getNameBox()
    {
        return sprintf('%s', $this->name);
    }

    /**
     * @param string $nameBox
     */
    public function setNameBox($nameBox)
    {
        $this->nameBox = $nameBox;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getPointOfSaleChildren(): array
    {
        return $this->pointOfSaleChildren;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $pointOfSaleChildren
     */
    public function setPointOfSaleChildren(array $pointOfSaleChildren)
    {
        $this->pointOfSaleChildren = $pointOfSaleChildren;
    }

}

