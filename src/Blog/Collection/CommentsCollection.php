<?php
namespace Blog\Collection;

use Blog\Collection\BaseCollection;
use Blog\Entity\Comment;

class CommentsCollection extends BaseCollection {

    public function __construct(array $commentsRows = array()) {
        foreach ($commentsRows as $commentRow) {
            $this->append(new Comment($commentRow));
        }
    }
}