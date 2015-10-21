<?php

namespace LibraryBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BookCopy
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class BookCopy
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
     * @var BookEdition
     *
     * @ORM\ManyToOne(targetEntity="BookEdition", inversedBy="copies")
     * @ORM\JoinColumn(name="edition_id", referencedColumnName="id", nullable=false)
     *
     * @Assert\NotNull()
     */
    private $edition;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="Reader", inversedBy="books")
     * @ORM\JoinColumn(name="reader_id", referencedColumnName="id", nullable=true)
     */
    private $reader;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="addedToLibraryAt", type="date", nullable=false)
     * @Assert\NotNull()
     * @Assert\DateTime()
     */
    private $addedToLibraryAt;


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
     * Set edition
     *
     * @param \stdClass $edition
     *
     * @return BookCopy
     */
    public function setEdition($edition)
    {
        $this->edition = $edition;

        return $this;
    }

    /**
     * Get edition
     *
     * @return \stdClass
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * Set reader
     *
     * @param \stdClass $reader
     *
     * @return BookCopy
     */
    public function setReader($reader)
    {
        $this->reader = $reader;

        return $this;
    }

    /**
     * Get reader
     *
     * @return \stdClass
     */
    public function getReader()
    {
        return $this->reader;
    }

    /**
     * Set addedToLibraryAt
     *
     * @param DateTime $addedToLibraryAt
     *
     * @return BookCopy
     */
    public function setAddedToLibraryAt($addedToLibraryAt)
    {
        $this->addedToLibraryAt = $addedToLibraryAt;

        return $this;
    }

    /**
     * Get addedToLibraryAt
     *
     * @return DateTime
     */
    public function getAddedToLibraryAt()
    {
        return $this->addedToLibraryAt;
    }

    public function isAvailable()
    {
        return $this->reader === null;
    }
}

