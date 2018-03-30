<?php

declare(strict_types=1);

namespace Bundle\VisitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * Visit
 */
class Visit
{

    /**
     * @var integer
     *
     * @JMSS\Groups({"crud"})
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visit_start", type="datetime", nullable=true)
     */
    private $visitStart;

    /**
     * @var string
     *
     */
    private $visitEnd;

    /**
     * @var \DateTime
     *
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
     * @var \Bundle\PointOfSaleBundle\Entity\PointOfSale
     *
     * @ORM\OneToOne(targetEntity="Bundle\PointOfSaleBundle\Entity\PointOfSale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="point_of_sale_id", referencedColumnName="id", unique=true)
     * })
     */
    private $pointOfSale;

    /**
     * @var \Bundle\UserBundle\Entity\User
     *
     * @ORM\OneToOne(targetEntity="Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", unique=true)
     * })
     */
    private $user;



    /**
     * @var boolean
     */
    private $isActive = '1';


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
     * @return \DateTime
     */
    public function getVisitStart(): \DateTime
    {
        return $this->visitStart;
    }

    /**
     * @param \DateTime $visitStart
     */
    public function setVisitStart(\DateTime $visitStart): void
    {
        $this->visitStart = $visitStart;
    }

    /**
     * @return string
     */
    public function getVisitEnd(): string
    {
        return $this->visitEnd;
    }

    /**
     * @param string $visitEnd
     */
    public function setVisitEnd(string $visitEnd): void
    {
        $this->visitEnd = $visitEnd;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getUserCreate(): int
    {
        return $this->userCreate;
    }

    /**
     * @param int $userCreate
     */
    public function setUserCreate(int $userCreate): void
    {
        $this->userCreate = $userCreate;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return int
     */
    public function getUserUpdate(): int
    {
        return $this->userUpdate;
    }

    /**
     * @param int $userUpdate
     */
    public function setUserUpdate(int $userUpdate): void
    {
        $this->userUpdate = $userUpdate;
    }

    /**
     * @return \Bundle\PointOfSaleBundle\Entity\PointOfSale
     */
    public function getPointOfSale(): \Bundle\PointOfSaleBundle\Entity\PointOfSale
    {
        return $this->pointOfSale;
    }

    /**
     * @param \Bundle\PointOfSaleBundle\Entity\PointOfSale $pointOfSale
     */
    public function setPointOfSale(\Bundle\PointOfSaleBundle\Entity\PointOfSale $pointOfSale): void
    {
        $this->pointOfSale = $pointOfSale;
    }

    /**
     * @return \Bundle\UserBundle\Entity\User
     */
    public function getUser(): \Bundle\UserBundle\Entity\User
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


    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }


}

