<?php
class Progress extends Dbh
{

    public function getCourseProgress($user_id, $course_id)
    {

        $sql = "SELECT progress from course_progress WHERE user_id = ? AND course_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id, $course_id]);
        $progress = $stmt->fetch();
        if ($progress) {
            return $progress['progress'];
        } else {
            return 0;
        }
    }
    public function getCourseStatus($user_id, $course_id)
    {
        $sql = "SELECT id from course_progress WHERE user_id = ? AND course_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id, $course_id]);
        $progress = $stmt->fetch();
        if ($progress) {
            return 1;
        } else {
            return 0;
        }
    }
    public function updateCourseProgress($user_id, $course_id, $points)
    {

        $sql = "UPDATE course_progress SET progress=progress+(?) WHERE user_id=(?) AND course_id=(?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$points, $user_id, $course_id])) {
            throw new Exception("Nu am putut insera în baza de date!");
        }
    }
    public function setCourseProgress($user_id, $course_id)
    {
        if (!$this->getCourseStatus($user_id, $course_id)) {

            $sql = "INSERT INTO course_progress(user_id,course_id) VALUES (?, ?)";
            $stmt = $this->connect()->prepare($sql);
            if (!$stmt->execute([$user_id, $course_id])) {
                throw new Exception("Nu am putut insera în baza de date!");
            }
        }
    }
    public function getChapterStatus($user_id, $chapter_id)
    {
        $sql = "SELECT completed from chapter_progress WHERE user_id = ? AND chapter_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id, $chapter_id]);
        $progress = $stmt->fetch();
        if ($progress) {
            return 1;
        } else {
            return 0;
        }
    }
    public function getTotalCoursePoints($user_id)
    {

        $sql = "SELECT SUM(progress) as total from course_progress WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        if ($stmt->execute([$user_id])) {
            $progress = $stmt->fetch();
            if ($progress) {
                return $progress['total'];
            } else {
                return 0;
            }
        } else {
            throw new Exception("Nu am gasit în baza de date!");
        }
    }
    public function setChapterProgress($userEmail, $chapter_id)
    {
        $user = new Users();
        $user_id = $user->getUserIdbyEmail($userEmail);
        if (!$this->getChapterStatus($user_id, $chapter_id)) {
            $sql = "INSERT INTO chapter_progress(user_id,chapter_id,completed) VALUES (?, ?, TRUE)";
            $stmt = $this->connect()->prepare($sql);
            if ($stmt->execute([$user_id, $chapter_id])) {
                $chapter = new Courses();
                try {
                    $thisChapter = $chapter->getChapterById($chapter_id);
                    $chapter_points = $thisChapter['points'];
                    $chapter_course = $thisChapter['course_id'];
                    $this->updateCourseProgress($user_id, $chapter_course, $chapter_points);
                } catch (Exception $e) {
                    return 0;
                }
            } else {
                throw new Exception("Nu am putut insera în baza de date!");
            }
        }
    }
}
