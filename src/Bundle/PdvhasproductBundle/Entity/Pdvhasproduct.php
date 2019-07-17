<?php

declare(strict_types=1);

namespace Bundle\PdvhasproductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * Pdvhasproduct
 */
class Pdvhasproduct
{

    /**
     * @var integer
     *
     * @JMSS\Groups({"crud"})
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
     * @var integer
     *
     * @JMSS\Groups({"crud"})
     */
    private $quantity;

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
     * @var string
     *
     * @JMSS\Groups({"crud"})
     */
    private $uuid;

    /**
     * @var boolean
     */
    private $isActive = '1';

    /**
     * @var \Bundle\PointofsaleBundle\Entity\Pointofsale
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PointOfSale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="point_of_sale_id", referencedColumnName="id")
     * })
     *
     * @JMSS\Groups({"crud"})
     */
    private $pointOfSale;

    /**
     * @var \Bundle\ProductBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     *
     * @JMSS\Groups({"crud"})
     */
    private $product;

    /**
     * @var \Bundle\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", unique=true)
     * })
     *
     * @JMSS\Groups({"crud"})
     */
    private $user;

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
     * @return Pdvhasproduct
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
     * @return Pdvhasproduct
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
     * @return Pdvhasproduct
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
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Pdvhasproduct
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
     * @return Pdvhasproduct
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
     * @return Pdvhasproduct
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
     * @return Pdvhasproduct
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
     * Set uuid
     *
     * @param string $uuid
     *
     * @return Visit
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Pdvhasproduct
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
     * @return PdvHasProduct
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
     * Set product
     *
     * @param \Bundle\ProductBundle\Entity\Product $product
     *
     * @return PdvHasProduct
     */
    public function setProduct(\Bundle\ProductBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Bundle\ProductBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return \Bundle\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \Bundle\UserBundle\Entity\User $user
     */
    public function setUser(\Bundle\UserBundle\Entity\User $user): void
    {
        $this->user = $user;
    }
}

