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
                $topics = $community->getTopics();
                ?>
                <div class="inner_left">
                    <h3 class="left_text">Postările tale</h3>

                    <div class="sort_filter">
                        <select name="" id="selectTopic" class="own">
                            <option value="-1" selected>Toate</option>
                            <?php
                            foreach ($topics as $topic) { ?>
                                <option value="<?php echo $topic['id']; ?>"><?php echo $topic['topic']; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>


                </div>
            </div>
        </div>
    <?php

        include('./templates/footer.php');
    }

    ?>