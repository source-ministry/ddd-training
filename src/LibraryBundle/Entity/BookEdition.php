<?php

namespace LibraryBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BookEdition
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class BookEdition
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
     * @ORM\Column(name="isbn", type="string", length=255, nullable=false)
     * @Assert\Isbn()
     * @Assert\NotNull()
     */
    private $isbn;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255, nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $author;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="releaseDate", type="date", nullable=false)
     * @Assert\NotNull()
     * @Assert\DateTime()
     */
    private $releaseDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="numberOfPages", type="integer", nullable=false)
     * @Assert\NotNull()
     * @Assert\GreaterThan(value="0")
     */
    private $numberOfPages;

    /**
     * @return BookCopy[]
     */
    public function getCopies()
    {
        return $this->copies;
    }


    /**
     * @var BookCopy[]
     *
     * @ORM\OneToMany(targetEntity="BookCopy", mappedBy="edition")
     */
    private $copies;

    public function __construct()
    {
        $this->copies = new ArrayCollection();
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
     * Set isbn
     *
     * @param string $isbn
     *
     * @return BookEdition
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return BookEdition
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
     * Set author
     *
     * @param string $author
     *
     * @return BookEdition
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set releaseDate
     *
     * @param string $releaseDate
     *
     * @return BookEdition
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate
     *
     * @return string
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set numberOfPages
     *
     * @param integer $numberOfPages
     *
     * @return BookEdition
     */
    public function setNumberOfPages($numberOfPages)
    {
        $this->numberOfPages = $numberOfPages;

        return $this;
    }

    /**
     * Get numberOfPages
     *
     * @return integer
     */
    public function getNumberOfPages()
    {
        return $this->numberOfPages;
    }

    public function getNumberOfCopies()
    {
        return count($this->copies);
    }

    public function getNumberOfAvailableCopies()
    {
        return count($this->copies->filter( function (BookCopy $bookCopy) { return $bookCopy->isAvailable(); } ));
    }
}

