<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\ConfigItem;

/**
 * @ORM\Entity
 * @ORM\Table (name="configs")
 **/
class Config
{

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 * @var int
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	protected $name;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	protected $description;

	/**
	 * @ORM\Column(type="datetime")
	 * @var DateTime
	 */
	protected $date_created;

	/**
	 * @ORM\Column(type="datetime")
	 * @var DateTime
	 */
	protected $date_modified;


	/**
	 * @ORM\Column(type="string", nullable=true)
	 * @var string
	 */
	protected $api_key = null;


	/**
	 * Bidirectional - One Config has Many ConfigItems.
	 *
	 * @ORM\OneToMany(targetEntity="ConfigItem", mappedBy="config", cascade={"persist", "remove"})
	 * @var ArrayCollection
	 */
	protected $items;


	public function __construct()
	{
		$this->items = new ArrayCollection();
        $this->setDateCreated(new \DateTime('now'));
        $this->setDateModified(new \DateTime('now'));
        $this->api_key = com_create_guid();
	}

    public function addItem(ConfigItem $item)
    {
        $item->setConfig($this);
        $this->items->add($item);
    }


    public function removeItem(ConfigItem $item)
    {
        $this->items->removeElement($item);
    }


	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * @return mixed
	 */
	public function getItems()
	{
		return $this->items;
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}


	/**
	 * @param string $desc
	 */
	public function setDescription($desc)
	{
		$this->description = $desc;
	}


	/**
	 * @return mixed
	 */
	public function getApiKey()
	{
		return $this->api_key;
	}


	/**
	 * @param mixed $api_key
	 */
	public function setApiKey($api_key)
	{
		$this->api_key = $api_key;
	}


	/**
	 * @return DateTime
	 */
	public function getDateCreated()
	{
		return $this->date_created;
	}


	/**
	 * @param DateTime $date_created
	 */
	public function setDateCreated($date_created)
	{
		$this->date_created = $date_created;
	}


	/**
	 * @return DateTime
	 */
	public function getDateModified()
	{
		return $this->date_modified;
	}


	/**
	 * @param DateTime $date_modified
	 */
	public function setDateModified($date_modified)
	{
		$this->date_modified = $date_modified;
	}



}