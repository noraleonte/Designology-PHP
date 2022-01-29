<?php

class Users extends Dbh
{
    public function isAdmin($id)
    {
        $sql = "SELECT admin FROM users WHERE id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        if ($user['admin']) {
            return 1;
        } else {
            return 0;
        }
    }
    public function setCommunityTargetbyId($id, $target)
    {
        $sql = "UPDATE users SET community_target=(?) WHERE id=?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$target, $id])) {
            throw new Exception("Nu am găsit un cont asociat acestui email!");
        }
    }
    public function getCommunityTargetbyId($id)
    {
        $sql = "SELECT community_target from users WHERE id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        if ($user) {
            return $user['community_target'];
        } else {
            return 0;
        }
    }
    public function getTotalCommunityPoints($user_id)
    {
        $sql = "SELECT community_points from users WHERE id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();
        if ($user) {
            return $user['community_points'];
        } else {
            return 0;
        }
    }
    public function updateCommunityProgress($user_id, $points)
    {
        $sql = "UPDATE users SET community_points=community_points+(?) WHERE id=(?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$points, $user_id])) {
            throw new Exception("Nu am putut insera în baza de date!");
        }
    }
    public function updatePassword($url, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password=(?) WHERE url=(?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$hashedPassword, $url])) {
            throw new Exception("Nu am putut insera în baza de date!");
        }
    }
    public function updateEmail($url, $email)
    {
        $sql = "UPDATE users SET email=(?) WHERE url=(?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$email, $url])) {
            throw new Exception("Nu am putut insera în baza de date!");
        }
    }
    public function updateName($email, $name)
    {
        $newURL = convertURL($name);
        $_SESSION['userURL'] = $newURL;
        $sql = "UPDATE users SET name=(?), url=(?) WHERE email=(?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$name, $newURL, $email])) {
            throw new Exception("Nu am putut insera în baza de date!");
        }
    }
    public function addCover($url, $cover)
    {
        $sql = "UPDATE users SET cover_image=(?) WHERE url=(?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$cover, $url])) {
            throw new Exception("Nu am putut insera în baza de date!");
        }
    }
    public function addprofile($url, $profile)
    {
        $sql = "UPDATE users SET profile_image=(?) WHERE url=(?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$profile, $url])) {
            throw new Exception("Nu am putut insera în baza de date!");
        }
    }
    public function hasName($name)
    {
        $sql = "SELECT * FROM users WHERE name=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name]);
        $user = $stmt->fetch();
        if ($user) {
            return 1;
        } else {
            return 0;
        }
    }
    public function hasEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user) {
            return 1;
        } else {
            return 0;
        }
    }
    public function changeAccountStatus($user_id, $status)
    {
        $sql = "UPDATE users SET status=? WHERE id=(?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$status, $user_id])) {
            throw new Exception("Nu am putut insera în baza de date!");
        }
    }
    public function verifyUser($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user) {
            if ($user['status'] == 1) {
                return 1;
            } else if ($user['status'] == 2) {
                if (password_verify($password, $user['password'])) {
                    return 2;
                } else {
                    return 0;
                }
            } else {
                return 3;
            }
        } else {
            throw new Exception("Nu am găsit un cont asociat acestui email!");
        }
    }
    public function getUserIdbyEmail($email)
    {
        $sql = "SELECT id from users WHERE email=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user) {
            return $user['id'];
        } else {
            return 0;
        }
    }
    public function setCourseTargetbyId($id, $target)
    {
        $sql = "UPDATE users SET course_target=(?) WHERE id=?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$target, $id])) {
            throw new Exception("Nu am găsit un cont asociat acestui email!");
        }
    }
    public function getCourseTargetbyId($id)
    {
        $sql = "SELECT course_target from users WHERE id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        if ($user) {
            return $user['course_target'];
        } else {
            return 0;
        }
    }
    public function getUserbyEmail($email)
    {
        $sql = "SELECT * from users WHERE email=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user) {
            return $user;
        } else {
            return 0;
        }
    }

    public function getUserbyId($id)
    {
        $sql = "SELECT * from users WHERE id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        if ($user) {
            return $user;
        } else {
            return 0;
        }
    }
    public function getUserbyURL($url)
    {
        $sql = "SELECT * from users WHERE url=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$url]);
        $user = $stmt->fetch();
        if ($user) {
            return $user;
        } else {
            return 0;
        }
    }
    public function getAllStatus()
    {
        $sql = "SELECT * FROM account_status";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $status = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($status) {
            return $status;
        } else {
            return 0;
        }
    }
    public function getAllUsers()
    {
        $sql = "SELECT name, url FROM users";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($users) {
            return $users;
        } else {
            return 0;
        }
    }
    public function setUsers($email, $password, $name, $url)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $name = ucwords($name);
        $reward = new Rewards();
        $course_target = $reward->getNextReward(0, 2);
        $community_target = $reward->getNextReward(0, 1);
        $sql = "INSERT INTO users(email,password,name,status, url, course_target, community_target) VALUES (?, ?, ?, ?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$email, $hashedPassword, $name, 1, $url, $course_target['points_necessary'], $community_target['points_necessary']])) {
            throw new Exception("Nu am putut insera în baza de date!");
        }
    }
}
