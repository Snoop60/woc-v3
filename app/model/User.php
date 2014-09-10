<?php

namespace Models;

class User extends Base
{

	public function addEdit($values, $id = NULL)
	{
		if(is_null($id)) {
			return $this->getTable()->insert($values);
		} else {
			$task = $this->getTable()->get($id);
			return $task->update($values);
		}
	}
	public function register($data) {
    unset($data["password2"]);
    $data["name"] = ($data["name"]);
    $data["username"] = ($data["username"]);
	$data["email"] = ($data["email"]);
    $data["password"] = sha1($data["password"]);


    $this->getTable('user')->insert($data);
}
      public function fetchAll() {
            return $this->dab->table('user');
 }
  public function fetchShow($id) {
    return $this->dab->table('user')
                    ->where('id = ?', $id)
                    ->fetch();
}

}