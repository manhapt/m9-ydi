<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class UserDecorator
{
    /**
     * @var \Ekino\WordpressBundle\Model\User
     */
    private $source;

    /**
     * \Ekino\WordpressBundle\Model\User constructor.
     * @param \Ekino\WordpressBundle\Model\User $source
     */
    public function __construct(\Ekino\WordpressBundle\Model\User $source)
    {
        $this->source = $source;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->source->getId();
    }

    /**
     * @param string $activationKey
     *
     * @return \Ekino\WordpressBundle\Model\User
     */
    public function setActivationKey($activationKey)
    {
        return $this->source->setActivationKey($activationKey);
    }

    /**
     * @return string
     */
    public function getActivationKey()
    {
        return $this->source->getActivationKey();
    }

    /**
     * @param string $displayName
     *
     * @return \Ekino\WordpressBundle\Model\User
     */
    public function setDisplayName($displayName)
    {
        return $this->source->setDisplayName($displayName);
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->source->getDisplayName();
    }

    /**
     * @param string $email
     *
     * @return \Ekino\WordpressBundle\Model\User
     */
    public function setEmail($email)
    {
        return $this->source->setEmail($email);
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->source->getEmail();
    }

    /**
     * @param string $login
     *
     * @return \Ekino\WordpressBundle\Model\User
     */
    public function setLogin($login)
    {
        return $this->source->setLogin($login);
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->source->getLogin();
    }

    /**
     * @param string $nicename
     *
     * @return \Ekino\WordpressBundle\Model\User
     */
    public function setNicename($nicename)
    {
        return $this->source->setNicename($nicename);
    }

    /**
     * @return string
     */
    public function getNicename()
    {
        return $this->source->getNicename();
    }

    /**
     * @param string $pass
     *
     * @return \Ekino\WordpressBundle\Model\User
     */
    public function setPass($pass)
    {
        return $this->source->setPass($pass);
    }

    /**
     * @return string
     */
    public function getPass()
    {
        return $this->source->getPass();
    }

    /**
     * @param \DateTime $registered
     *
     * @return \Ekino\WordpressBundle\Model\User
     */
    public function setRegistered($registered)
    {
        return $this->source->setRegistered($registered);
    }

    /**
     * @return \DateTime
     */
    public function getRegistered()
    {
        return $this->source->getRegistered();
    }

    /**
     * @param int $status
     *
     * @return \Ekino\WordpressBundle\Model\User
     */
    public function setStatus($status)
    {
        return $this->source->setStatus($status);
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->source->getStatus();
    }

    /**
     * @param string $url
     *
     * @return \Ekino\WordpressBundle\Model\User
     */
    public function setUrl($url)
    {
        return $this->source->setUrl($url);
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->source->getUrl();
    }

    /**
     * @param ArrayCollection $metas
     *
     * @return \Ekino\WordpressBundle\Model\User
     */
    public function setMetas(ArrayCollection $metas)
    {
        return $this->source->setMetas($metas);
    }

    /**
     * Returns \Ekino\WordpressBundle\Model\User meta value from a meta key name.
     *
     * @param string $name
     *
     * @return string|null
     */
    public function getMetaValue($name)
    {
        return $this->source->getMetaValue($name);
    }

    /**
     * @return ArrayCollection
     */
    public function getMetas()
    {
        return $this->source->getMetas();
    }

    /**
     * Sets \Ekino\WordpressBundle\Model\User roles.
     *
     * @param array|string $roles
     *
     * @return \Ekino\WordpressBundle\Model\User
     */
    public function setRoles($roles)
    {
        return $this->source->setRoles($roles);
    }

    public function getRoles()
    {
        if (empty($this->source->getRoles())) {
            $this->setRoles(
                array_keys(get_user_meta($this->getId(), 'wp_capabilities', true))
            );
        }

        return $this->source->getRoles();
    }

    /**
     * Sets Wordpress \Ekino\WordpressBundle\Model\User roles by prefixing them.
     *
     * @param array $roles An array of roles
     * @param string $prefix A role prefix
     *
     * @return \Ekino\WordpressBundle\Model\User
     */
    public function setWordpressRoles(array $roles, $prefix = 'ROLE_WP_')
    {
        return $this->source->setWordpressRoles($roles, $prefix);
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->source->getPassword();
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return $this->source->getSalt();
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->source->getUsername();
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
        return $this->source->eraseCredentials();
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->source->__toString();
    }
}