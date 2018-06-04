<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Asset.
 *
 * @ORM\Table(name="ydi_asset")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AssetRepository")
 * @UniqueEntity(fields={"file"}, message="File with the same name is existed.")
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
     * @var string
     *
     * @ORM\Column(name="encoded_uuid", type="string", length=255, nullable=true)
     */
    private $encodedUuid;

    /**
     * @var int
     *
     * @ORM\Column(name="state", type="integer", options={"default" = 0})
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="job_uuid", type="string", length=255, nullable=true)
     */
    private $jobUuid;

    /**
     * Queued=0|Scheduled=1|Processing=2|Finished=3|Error=4|Canceled=5|Canceling=6
     *
     * @var int
     *
     * @ORM\Column(name="job_state", type="integer", options={"default" = 0})
     */
    private $jobState = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=255, nullable=true, unique=true)
     * @Assert\File(
     *     maxSize = "1024M",
     *     mimeTypes = {
     *         "video/mp4",
     *         "video/quicktime",
     *         "video/x-msvideo",
     *         "video/x-ms-wmv",
     *     },
     *     mimeTypesMessage = "Please upload a valid video"
     * )
     */
    private $file;

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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set uuid.
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
     * Get uuid.
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getEncodedUuid(): string
    {
        return $this->encodedUuid;
    }

    /**
     * @param string $encodedUuid
     */
    public function setEncodedUuid(string $encodedUuid)
    {
        $this->encodedUuid = $encodedUuid;
    }

    /**
     * Set state.
     *
     * @param int $state
     *
     * @return Asset
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state.
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getJobUuid()
    {
        return $this->jobUuid;
    }

    /**
     * @param string $jobUuid
     */
    public function setJobUuid($jobUuid)
    {
        $this->jobUuid = $jobUuid;
    }

    /**
     * @return int
     */
    public function getJobState()
    {
        return $this->jobState;
    }

    /**
     * @param int $jobState
     */
    public function setJobState($jobState)
    {
        $this->jobState = $jobState;
    }

    /**
     * Set name.
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
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set file.
     *
     * @param string $file
     *
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file.
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set title.
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
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description.
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
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set options.
     *
     * @param int $options
     *
     * @return Asset
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options.
     *
     * @return int
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set formatOption.
     *
     * @param int $formatOption
     *
     * @return Asset
     */
    public function setFormatOption($formatOption)
    {
        $this->formatOption = $formatOption;

        return $this;
    }

    /**
     * Get formatOption.
     *
     * @return int
     */
    public function getFormatOption()
    {
        return $this->formatOption;
    }

    /**
     * Set uri.
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
     * Get uri.
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set storageAccountName.
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
     * Get storageAccountName.
     *
     * @return string
     */
    public function getStorageAccountName()
    {
        return $this->storageAccountName;
    }

    /**
     * Set alternateId.
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
     * Get alternateId.
     *
     * @return string
     */
    public function getAlternateId()
    {
        return $this->alternateId;
    }

    /**
     * Set created.
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
     * Get created.
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified.
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
     * Get modified.
     *
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Pre persist event listener.
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
