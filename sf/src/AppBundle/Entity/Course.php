<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Course
 *
 * @ORM\Table(name="ydi_course")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CourseRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Course
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=255, unique=true)
     */
    private $sku;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=18, scale=10, options={"default" = 0})
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", options={"default" = 0})
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="type_id", type="string", length=255, nullable=true)
     */
    private $typeId;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     * @Assert\Image(
     *     maxSize = "5M",
     *     mimeTypes = {
     *         "image/jpeg",
     *         "image/pjpeg",
     *         "image/png",
     *         "image/jpg",
     *         "image/gif",
     *     }
     * )
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="text", nullable=true)
     */
    private $shortDescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime")
     */
    private $modified;

    /**
     * @var CourseOption[]
     *
     *
     * @ORM\OneToMany(
     *      targetEntity="AppBundle\Entity\CourseOption",
     *      mappedBy="course",
     *      orphanRemoval=true,
     *      cascade={"persist", "remove"}
     * )
     */
    private $courseOptions;

    /**
     * @var Role[]
     *
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Role")
     * @ORM\JoinTable(name="ydi_course_role",
     *      joinColumns={@ORM\JoinColumn(name="course_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     */
    private $roles;

    /**
     * @var \Ekino\WordpressBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="\Ekino\WordpressBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="ID", onDelete="SET NULL")
     */
    private $user;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->courseOptions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sku
     *
     * @param string $sku
     *
     * @return Course
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get sku
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Course
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
     * Set price
     *
     * @param string $price
     *
     * @return Course
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Course
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set typeId
     *
     * @param string $typeId
     *
     * @return Course
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Get typeId
     *
     * @return string
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Course
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Course
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
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param $shortDescription
     * @return $this
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Course
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     *
     * @return Course
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }
    /**
     * Pre persist event listener
     *
     * @ORM\PrePersist
     */
    public function beforeSave()
    {
        $this->created = new \DateTime('now', new \DateTimeZone('UTC'));
        $this->modified = new \DateTime('now', new \DateTimeZone('UTC'));
    }

    /**
     * Invoked before the entity is updated.
     *
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->modified = new \DateTime('now', new \DateTimeZone('UTC'));
    }

    /**
     * Add courseOption
     *
     * @param \AppBundle\Entity\CourseOption $courseOption
     * @return $this
     */
    public function addCourseOption(\AppBundle\Entity\CourseOption $courseOption)
    {
        $this->courseOptions[] = $courseOption;

        return $this;
    }

    /**
     * Remove courseOption
     *
     * @param \AppBundle\Entity\CourseOption $courseOption
     */
    public function removeCourseOption(\AppBundle\Entity\CourseOption $courseOption)
    {
        $this->courseOptions->removeElement($courseOption);
    }

    /**
     * Get courseOptions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourseOptions()
    {
        return $this->courseOptions;
    }

    /**
     * Add role
     *
     * @param \AppBundle\Entity\Role $role
     * @return $this
     */
    public function addRole(\AppBundle\Entity\Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \AppBundle\Entity\Role $role
     */
    public function removeRole(\AppBundle\Entity\Role $role)
    {
        $this->roles->removeElement($role);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return \Ekino\WordpressBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \Ekino\WordpressBundle\Entity\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}

