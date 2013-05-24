<?php
namespace Blog\Collection;

use Blog\Collection\BaseCollection;
use Blog\Entity\Post;

class PostsCollection extends BaseCollection {

    public function __construct(array $postsRows = array()) {
        foreach ($postsRows as $postRow) {
            $this->append(new Post($postRow));
        }
    }
}