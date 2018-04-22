<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asset
 *
 * @ORM\Table(name="ydi_asset")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AssetRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Asset
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
     * @ORM\Column(name="uuid", type="string", length=255, unique=true)
     */
    private $uuid;

    /**
     * @var int
     *
     * @ORM\Column(name="state", type="integer", options={"default" = 0})
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="options", type="integer", options={"default" = 0})
     */
    private $options;

    /**
     * @var int
     *
     * @ORM\Column(name="format_option", type="integer", options={"default" = 0})
     */
    private $formatOption;

    /**
     * @var string
     *
     * @ORM\Column(name="uri", type="string", length=255, nullable=true)
     */
    private $uri;

    /**
     * @var string
     *
     * @ORM\Column(name="storage_account_name", type="string", length=255, nullable=true)
     */
    private $storageAccountName;

    /**
     * @var string
     *
     * @ORM\Column(name="alternate_id", type="string", length=255, nullable=true)
     */
    private $alternateId;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set uuid
     *
     * @param string $uuid
     *
     * @return Asset
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
     * Set state
     *
     * @param integer $state
     *
     * @return Asset
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Asset
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
     * Set title
     *
     * @param string $title
     *
     * @return Asset
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Asset
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
     * Set options
     *
     * @param integer $options
     *
     * @return Asset
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options
     *
     * @return int
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set formatOption
     *
     * @param integer $formatOption
     *
     * @return Asset
     */
    public function setFormatOption($formatOption)
    {
        $this->formatOption = $formatOption;

        return $this;
    }

    /**
     * Get formatOption
     *
     * @return int
     */
    public function getFormatOption()
    {
        return $this->formatOption;
    }

    /**
     * Set uri
     *
     * @param string $uri
     *
     * @return Asset
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Get uri
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set storageAccountName
     *
     * @param string $storageAccountName
     *
     * @return Asset
     */
    public function setStorageAccountName($storageAccountName)
    {
        $this->storageAccountName = $storageAccountName;

        return $this;
    }

    /**
     * Get storageAccountName
     *
     * @return string
     */
    public function getStorageAccountName()
    {
        return $this->storageAccountName;
    }

    /**
     * Set alternateId
     *
     * @param string $alternateId
     *
     * @return Asset
     */
    public function setAlternateId($alternateId)
    {
        $this->alternateId = $alternateId;

        return $this;
    }

    /**
     * Get alternateId
     *
     * @return string
     */
    public function getAlternateId()
    {
        return $this->alternateId;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Asset
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
     * @return Asset
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
}

