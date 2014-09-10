<?php

namespace Models;

use Nette;
use Nette\Security\Identity;
use Nette\Object,
	Nette\Environment;

abstract class Base extends \Nette\Object
{
	/** @var Nette\Database\Context */
	private $db;
        protected $dab;
	protected $user;

	public function __construct(\Nette\Database\Context $dab, \Nette\Database\Context $db, \Nette\Security\User $user)
	{
                $this->dab = $dab;
		$this->db = $db;
		$this->user = $user;
	}

	protected function getTable()
	{
		preg_match('#(\w+)$#', get_class($this), $m);
		return $this->db->table(lcfirst($m[1]));
	}

	public function get($id)
	{
		return $this->getTable()->get($id);
	}

	public function getAll()
	{
		return $this->getTable();
	}

	public function findBy(array $by)
	{
		return $this->getTable()->where($by);
	}

	public function findById($id)
	{
		return $this->getTable()->where('id', $id);
	}

	public function update($id, $values)
	{
		return $this->getTable()->get($id)->update($values);
	}

	public function insert($values)
	{
		return $this->getTable()->insert($values);
	}

}