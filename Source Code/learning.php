<?php include('./templates/header.php'); ?>

<link rel="stylesheet" href="./more/profile.css">
<link rel="stylesheet" href="./more/learning.css">
<script src="./js/profile.js"></script>
</head>

<body>
    <?php
    include('./config/functions.php');

    session_start();

    if (!isset($_SESSION['name'])) {
        header('Location: login.php');
    } else {
        if (!isset($_GET['user'])) {
            header("location: 404.php");
        } else if ($_GET['user'] != $_SESSION['userURL']) {
            header("location: 404.php");
        } else { ?>
            <div class="content">
                <?php
                include('./templates/left.php'); ?>

                <div class="right_content">
                    <?php
                    include('./templates/nav.php');
                    ?>
                    <div class="profile">
                        <div class="profile_cover">
                            <div class="cover_image <?php echo $_SESSION['userCover']; ?>">

                            </div>
                            <div class="profile_image">
                                <div class="profile_container">

                                    <img src="<?php echo $_SESSION['userProfile']; ?>" alt="">

                                </div>
                            </div>
                            <div class="profile_name">
                                <h2 class="left_text regular"><?php echo $_SESSION['name']; ?></h2>
                                <?php
                                $reward = new Rewards();
                                $unlocked_titles = $reward->getUnlockedTitles($_SESSION['user_id']);
                                if ($unlocked_titles) {
                                    foreach ($unlocked_titles as $t) {
                                        if ($t['selected'] == 1) {
                                            $title = $reward->getRewardById($t['reward_id']); ?>
                                            <h4><?php echo $title['name']; ?></h4>

                                <?php  }
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="user_courses">
                        <h3 class="left_text regular">Cursuri începute de tine:</h3>
                        </br>

                        <?php
                        $c = new Courses();
                        $p = new Progress();
                        $courses = $c->getAllCOurses();
                        if (array_filter($courses)) {
                            foreach ($courses as $course) {
                                if ($p->getCourseStatus($_SESSION['user_id'], $course['id'])) {
                        ?>
                                    <a href="course.php?course=<?php echo $course['url']; ?>" class="adiv">
                                        <div class="started_course">
                                            <div class="course_cover" style="background-color: <?php echo $course['color']; ?>;">
                                                <img src="<?php echo $course['cover']; ?>" alt="">
                                            </div>
                                            <div class="right">
                                                <div class="text">
                                                    <h2 class="regular left_text"><?php echo $course['title']; ?></h2>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. porttitor vitae amet est elementum pellentesque. Suspendisse in id ut dictumst justo. Erat et eget vitae vestibulum tellus lacus turpis.</p>
                                                </div>
                                                <div class="middle">

                                                    <?php
                                                    $course_prog = $p->getCourseProgress($_SESSION['user_id'], $course['id']);
                                                    $width = $course_prog / $course['points'] * 100;
                                                    ?>
                                                    <div class="myProgress">
                                                        <div class="myBar" id="<?php echo $width; ?>"></div>
                                                    </div>
                                                    <?php

                                                    ?>
                                                    <button href="course.php?course=<?php echo $course['url']; ?>">Continuă</button>
                                                </div>

                                            </div>

                                        </div>
                                    </a>

                        <?php }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
    <?php }
    }
    include('./templates/footer.php');

    ?>