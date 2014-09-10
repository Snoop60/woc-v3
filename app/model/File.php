<?php

namespace Models;

class File extends Base
{

	public function getFiles($versionId)
	{
		$files= $this->getAll()->where('version_id', $versionId)->order('name ASC');
		return $files;
	}

	public function getMyFiles()
	{
		$files= $this->getAll()->where('version.article.user_id', $this->user->getId())->order('name ASC');
		return $files;
	}

	public function addEdit($values, $id = NULL)
	{
//		$version = $this->db->table('version')->where("id", $values->version_id);
//		$version->update("version_2", $version->version_2 + 1);

		if(is_null($id)) {
			return $this->getTable()->insert($values);
		} else {
			$task = $this->getTable()->get($id);
			return $task->update($values);
		}
	}
}