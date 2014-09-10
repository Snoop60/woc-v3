<?php

namespace Models;

class Article extends Base
{
        public function fetchAll() {
            return $this->dab->table('posts')
               ->order('date DESC');
 }
 public function fetchSingle($id) {
    return $this->dab->table('posts')
                    ->where('id = ?', $id)
                    ->fetch();
}

	public function addEdit($values, $id = NULL)
	{
		if(is_null($id)) {
			return $this->getTable()->insert($values);
		} else {
			$task = $this->getTable()->get($id);
			return $task->update($values);
		}
	}
}