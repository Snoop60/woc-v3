<?php

namespace Models;

class Version extends Base
{

public function tiketAll() {
 return $this->dab->table('tikets');
 }
 public function fetchSingle($id) {
    return $this->dab->table('tikets')
                    ->where('id = ?', $id)
                    ->fetch();
}
 
}