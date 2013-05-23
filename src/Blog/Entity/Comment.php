<?php
namespace Blog\Entity;

class Comment extends BaseEntity {

    const STATUS_MODERATED = 'moderated';

    protected $id;
    protected $post_id;
    protected $author_name;
    protected $author_ip;
    protected $date;
    protected $content;
    protected $status;

}