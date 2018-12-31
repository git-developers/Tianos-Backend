<?php

declare(strict_types=1);

namespace Bundle\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * Booking
 */
class Booking
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
     * @var \Date
     *
     * @JMSS\Groups({"crud"})
     * @JMSS\Type("DateTime<'Y-m-d'>")
     */
    private $dateBook;

    /**
     * @var \Time
     *
     * @JMSS\Groups({"crud"})
     * @JMSS\Type("DateTime<'H:i'>")
     */
    private $timeInBook;

    /**
     * @var \Time
     *
     * @JMSS\Groups({"crud"})
     * @JMSS\Type("DateTime<'H:i'>")
     */
    private $timeOutBook;

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
	 * @var \Bundle\UserBundle\Entity\User
	 *
	 * @ORM\ManyToOne(targetEntity="Bundle\UserBundle\Entity\User")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="client_id", referencedColumnName="id")
	 * })
	 *
	 * @JMSS\Groups({"crud"})
	 */
	private $client;
	
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
     * @return Booking
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
     * @return Booking
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
     * @return Booking
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
     * @return Booking
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
	 * @return \Date
	 */
	public function getDateBook() //: \Date
	{
		return $this->dateBook;
	}
	
	/**
	 * @param \Date $dateBook
	 */
	public function setDateBook($dateBook) // \Date
	{
		$this->dateBook = $dateBook;
	}
	
	/**
	 * @return \Time
	 */
	public function getTimeInBook()//: \Time
	{
		return $this->timeInBook;
	}
	
	/**
	 * @param \Time $timeInBook
	 */
	public function setTimeInBook($timeInBook) // \Time
	{
		$this->timeInBook = $timeInBook;
	}
	
	/**
	 * @return \Time
	 */
	public function getTimeOutBook()//: \Time
	{
		return $this->timeOutBook;
	}
	
	/**
	 * @param \Time $timeOutBook
	 */
	public function setTimeOutBook($timeOutBook) // \Time
	{
		$this->timeOutBook = $timeOutBook;
	}

    /**
     * Set userCreate
     *
     * @param integer $userCreate
     *
     * @return Booking
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
     * @return Booking
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
     * @return Booking
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
     * @return Booking
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
	 * Set client
	 *
	 * @param \Bundle\UserBundle\Entity\User $client
	 *
	 * @return Ticket
	 */
	public function setClient(\Bundle\UserBundle\Entity\User $client = null)
	{
		$this->client = $client;
		
		return $this;
	}
	
	/**
	 * Get client
	 *
	 * @return \Bundle\UserBundle\Entity\User
	 */
	public function getClient()
	{
		return $this->client;
	}
}

