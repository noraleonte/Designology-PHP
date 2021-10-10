<?php

class Courses extends Dbh
{
    public function getChapterById($chapter_id)
    {
        $sql = "SELECT * from chapters WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$chapter_id]);
        $chapter = $stmt->fetch();
        if ($chapter) {
            return $chapter;
        } else {
            throw new Exception("Nu am putut găsi id-ul cusrsului inserat!");
        }
    }
    public function getChapterPoints($chapter_id)
    {
        $sql = "SELECT points from chapters WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$chapter_id]);
        $chapter = $stmt->fetch();
        if ($chapter) {
            return $chapter['points'];
        } else {
            throw new Exception("Nu am putut găsi id-ul cusrsului inserat!");
        }
    }
    private function getCourseIdbyTitle($title)
    {
        $sql = "SELECT * from courses WHERE title = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$title]);
        $course = $stmt->fetch();
        if ($course) {
            return $course['id'];
        } else {
            throw new Exception("Nu am putut găsi id-ul cusrsului inserat!");
        }
    }
    public function getCoursePointsbyId($id)
    {
        $sql = "SELECT points from courses WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $course = $stmt->fetch();
        if ($course) {
            return $course['points'];
        } else {
            throw new Exception("Nu am putut găsi id-ul cusrsului inserat!");
        }
    }
    public function getCoursebyURL($url)
    {
        $sql = "SELECT * from courses WHERE url = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$url]);
        $course = $stmt->fetch();
        if ($course) {
            return $course;
        } else {
            throw new Exception("Nu am putut găsi id-ul cusrsului inserat!");
        }
    }

    public function getAllCourses()
    {
        $sql = "SELECT * from courses";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $course = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($course) {
            return $course;
        } else {
            return 0;
        }
    }
    public function setChapter($course_id, $title, $points, $type)
    {
        $chapterURL = convertURL($title);
        $title = ucwords($title);
        $sql = "INSERT INTO chapters(course_id, title, points, type, url) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$course_id, $title, $points, $type, $chapterURL])) {
            throw new Exception("Nu am putut insera în baza de date!");
        }
    }
    public function getChapterIdbyTitle($title)
    {
        $sql = "SELECT * from chapters WHERE title = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$title]);
        $chapter = $stmt->fetch();
        if ($chapter) {
            return $chapter['id'];
        } else {
            throw new Exception("Nu am putut găsi id-ul capitolului inserat!");
        }
    }
    public function getChapterbyCourseId($id)
    {
        $sql = "SELECT * from chapters WHERE course_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $chapter = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($chapter) {
            return $chapter;
        } else {
            throw new Exception("Nu am putut găsi id-ul capitolului inserat!");
        }
    }

    public function countChapter($id)
    {
        $sql = "SELECT COUNT(id) as number from chapters WHERE course_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $chapter = $stmt->fetch();
        if ($chapter) {
            return $chapter['number'];
        } else {
            throw new Exception("Nu am putut reușit!");
        }
    }

    public function getChapterThumbnail($id)
    {
        $sql = "SELECT image from subsections WHERE chapter_id=? AND image <>''";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $chapter = $stmt->fetch();
        if ($chapter) {
            return $chapter['image'];
        }
        // else {
        //     return "./img/6.png";
        // }
    }
    public function getChapterIntro($id)
    {
        $sql = "SELECT * from subsections WHERE chapter_id=? AND text <>''";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $chapter = $stmt->fetch();
        if ($chapter && $chapter['type'] != 8) {
            return $chapter;
        } else {
            return "Acest capitol este unul de verificare. Dacă dai click pe buton, vei găsi un joculeț distractiv prin care îți poți demonstra noile skill-uri învățate.";
        }
    }
    public function setSubsection($chapter_id, $type, $text, $image)
    {
        $sql = "INSERT INTO subsections(chapter_id, type, text, image) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$chapter_id, $type, $text, $image])) {
            throw new Exception("Nu am putut insera în baza de date!");
        }
    }
    public function getSubsections($chapter_id)
    {
        $sql = "SELECT * from subsections WHERE chapter_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$chapter_id]);
        $subsections = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($subsections) {
            return $subsections;
        } else {
            throw new Exception("Nu am putut căuta în baza de date!");
        }
    }

    public function setCourses($title, $intro, $cover, $points, $chapters, $color)
    {
        $title = ucwords($title);
        $courseURL = convertURL($title);
        $sql = "INSERT INTO courses(title, introduction, cover, points, url,color) VALUES (?, ?, ?, ?, ?,?)";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$title, $intro, $cover, $points, $courseURL, $color])) {
            throw new Exception("Nu am putut insera în baza de datex!");
        } else {
            try {
                $course_id = $this->getCourseIdbyTitle($title);
                foreach ($chapters as $chapter) {
                    $this->setChapter($course_id, $chapter['title'], $chapter['points'], $chapter['type']);
                    $chapter_id = $this->getChapterIdbyTitle($chapter['title']);
                    foreach ($chapter['subsections'] as $subsection) {
                        $this->setSubsection($chapter_id, $subsection['type'], $subsection['text'], $subsection['image']);
                    }
                }
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
            }
        }
    }
}
