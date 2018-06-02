<?php

declare(strict_types=1);

namespace Bundle\VisitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Visit
 */
class Visit
{

    /**
     * @var integer
     *
     * @JMSS\Groups({"crud", "api"})
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     *
     * @JMSS\Groups({"crud"})
     * @JMSS\Type("DateTime<'Y-m-d H:i:s'>")
     */
    private $visitStart;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     *
     * @JMSS\Groups({"crud"})
     * @JMSS\Type("DateTime<'Y-m-d H:i:s'>")
     */
    private $visitEnd;

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
     * @var string
     *
     * @JMSS\Groups({"crud"})
     */
    private $uuid;

    /**
     * @var \Bundle\PointofsaleBundle\Entity\Pointofsale
     *
     * @ORM\ManyToOne(targetEntity="Bundle\PointofsaleBundle\Entity\Pointofsale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="point_of_sale_id", referencedColumnName="id", unique=true)
     * })
     *
     * @JMSS\Groups({"crud"})
     */
    private $pointOfSale;

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
    public function getVisitStart()
    {
        return $this->visitStart;
    }

    /**
     * @param \DateTime $visitStart
     */
    public function setVisitStart($visitStart): void
    {

//        //\DateTime
//
//
//        echo "POLLO:: <pre>";
//        print_r($visitStart);
//        exit;


        $this->visitStart = $visitStart;
    }

    /**
     * @return \DateTime
     */
    public function getVisitEnd()
    {
        return $this->visitEnd;
    }

    /**
     * @param \DateTime $visitEnd
     */
    public function setVisitEnd($visitEnd): void
    {
        $this->visitEnd = $visitEnd;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
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
    public function getUpdatedAt()
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
    public function getUserUpdate()
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
     * @return \Bundle\PointofsaleBundle\Entity\Pointofsale
     */
    public function getPointOfSale()
    {
        return $this->pointOfSale;
    }

    /**
     * @param \Bundle\PointofsaleBundle\Entity\Pointofsale $pointOfSale
     */
    public function setPointOfSale(\Bundle\PointofsaleBundle\Entity\Pointofsale $pointOfSale): void
    {
        $this->pointOfSale = $pointOfSale;
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

