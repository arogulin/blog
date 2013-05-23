TRUNCATE `posts`;

INSERT INTO `posts` (`id`, `title`, `slug`, `date`, `content`, `status`)
  VALUES
  (1, 'This is test post #1', 'this-is-test-post-1', '2013-03-01 10:11:12',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'public'),
  (2, 'This is test post #2', 'this-is-test-post-2', '2013-03-02 11:11:12',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'private'),
  (3, 'This is test post #3', 'this-is-test-post-3', '2013-03-03 12:11:14',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'private'),
  (4, 'This is test post #4', 'this-is-test-post-4', '2013-03-04 13:11:18',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'draft'),
  (5, 'This is test post #5', 'this-is-test-post-5', '2013-03-04 20:11:59',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'draft'),
  (6, 'This is test post #6', 'this-is-test-post-6', '2013-03-05 16:11:12',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'draft'),
  (7, 'This is test post #7', 'this-is-test-post-7', '2013-03-05 10:42:10',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'public'),
  (8, 'This is test post #8', 'this-is-test-post-8', '2013-03-06 11:33:12',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'public'),
  (9, 'This is test post #9', 'this-is-test-post-9', '2013-03-07 19:01:01',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'public'),
  (10, 'This is test post #10', 'this-is-test-post-10', '2013-03-08 10:11:12',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'public'),
  (11, 'This is test post #11', 'this-is-test-post-11', '2013-03-01 10:11:12',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'public'),
  (12, 'This is test post #12', 'this-is-test-post-12', '2013-03-02 10:11:12',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'public'),
  (13, 'This is test post #13', 'this-is-test-post-13', '2013-03-03 10:11:12',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'public'),
  (14, 'This is test post #14', 'this-is-test-post-14', '2013-03-04 10:11:12',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'public'),
  (15, 'This is test post #15', 'this-is-test-post-15', '2013-03-04 20:11:12',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'public'),
  (16, 'This is test post #16', 'this-is-test-post-16', '2013-03-05 10:11:12',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'public'),
  (17, 'This is test post #17', 'this-is-test-post-17', '2013-03-05 10:12:12',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'public'),
  (18, 'This is test post #18', 'this-is-test-post-18', '2013-03-06 10:11:12',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'public'),
  (19, 'This is test post #19', 'this-is-test-post-19', '2013-03-07 10:11:12',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'public'),
  (20, 'This is test post #20', 'this-is-test-post-20', '2013-03-08 10:11:12',
   '<p>Content of <b>this</b> test post.</p><p>next line of this test post</p>', 'public')
;

INSERT INTO `comments` (`id`, `title`, `slug`, `date`, `content`, `status`)
  VALUES