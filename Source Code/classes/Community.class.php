<?php

class Community extends Dbh
{
    public function getTrendingTopics()
    {
        $sql = "SELECT posts.topic as id, topics.id, topics.topic as name, COUNT(*) as num FROM posts INNER JOIN topics ON posts.topic=topics.id GROUP BY posts.topic ORDER BY num DESC LIMIT 3";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($topics) {
            return $topics;
        } else {
            return 0;
        }
    }
    public function getAllLikedPosts($user)
    {
        $sql = "SELECT posts.id as id ,posts.content as content, posts.topic as topic, likes.post_id, likes.user_id,users.id as user_id, users.name as user_name, users.url as url, users.profile_image as profile_image, topics.topic as topic_name FROM (posts INNER JOIN users ON posts.user_id=users.id) INNER JOIN likes ON likes.post_id = posts.id INNER JOIN topics on posts.topic=topics.id WHERE likes.user_id=? ORDER BY posts.date DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user]);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($posts) {
            return $posts;
        } else {
            return 0;
        }
    }
    public function getLikedPostsByTopic($topic, $user_id)
    {
        $sql = "SELECT posts.id as id,posts.content as content, posts.topic as topic, likes.post_id, likes.user_id,users.id as user_id, users.name as user_name, users.url as url, users.profile_image as profile_image, topics.topic as topic_name FROM (posts INNER JOIN users ON posts.user_id=users.id) INNER JOIN likes ON likes.post_id = posts.id INNER JOIN topics on posts.topic=topics.id WHERE posts.topic=? AND likes.user_id=? ORDER BY posts.date DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$topic, $user_id]);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($posts) {
            return $posts;
        } else {
            return 0;
        }
    }
    public function getAllPostsbyUser($user)
    {
        $sql = "SELECT  posts.id as id,posts.content as content, posts.topic as topic,users.id as user_id, users.name as user_name, users.url as url, users.profile_image as profile_image, topics.topic as topic_name from posts INNER JOIN users ON posts.user_id=users.id INNER JOIN topics on posts.topic=topics.id WHERE posts.user_id=? ORDER BY posts.date DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user]);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($posts) {
            return $posts;
        } else {
            return 0;
        }
    }
    public function getPostsByTopicbyUser($topic, $user_id)
    {
        $sql = "SELECT  posts.id as id,posts.content as content, posts.topic as topic,users.id as user_id, users.name as user_name, users.url as url, users.profile_image as profile_image, topics.topic as topic_name from posts INNER JOIN users ON posts.user_id=users.id INNER JOIN topics on posts.topic=topics.id WHERE posts.topic=? AND posts.user_id=? ORDER BY posts.date DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$topic, $user_id]);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($posts) {
            return $posts;
        } else {
            return 0;
        }
    }
    public function getPostsByTopic($topic)
    {
        $sql = "SELECT  posts.id as id,posts.content as content, posts.topic as topic,users.id as user_id, users.name as user_name, users.url as url, users.profile_image as profile_image, topics.topic as topic_name from posts INNER JOIN users ON posts.user_id=users.id INNER JOIN topics on posts.topic=topics.id WHERE posts.topic=? ORDER BY posts.date DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$topic]);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($posts) {
            return $posts;
        } else {
            return 0;
        }
    }
    public function countLikes($post_id)
    {
        $sql = "SELECT COUNT(id) as numbers FROM likes WHERE post_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$post_id]);
        $like = $stmt->fetch();
        if ($like) {
            return $like['numbers'];
        } else {
            return 0;
        }
    }
    public function setComment($content, $user_id, $post_id)
    {
        $sql = "INSERT INTO comments(content,user_id, post_id) VALUES (?,?, ?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$content, $user_id, $post_id])) {
            throw new Exception("Nu am putut insera în baza de date!");
        }
    }
    public function getAllComments($post_id)
    {
        $sql = "SELECT comments.content as content,  users.id as user_id, users.name as user_name, users.url as url, users.profile_image as profile_image from comments INNER JOIN users ON comments.user_id=users.id WHERE comments.post_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$post_id]);
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($comments) {
            return $comments;
        } else {
            return 0;
        }
    }
    public function countComments($post_id)
    {
        $sql = "SELECT COUNT(id) as numbers FROM comments WHERE post_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$post_id]);
        $comment = $stmt->fetch();
        if ($comment) {
            return $comment['numbers'];
        } else {
            return 0;
        }
    }
    public function deleteLike($user_id, $post_id)
    {
        $sql = "DELETE FROM likes WHERE user_id=? AND post_id=?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$user_id, $post_id])) {
            throw new Exception("Nu am putut sterge din baza de date!");
        }
    }
    public function setLike($user_id, $post_id)
    {
        if (!$this->getLike($user_id, $post_id)) {
            $sql = "INSERT INTO likes(user_id, post_id) VALUES (?, ?)";
            $stmt = $this->connect()->prepare($sql);
            if (!$stmt->execute([$user_id, $post_id])) {
                throw new Exception("Nu am putut insera în baza de date!");
            }
        }
    }
    public function getLike($user_id, $post_id)
    {
        $sql = "SELECT * FROM likes WHERE user_id=? AND post_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id, $post_id]);
        $like = $stmt->fetch();
        if ($like) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getTopics()
    {
        $sql = "SELECT * from topics";
        $stmt = $this->connect()->prepare($sql);
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($topics) {
            return $topics;
        } else {
            return 0;
        }
    }

    public function newPost($user_id, $content, $topic)
    {
        $sql = "INSERT INTO posts(content,user_id, topic) VALUES (?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$content, $user_id, $topic])) {
            throw new Exception("Nu am putut insera în baza de date!");
        }
    }
    public function getPostDetails($post_id)
    {
        $sql = "SELECT  posts.id as id, posts.content as content, posts.topic as topic,users.id as user_id, users.name as user_name, users.url as url, users.profile_image as profile_image, topics.topic as topic_name from posts INNER JOIN users ON posts.user_id=users.id INNER JOIN topics on posts.topic=topics.id WHERE posts.id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$post_id]);
        $post = $stmt->fetch();
        if ($post) {
            return $post;
        } else {
            return 0;
        }
    }
    public function getAllPosts()
    {
        $sql = "SELECT  posts.id as id,posts.content as content, posts.topic as topic,users.id as user_id, users.name as user_name, users.url as url, users.profile_image as profile_image, topics.topic as topic_name from posts INNER JOIN users ON posts.user_id=users.id INNER JOIN topics on posts.topic=topics.id ORDER BY posts.date DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($posts) {
            return $posts;
        } else {
            return 0;
        }
    }
}
