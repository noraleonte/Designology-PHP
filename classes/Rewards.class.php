<?php
class Rewards extends Dbh
{
    public function getNextReward($points, $category)
    {
        $sql = "SELECT * FROM rewards WHERE points_necessary > ? AND category=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$points, $category]);
        $reward = $stmt->fetch();
        if ($reward) {
            return $reward;
        } else {
            $sql = "SELECT * from rewards WHERE points_necessary = ? ";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$points]);
            $reward = $stmt->fetch();
            if ($reward) {
                return $reward;
            } else {
                return 0;
            }
        }
    }
    public function isSelected($reward_id, $user_id)
    {
        $sql = "SELECT selected from unlocked_titles WHERE reward_id = ? AND user_id=? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$reward_id, $user_id]);
        $reward = $stmt->fetch();
        if ($reward['selected'] == TRUE) {
            return TRUE;
        } else {
            $sql = "SELECT selected from unlocked_badges WHERE reward_id = ? AND user_id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$reward_id, $user_id]);
            $reward = $stmt->fetch();
            if ($reward['selected'] == TRUE) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
    public function setSelectedBadge($reward_id, $user_id)
    {
        $sql = "UPDATE unlocked_badges SET selected=0 WHERE user_id=?";
        $stmt = $this->connect()->prepare($sql);
        if ($stmt->execute([$user_id])) {
            $sql = "UPDATE unlocked_badges SET selected=1 WHERE reward_id=? AND user_id=?";
            $stmt = $this->connect()->prepare($sql);
            if (!$stmt->execute([$reward_id, $user_id])) {
                throw new Exception("Nu am putut insera în baza de date!");
            }
        } else {
            throw new Exception("Nu am putut insera în baza de date!");
        }
    }
    public function setSelectedTitle($reward_id, $user_id)
    {
        $sql = "UPDATE unlocked_titles SET selected=0 WHERE user_id=?";
        $stmt = $this->connect()->prepare($sql);
        if ($stmt->execute([$user_id])) {
            $sql = "UPDATE unlocked_titles SET selected=1 WHERE reward_id=? AND user_id=?";
            $stmt = $this->connect()->prepare($sql);
            if (!$stmt->execute([$reward_id, $user_id])) {
                throw new Exception("Nu am putut insera în baza de date!");
            }
        } else {
            throw new Exception("Nu am putut insera în baza de date!");
        }
    }
    public function getUnlockedTitles($user_id)
    {
        $sql = "SELECT * from unlocked_titles WHERE user_id = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        $rewards = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($rewards) {
            return $rewards;
        } else {
            return 0;
        }
    }
    public function getSelectedTitles($user_id)
    {
        $sql = "SELECT unlocked_titles.user_id,unlocked_titles.reward_id,rewards.id, rewards.name as name from unlocked_titles INNER JOIN rewards ON unlocked_titles.reward_id=rewards.id WHERE unlocked_titles.user_id = ? AND unlocked_titles.selected=1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        $rewards = $stmt->fetch();
        if ($rewards) {
            return $rewards['name'];
        } else {
            return '';
        }
    }
    public function getUnlockedBadges($user_id)
    {
        $sql = "SELECT * from unlocked_badges WHERE user_id = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        $rewards = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($rewards) {
            return $rewards;
        } else {
            return 0;
        }
    }
    public function getRewardById($reward_id)
    {
        $sql = "SELECT * from rewards WHERE id = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$reward_id]);
        $rewards = $stmt->fetch();
        if ($rewards) {
            return $rewards;
        } else {
            return 0;
        }
    }

    public function unlockReward($points, $user_id, $category)
    {
        $sql = "SELECT * FROM rewards WHERE points_necessary = ? AND category=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$points, $category]);
        $reward = $stmt->fetch();
        if ($reward) {
            if ($reward['type'] == 1) {
                $sql = "INSERT into unlocked_titles(user_id, reward_id, selected) VALUES(?,?, 0)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$user_id, $reward['id']]);
            } else {
                $sql = "INSERT into unlocked_badges(user_id, reward_id, selected) VALUES(?,?, 0)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$user_id, $reward['id']]);
            }

            return $reward;
        }
    }
}
