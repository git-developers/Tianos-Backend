<?php

declare(strict_types=1);

namespace Bundle\ReportpointofsaleandproductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * Reportpointofsaleandproduct
 */
class Reportpointofsaleandproduct
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
     * @var \DateTime
     *
     */
    private $timeDelivery;

    /**
     * @var integer
     *
     */
    private $stockOut;

//    /**
//     * @var \AppBundle\Entity\PointOfSaleHasProduct
//     *
//     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PointOfSaleHasProduct")
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="point_of_sale_has_product_id", referencedColumnName="id")
//     * })
//     */
//    private $pointOfSaleHasProduct;


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
     * @return Reportpointofsaleandproduct
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
     * @return Reportpointofsaleandproduct
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Reportpointofsaleandproduct
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
     * @return Reportpointofsaleandproduct
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
     * @return Reportpointofsaleandproduct
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
     * @return Reportpointofsaleandproduct
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
     * @return Reportpointofsaleandproduct
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
     * Set timeDelivery
     *
     * @param \DateTime $timeDelivery
     *
     * @return ReportPointofsaleAndProduct
     */
    public function setTimeDelivery($timeDelivery)
    {
        $this->timeDelivery = $timeDelivery;

        return $this;
    }

    /**
     * Get timeDelivery
     *
     * @return \DateTime
     */
    public function getTimeDelivery()
    {
        return $this->timeDelivery;
    }

    /**
     * Set stockOut
     *
     * @param integer $stockOut
     *
     * @return ReportPointofsaleAndProduct
     */
    public function setStockOut($stockOut)
    {
        $this->stockOut = $stockOut;

        return $this;
    }

//    /**
//     * Get stockOut
//     *
//     * @return integer
//     */
//    public function getStockOut()
//    {
//        return $this->stockOut;
//    }
//
//    /**
//     * Set pointOfSaleHasProduct
//     *
//     * @param \AppBundle\Entity\PointOfSaleHasProduct $pointOfSaleHasProduct
//     *
//     * @return ReportPointOfSaleAndProduct
//     */
//    public function setPointOfSaleHasProduct(\AppBundle\Entity\PointOfSaleHasProduct $pointOfSaleHasProduct = null)
//    {
//        $this->pointOfSaleHasProduct = $pointOfSaleHasProduct;
//
//        return $this;
//    }
//
//    /**
//     * Get pointOfSaleHasProduct
//     *
//     * @return \AppBundle\Entity\PointOfSaleHasProduct
//     */
//    public function getPointOfSaleHasProduct()
//    {
//        return $this->pointOfSaleHasProduct;
//    }
}

