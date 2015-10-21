<?php

namespace LibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reader
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Reader
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="firstLine", type="string", length=255)
     */
    private $addressFirstLine;

    /**
     * @var string
     *
     * @ORM\Column(name="secondLine", type="string", length=255)
     */
    private $addressSecondLine;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=255)
     */
    private $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var BookCopy[]
     *
     * @ORM\OneToMany(targetEntity="BookCopy", mappedBy="reader")
     */
    private $books;

    /**
     * Reader constructor.
     */
    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    /**
     * @return BookCopy[]
     */
    public function getBooks()
    {
        return $this->books;
    }

    public function getBooksCount()
    {
        return count($this->books);
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Reader
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
     * Set surname
     *
     * @param string $surname
     *
     * @return Reader
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Reader
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set enabled
     *
     * @param string $enabled
     *
     * @return Reader
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return string
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set firstLine
     *
     * @param string $addressFirstLine
     *
     * @return Reader
     */
    public function setAddressFirstLine($addressFirstLine)
    {
        $this->addressFirstLine = $addressFirstLine;

        return $this;
    }

    /**
     * Get addressFirstLine
     *
     * @return string
     */
    public function getAddressFirstLine()
    {
        return $this->addressFirstLine;
    }

    /**
     * Set secondLine
     *
     * @param string $addressSecondLine
     *
     * @return Reader
     */
    public function setAddressSecondLine($addressSecondLine)
    {
        $this->addressSecondLine = $addressSecondLine;

        return $this;
    }

    /**
     * Get secondLine
     *
     * @return string
     */
    public function getAddressSecondLine()
    {
        return $this->addressSecondLine;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     *
     * @return Reader
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Reader
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    public function getFullName()
    {
        return $this->name . " " . $this->surname;
    }
}

