<?php

namespace CoreBundle\Entity;
namespace Bundle\Component\Product\Model;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;


//* @ORM\Entity(repositoryClass="Bundle\Component\Product\Repository\ProductRepository")

/**
 * Product
 *
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"product", "cat_has_prod", "pointofsales_has_product", "category_has_product"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=45, nullable=true)
     * @JMSS\Groups({"product", "cat_has_prod", "pointofsales_has_product", "category_has_product"})
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=true)
     * @JMSS\Groups({"product", "cat_has_prod", "pointofsales_has_product", "category_has_product"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=150, nullable=true)
     * @JMSS\Groups({"product"})
     */
    private $slug;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="image", type="string", length=45, nullable=true)
//     */
//    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     * @JMSS\Groups({"product"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive = '1';

//    /**
//     * @var string
//     *
//     * @JMSS\Accessor(getter="getNameBox", setter="setNameBox")
//     * @JMSS\Groups({"product", "pointofsales_has_product", "category_has_product"})
//     */
//    private $nameBox;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getName();
    }

    /**
     * Set idIncrement
     *
     * @param integer $idIncrement
     *
     * @return Product
     */
    public function setIdIncrement($idIncrement)
    {
        $this->idIncrement = $idIncrement;

        return $this;
    }

    /**
     * Get idIncrement
     *
     * @return integer
     */
    public function getIdIncrement()
    {
        return $this->idIncrement;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Category
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
     * @return Product
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
     * @return Product
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

//    /**
//     * Set image
//     *
//     * @param string $image
//     *
//     * @return Product
//     */
//    public function setImage($image)
//    {
//        $this->image = $image;
//
//        return $this;
//    }
//
//    /**
//     * Get image
//     *
//     * @return string
//     */
//    public function getImage()
//    {
//        return $this->image;
//    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Product
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Product
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
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Product
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

//    /**
//     *
//     * @return string
//     */
//    public function getNameBox()
//    {
//        return sprintf('%s', $this->name);
//    }
//
//    /**
//     * @param string $nameBox
//     */
//    public function setNameBox($nameBox)
//    {
//        $this->nameBox = $nameBox;
//    }

}
