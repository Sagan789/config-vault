<?php

namespace AppBundle\Entity;


/**
 * @ORM\Entity
 * @ORM\Table (name="config_items")
 **/
class ConfigItem
{
	const ENV_DEV       =1;
	const ENV_TEST      =2;
	const ENV_PROD      =3;

	const TYPE_STRING   = 1;
	const TYPE_INTEGER  = 2;

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 * @var int
	 */
	protected $id;

	/**
	 * Bidirectional - Many items are belongs to one config (OWNING SIDE)
	 *
	 * @ORM\ManyToOne(targetEntity="Config", inversedBy="items")
	 */
	protected $config;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	protected $item_key;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	protected $item_value;

	/**
	 * @ORM\Column(type="smallint")
	 * @var int
	 */
	protected $type;

	/**
	 * @ORM\Column(type="smallint")
	 * @var int
	 */
	protected $environment;


	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}



	/**
	 * @param mixed $configId
	 */
	public function setConfigId($configId)
	{
		$this->configId = $configId;
	}


	/**
	 * @return string
	 */
	public function getItemKey()
	{
		return $this->item_key;
	}


	/**
	 * @param string $item_key
	 */
	public function setItemKey($item_key)
	{
		$this->item_key = $item_key;
	}


	/**
	 * @return string
	 */
	public function getItemValue()
	{
		return $this->item_value;
	}


	/**
	 * @param string $item_value
	 */
	public function setItemValue($item_value)
	{
		$this->item_value = $item_value;
	}


	/**
	 * @return mixed
	 */
	public function getType()
	{
		return $this->type;
	}


	/**
	 * @param mixed $type
	 */
	public function setType($type)
	{
		$this->type = $type;
	}


	/**
	 * @return mixed
	 */
	public function getEnvironment()
	{
		return $this->environment;
	}


	/**
	 * @param mixed $environment
	 */
	public function setEnvironment($environment)
	{
		$this->environment = $environment;
	}


	/**
	 * @return mixed
	 */
	public function getConfig()
	{
		return $this->config;
	}


	/**
	 * @param mixed $config
	 */
	public function setConfig($config)
	{
		$this->config = $config;
	}

}