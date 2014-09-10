<?php
namespace Models;

class Comments extends Base
{
public function fetchArticleComments($post_id) {
 return $this->dab->table('comments')
 ->where('post_id = ?', $post_id);
 }
 public function insert($data) {
    $this->dab->table('comments')
            ->insert($data);
}
}