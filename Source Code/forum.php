<?php include('./templates/header.php'); ?>
<link rel="stylesheet" href="./more/forum.css">
<script src="./js/forum.js"></script>
</head>

<body>
    <?php
    include('./config/functions.php');

    session_start();

    if (!isset($_SESSION['name'])) {
        header('Location: login.php');
    } else {

    ?>
        <div class="content">
            <?php
            include('./templates/left.php'); ?>

            <div class="right_content">
                <?php
                include('./templates/nav.php');
                $community = new Community();
                ?>
                <div class="forum_content">
                    <div class="inner_left">
                        <h3 class="left_text">Întreabă comunitatea!</h3>
                        <div class="new_post">

                            <div class="post_area">
                                <textarea name="" id="post_content" cols="30" rows="10" placeholder="Scrie ceva..."></textarea>
                                <button id="post_button">Postează</button>
                            </div>
                            <div class="categories">
                                <?php
                                $topics = $community->getTopics();
                                foreach ($topics as $topic) { ?>
                                    <div class="category" id="<?php echo $topic['id']; ?>"><?php echo $topic['topic']; ?></div>
                                <?php }
                                ?>

                            </div>
                        </div>
                        <br><br>
                        <h3 class="left_text">Subiecte în trending</h3>
                        <div class="trending_topics">
                            <?php
                            $t = $community->getTrendingTopics();
                            if ($t && sizeof($t) == 3) { ?>
                                <div class="topic first" id="<?php echo $t[0]['id']; ?>"><?php echo $t[0]['name']; ?></div>
                                <div class="topic second" id="<?php echo $t[1]['id']; ?>"><?php echo $t[1]['name']; ?></div>
                                <div class="topic third" id="<?php echo $t[2]['id']; ?>"><?php echo $t[2]['name']; ?></div>
                            <?php } else if ($t && sizeof($t) == 2) { ?>
                                <div class="topic first" id="<?php echo $t[0]['id']; ?>"><?php echo $t[0]['name']; ?></div>
                                <div class="topic second" id="<?php echo $t[1]['id']; ?>"><?php echo $t[1]['name']; ?></div>
                            <?php  } else if ($t && sizeof($t) == 1) { ?>
                                <div class="topic first" id="<?php echo $t[0]['id']; ?>"><?php echo $t[0]['name']; ?></div>
                            <?php  }
                            ?>
                        </div>
                        <br><br>
                        <h3 class="left_text">Postări recente</h3>

                        <div class="sort_filter">
                            <!-- <select name="" id="">
                                    <option value="1">Popularitate</option>
                                    <option value="2">După dată</option>
                                </select> -->
                            <select name="" id="selectTopic">
                                <option value="-1" selected>Toate</option>
                                <?php
                                foreach ($topics as $topic) { ?>
                                    <option value="<?php echo $topic['id']; ?>"><?php echo $topic['topic']; ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>


                    </div>
                    <div class="inner_right">
                        <a href="" class="alink">
                            <div class="link"><svg id="discussions" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 63.93 57.84">
                                    <path d="M22.37,52.15l.39-1.47a1.56,1.56,0,0,0-1.08.11ZM7.68,59.49l-1.51-.21a1.53,1.53,0,0,0,2.19,1.58Zm2-13.92,1.51.22a1.54,1.54,0,0,0-.51-1.37ZM32,54.93c17.32,0,32-11.29,32-25.88H61C61,41.36,48.34,51.88,32,51.88ZM22,53.62A38.84,38.84,0,0,0,32,54.93v-3a35.84,35.84,0,0,1-9.27-1.2ZM8.36,60.86l14.69-7.35-1.37-2.72L7,58.13Zm-.2-15.5-2,13.92,3,.43,2-13.92ZM.07,29.05c0,6.89,3.31,13.1,8.6,17.68l2-2.31c-4.74-4.1-7.56-9.51-7.56-15.37ZM32,3.17c-17.31,0-32,11.29-32,25.88h3C3.11,16.74,15.73,6.22,32,6.22ZM64,29.05C64,14.46,49.35,3.17,32,3.17V6.22C48.34,6.22,61,16.74,61,29.05Z" transform="translate(-0.07 -3.17)" />
                                </svg>
                                <p> Toate discuțiile</p>
                            </div>
                        </a>
                        <a href="followed.php" class="adiv">
                            <div class="link">
                                <svg id="star" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 63.98 60.85">
                                    <defs>
                                        <style>
                                            .cls-1 {
                                                fill: #000;
                                            }
                                        </style>
                                    </defs>
                                    <path class="cls-1" d="M51.77,62.2,32,49.45,12.22,62.2l6-22.74L0,24.59l23.49-1.3L32,1.35,40.5,23.29,64,24.59,45.75,39.46ZM10,27.83,22.52,38.07,18.38,53.73,32,45,45.6,53.72,41.46,38.07,54,27.83l-16.17-.9L32,11.83l-5.85,15.1Z" transform="translate(0 -1.35)" />
                                </svg>
                                <p>Urmărite</p>
                            </div>
                        </a>
                        <a href="ownposts.php" class="adiv">
                            <div class="link">
                                <svg id="profile" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 63.65">
                                    <path d="M51.81,56.05a1.57,1.57,0,0,1-.6-.12c-.45-.19-11-4.7-14.19-7.9-2.24-2.22-.46-4.11.71-5.36,1.84-2,4.94-5.27,4.94-13.9,0-13.39-10.24-13.63-10.68-13.63s-10.66.24-10.66,13.63c0,8.63,3.09,11.93,4.94,13.9,1.18,1.25,2.95,3.14.71,5.36-3.22,3.2-13.74,7.71-14.19,7.9a1.54,1.54,0,0,1-2-.8,1.52,1.52,0,0,1,.8-2c2.89-1.23,10.91-4.94,13.24-7.25a1.13,1.13,0,0,0,.2-.24c-.13.06-.59-.49-1-.92-2-2.14-5.75-6.14-5.75-16C18.29,12.3,31.86,12.11,32,12.11s13.71.19,13.71,16.66c0,9.82-3.74,13.82-5.75,16a9.73,9.73,0,0,0-.9,1l.11.12c2.33,2.31,10.35,6,13.24,7.25a1.52,1.52,0,0,1-.6,2.91Z" transform="translate(0 0.02)" />
                                    <path d="M32,63.63A31.83,31.83,0,1,1,64,31.81,32,32,0,0,1,32,63.63ZM32,3a28.8,28.8,0,1,0,29,28.8A28.91,28.91,0,0,0,32,3Z" transform="translate(0 0.02)" />
                                </svg>
                                <p>Discuțiile tale</p>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    <?php

        include('./templates/footer.php');
    }

    ?>