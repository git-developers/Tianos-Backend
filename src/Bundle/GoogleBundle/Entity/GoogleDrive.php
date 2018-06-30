<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * GoogleDrive
 */
class GoogleDrive
{

    const GOOGLE_FOLDER = 'application/vnd.google-apps.folder';

    const MIME_TYPES = [
        'application/vnd.google-apps.audio' => 'file-audio-o',
        'application/vnd.google-apps.document' => 'file-text',
        'application/vnd.google-apps.drawing' => 'object-group',
        'application/vnd.google-apps.file' => '',
        'application/vnd.google-apps.folder' => 'folder',
        'application/vnd.google-apps.form' => '',
        'application/vnd.google-apps.fusiontable' => '',
        'application/vnd.google-apps.map' => '',
        'application/vnd.google-apps.photo' => 'image',
        'image/png' => 'image',
        'image/jpeg' => 'image',
        'image/x-icon' => 'file-image-o',
        'application/vnd.google-apps.presentation' => 'file-powerpoint-o',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'file-powerpoint-o',
        'application/vnd.google-apps.script' => 'code',
        'application/vnd.google-apps.sites' => '',
        'application/vnd.google-apps.spreadsheet' => 'file-excel-o',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'file-excel-o',
        'application/vnd.google-apps.unknown' => 'file-o',
        'application/vnd.google-apps.video' => 'file-video-o',
        'video/mp4' => 'file-video-o',
        'application/gzip' => 'file-zip-o',
        'application/x-rar' => 'file-zip-o',
        'application/x-compressed-tar' => 'file-zip-o',
        'application/pdf' => 'file-pdf-o',
        'application/msword' => 'file-word-o',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'file-word-o',
        'application/vnd.mysql-workbench-model' => 'code',
        'application/x-httpd-php' => 'code',
        'application/sql' => 'code',
        'application/vnd.ms-project' => 'code',
    ];

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
     * @return GoogleDrive
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
     * @return GoogleDrive
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
     * @return GoogleDrive
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
     * @return GoogleDrive
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
     * @return GoogleDrive
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
     * @return GoogleDrive
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
     * @return GoogleDrive
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
     * @return GoogleDrive
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
}

