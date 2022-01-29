<?php include('./templates/header.php'); ?>
<link rel="stylesheet" href="./more/congrats.css">
<link rel="stylesheet" href="./more/form.css">
<script src="./js/course.js"></script>

</head>

<body>
    <?php

    include('./config/functions.php');
    session_start(); ?>




    <?php
    if (isset($_GET['course'])) {
        $course = '';
        try {
            $c = new Courses();
            $course = $c->getCoursebyURL($_GET['course']);
        } catch (Exception $e) {
            echo  $e->getMessage();
        }
        if ($course) { ?>
            <style>
                button,
                input[type=submit] {
                    background-color: <?php echo $course['color']; ?>;
                    opacity: 0.8;
                }

                button:hover,
                input[type=submit]:hover {
                    background-color: <?php echo $course['color']; ?>;
                    opacity: 1;
                }
            </style>
            <div class="content">
                <?php
                include('./templates/left.php'); ?>

                <div class="right_content">
                    <?php
                    include('./templates/nav.php');
                    ?>
                    <div class="course_form">

                        <div class="max80">
                            <div class="horizontal_section text_section">
                                <div class=" left_landsc_img">
                                    <img src="<?php echo $course['cover']; ?>" alt="" class=" ">
                                </div>
                                <div class="left_landsc_txt ">

                                    <h1 class="home"><?php echo $course['title']; ?></h1>
                                    <div>
                                        <?php
                                        $last = '';
                                        $first  = explode("|", $course['introduction']);
                                        ?>
                                        <p class=""><?php echo $first[0]; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $last = $first[1];
                            $pars = explode("/", $first[1]);

                            foreach ($pars as $par) { ?>
                                <div class="subsection">
                                    <p class=""><?php echo $par; ?></p></br>
                                </div>

                            <?php }
                            ?>
                            <?php
                            try {
                                $chapters = $c->getChapterbyCourseId($course['id']);
                                $number = $c->countChapter($course['id']);
                                $i = 1; ?>
                                <div class="flex progressbar">
                                    <?php

                                    foreach ($chapters as $chapter) { ?>
                                        <div class="flex verticalflex progressbar_item">
                                            <div class="icon">
                                                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 99.56 99.56">
                                                    <defs>
                                                        <style>
                                                            .cls-1 {
                                                                fill: <?php echo $course['color']; ?>;
                                                                width: 100%;
                                                            }
                                                        </style>
                                                    </defs>
                                                    <path class="cls-1" d="M93.23,34.28,65.76,6.82a22.39,22.39,0,0,0-31.6,0L6.71,34.28a22.39,22.39,0,0,0,0,31.6L34.16,93.35a22.43,22.43,0,0,0,31.6,0L93.23,65.88A22.41,22.41,0,0,0,93.23,34.28ZM28.57,69.89a1.45,1.45,0,0,1-1.05.47H24.18a1.42,1.42,0,0,1-1.41-1.55l.92-8.7H28l.91,8.7A1.47,1.47,0,0,1,28.57,69.89Zm42.17-10.4a1,1,0,0,1-.21,0,23.56,23.56,0,0,0-3.37-.24c-6.72,0-12.73,2.85-15,7.09a1.41,1.41,0,0,1-1.24.74h-.43a1.4,1.4,0,0,1-1.23-.74c-2.23-4.24-8.25-7.09-15-7.09a23.66,23.66,0,0,0-3.37.24,1.39,1.39,0,0,1-1.18-.38,1.42,1.42,0,0,1-.41-1.17l1.15-10.56L50.75,55,71,47.25S72.14,58,72.14,58.08A1.35,1.35,0,0,1,70.74,59.49Zm5.51-17.56-25,9.41a1.38,1.38,0,0,1-1,0l-22.84-8.6V57.68H24.28v-17a1.41,1.41,0,0,1,.9-1.32L50.26,29.9a1.28,1.28,0,0,1,1,0l25,9.41a1.4,1.4,0,0,1,0,2.62Z" transform="translate(-0.18 -0.3)" />
                                                </svg>
                                            </div>
                                            <h3 class="progressbar_txt"><?php echo $chapter['title']; ?></h3>
                                        </div>

                                        <?php
                                        if ($i < $number) { ?>
                                            <div class="divider">
                                                <svg id="divider" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 86.63 30.07">
                                                    <defs>
                                                        <style>
                                                            .cls-1 {
                                                                fill: <?php echo $course['color']; ?>;
                                                            }
                                                        </style>
                                                    </defs>
                                                    <circle class="cls-1" cx="71.59" cy="15.03" r="15.03" />
                                                    <circle class="cls-1" cx="35.65" cy="15.03" r="10.66" />
                                                    <circle class="cls-1" cx="7.54" cy="15.03" r="7.54" />
                                                </svg>
                                            </div>
                                        <?php
                                            $i++;
                                        } ?>
                                    <?php  } ?>
                                </div>
                                <?php
                                if (isset($_SESSION['name'])) {
                                    $progress = new Progress();
                                    if (isset($_POST['start_course'])) {
                                        try {
                                            $progress->setCourseProgress($_SESSION['user_id'], $course['id']);
                                        } catch (Exception $e) {
                                            echo $e->getMessage();
                                        }
                                    }
                                    $status = $progress->getCourseStatus($_SESSION['user_id'], $course['id']);

                                    if ($status == 0) { ?>
                                        <form action="course.php?course=<?php echo $course['url']; ?>" method="post">
                                            <input type="submit" value="Începe cursul" name="start_course">
                                        </form>
                                    <?php  } else if ($status == 1) { ?>
                                        <div class="flex verticalflex chapters">
                                            <?php
                                            $number = $c->countChapter($course['id']);
                                            $i = 1;

                                            foreach ($chapters as $chapter) {
                                                if ($chapter['type'] == 1) {
                                                    $thumbnail = $c->getChapterThumbnail($chapter['id']);
                                                    $ch_intro = $c->getChapterIntro($chapter['id']);
                                                    if ($ch_intro) {
                                                        $chi = $ch_intro['text'];
                                                    } else {
                                                        $chi = '';
                                                    }

                                                    $chi = cutLongText($chi, 200);

                                                    if (strpos($thumbnail, ";")) {
                                                        $pos1 = strpos($thumbnail, ";");
                                                        $thumbnail = substr($thumbnail, 0, $pos1);
                                                    }

                                            ?>
                                                    <div class="chapter">
                                                        <div class="coursechapter">
                                                            <div class="chapterthumbnail">
                                                                <?php if ($thumbnail) { ?>
                                                                    <img src="<?php echo $thumbnail; ?>" alt="">
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="chaptercontent">
                                                                <div class="chaptertext">
                                                                    <h3 class="chaptertitle"><?php echo $chapter['title']; ?> - <?php echo $chapter['points']; ?> puncte <span id="chapter_status<?php echo $chapter['id']; ?>" style=""><?php
                                                                                                                                                                                                                                            $completed = $progress->getChapterStatus($_SESSION['user_id'], $chapter['id']);
                                                                                                                                                                                                                                            if ($completed) {
                                                                                                                                                                                                                                                echo "- Completat";
                                                                                                                                                                                                                                            } ?> </span></h3>
                                                                    <p class="chapterintro"><?php echo $chi; ?></p>
                                                                </div>
                                                                <button class="chapterlink">Mai mult</button>
                                                            </div>
                                                        </div>
                                                        <div class="subsections">
                                                            <?php
                                                            $subsections = $c->getSubsections($chapter['id']);

                                                            foreach ($subsections as $subsection) {
                                                                switch ($subsection['type']) {
                                                                    case 1: ?>

                                                                        <div class="top_banner"><img src="<?php echo $subsection['image']; ?>" alt=""></div>
                                                                        <p style="" class="top_banner_txt"><?php echo $subsection['text']; ?></p> <br>

                                                                    <?php break;
                                                                    case 2: ?>
                                                                        <div class="subsection">
                                                                            <div class=" left_landsc_img left_img"><img src="<?php echo $subsection['image']; ?>" alt=""></div>
                                                                            <div class="left_landsc_txt">
                                                                                <p style=" align-self: center;"><?php echo $subsection['text']; ?></p>
                                                                            </div>
                                                                        </div>
                                                                    <?php break;
                                                                    case 3: ?>
                                                                        <div class="subsection">
                                                                            <div class=" right_landsc_img right_img landsc"><img src="<?php echo $subsection['image']; ?>" alt=""></div>
                                                                            <div class="right_landsc_txt">
                                                                                <p style=""><?php echo $subsection['text']; ?></p>
                                                                            </div>

                                                                        </div>
                                                                    <?php break;
                                                                    case 4: ?>
                                                                        <div class="subsection portrait_section">
                                                                            <div class=" left_portrait_img left_img landsc"><img src="<?php echo $subsection['image']; ?>" alt=""></div>
                                                                            <p style=""><?php echo $subsection['text']; ?></p>
                                                                        </div>
                                                                    <?php break;
                                                                    case 5: ?>
                                                                        <div class="subsection portrait_section">
                                                                            <div class=" right_portrait_img right_img"><img src="<?php echo $subsection['image']; ?>" alt=""></div>
                                                                            <p style=""><?php echo $subsection['text']; ?></p>
                                                                        </div>
                                                                    <?php break;
                                                                    case 6: ?>

                                                                        <div class=" flex three_square subsection" style="margin: 0;">
                                                                            <?php $imgs = explode(";", $subsection['image']);
                                                                            $txts = explode(";;;", $subsection['text']);
                                                                            $j = 0;
                                                                            foreach ($imgs as $img) {

                                                                            ?>
                                                                                <div class="flex verticalflex square_section">
                                                                                    <div class="square_img">
                                                                                        <img src="<?php echo $img; ?>" alt="" class="img">
                                                                                    </div>
                                                                                    <div class="square_txt">
                                                                                        <h3><?php echo $txts[$j];
                                                                                            $j++; ?></h3>
                                                                                    </div>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </div>

                                                                    <?php break;
                                                                    case 7: ?>
                                                                        <div class="subsection">
                                                                            <p><?php echo $subsection['text']; ?></p>
                                                                        </div>
                                                                    <?php break;
                                                                    case 9: ?>
                                                                        <div class="highlight" style="background-color: <?php echo  $course['color']; ?>; margin-bottom: 30px;">
                                                                            <p><?php echo $subsection['text']; ?></p>
                                                                        </div>
                                                                    <?php break;
                                                                    case 10: ?>

                                                                        <h3 class="left_text subtitle" style="margin-bottom:20px"><?php echo $subsection['text']; ?></h3>

                                                                <?php break;
                                                                }
                                                            }
                                                            if (!$completed) {
                                                                ?>
                                                                <button class="complete" id="<?php echo $chapter['id']; ?>">Completează</button>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <?php if ($i < $number) { ?>
                                                        <hr class="separator_dots" style="margin: 0 auto; border-color:<?php echo $course['color']; ?>">
                                                    <?php
                                                        $i++;
                                                    } ?>
                                                <?php } else { ?>
                                                    <a href="<?php echo $chapter['url']; ?>" class="adiv">
                                                        <div class="coursechapter">
                                                            <div class="chapterthumbnail">
                                                                <img src="./img/typography-cover.png" alt="">
                                                            </div>
                                                            <div class="chaptercontent">
                                                                <div class="chaptertext">
                                                                    <h3 class="chaptertitle"><?php echo $chapter['title']; ?></h3>
                                                                    <p class="chapterintro">Acesta este un exercițiu în care vei putea pune în practică ce ai citit mai sus.</p>
                                                                </div>
                                                                <p style="margin-left: 20px;">Vezi Exercițiul</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                            <?php }
                                            } ?>
                                        </div>
                                    <?php
                                    }
                                } else if (!isset($_SESSION['name'])) {
                                    // header('Location: login.php');
                                    ?>
                                    <a href="login.php">Conecteaza-te</a>
                            <?php }
                            } catch (Exception $e) {
                                echo  $e->getMessage();
                            }

                            ?>
                        </div>
                    </div>

            <?php  } else {
            echo '</br>' . "Nu există acest curs!";
        }
    } else {
        echo "Nu am gasit acest curs";
    }
    include('./templates/footer.php'); ?>