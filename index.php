<?php include('./templates/header.php'); ?>
</head>

<body>
    <?php
    include('./config/functions.php');
    session_start(); ?>


    <div class="content">
        <?php
        include('./templates/left.php'); ?>

        <div class="right_content">
            <?php
            include('./templates/nav.php');
            ?>


            <div class="home_cover_section">

                <div class="cta">
                    <h1 class="home">Hai să învățăm user experience!</h1>

                    <form action="index.php" method="get">
                        <!-- <div class="flex search">
                            <div>

                                <input type="text" name="search" value="" placeholder="Caută">
                            </div>
                            <input type="submit" value="Caută">
                        </div> -->
                    </form>

                </div>
                <div class="home_cover">
                    <img src="./img/cover.png" alt="">
                </div>
            </div>
            <div style="margin-bottom: 2vh;">
                <?php if (isset($_SESSION['name'])) { ?>
                    <h3 class="left_text">Bine ai venit, <?php echo $_SESSION['name']; ?>!</h3>
                <?php } else { ?>
                    <h3 class="left_text">Bine ai venit, vizitatorule!</h3>
                <?php } ?>

                <h4>Recomandate pentru tine:</h4>
            </div>
            <div class="horizontal_slider">
                <div class="collection">

                    <?php
                    $course = '';

                    $c = new Courses();
                    $courses = $c->getAllCOurses();
                    if (array_filter($courses)) {
                        foreach ($courses as $course) { ?>
                            <a class="adiv" href="<?php echo "course.php?course=" . $course['url']; ?>">
                                <div class="card">
                                    <div class="card_image" style="background-color: <?php echo $course['color']; ?>">
                                        <img src="<?php echo $course['cover']; ?>" alt="">
                                        <?php if (isset($_SESSION['name'])) {
                                            $progress = new Progress();
                                            $course_prog = $progress->getCourseProgress($_SESSION['user_id'], $course['id']);
                                            if ($course_prog) {
                                                $width = $course_prog / $course['points'] * 100;
                                        ?>
                                                <div class="myProgress">
                                                    <div class="myBar" id="<?php echo $width; ?>"></div>
                                                </div>
                                        <?php
                                            }
                                        } ?>

                                    </div>

                                    <div class="card_intro">
                                        <h4 class="card_title left_text"><?php echo $course['title']; ?></h4>
                                    </div>
                                </div>
                            </a>
                    <?php  }
                    }
                    ?>
                </div>
                <div class="paddles">
                    <button class="left-paddle paddle hidden shadow">
                        <svg id="left_paddle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35.44 63.93">
                            <path d="M47,63.93a2.45,2.45,0,0,1-1.74-.72L14.06,32,45.3.72A2.46,2.46,0,1,1,48.78,4.2L21,32,48.78,59.73A2.46,2.46,0,0,1,47,63.93Z" transform="translate(-14.06 0)" />
                        </svg> </button>
                    <button class="right-paddle paddle hidden shadow">
                        <svg id="right_paddle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35.48 64">
                            <path d="M16.5,64a2.46,2.46,0,0,1-1.74-4.2L42.56,32,14.76,4.2A2.46,2.46,0,0,1,18.24.72L49.52,32,18.24,63.28A2.45,2.45,0,0,1,16.5,64Z" transform="translate(-14.04)" />
                        </svg>
                    </button>
                </div>
            </div>
            <?php include('./templates/footer.php'); ?>