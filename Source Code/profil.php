<?php include('./templates/header.php'); ?>


<link rel="stylesheet" href="./more/profile.css">
<script src="./js/profile.js"></script>
<script src="./js/admin.js"></script>

</head>

<body>
    <?php

    include('./config/functions.php');

    session_start();

    if (!isset($_SESSION['name'])) {
        header('Location: login.php');
    } else {



        $errors = ['old_password' => '', 'new_password' => '', 'repeat_password' => ''];
        if (isset($_POST['changePsw'])) {
            if (empty($_POST['old_password'])) {
                $errors['old_password'] = "Nu poți lăsa acest câmp gol!";
            } else {
                $old_password = $_POST['old_password'];
                $user = new Users();
                if ($user->verifyUser($_SESSION['userEmail'], $old_password)) {
                    if (empty($_POST['psw'])) {
                        $errors['new_password'] = "Parola nouă nu poate fi goală!";
                    } else {
                        $new_password = $_POST['psw'];
                        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/', $new_password)) {
                            $errors['new_password'] = "Parola nouă Trebuie să aibă formatul sugerat!";
                        } else if ($new_password == $old_password) {
                            $errors['new_password'] = "Parola nouă nu poate coincide cu cea veche!";
                        } else {
                            if (empty($_POST['repeat'])) {
                                $errors['repeat_password'] = "Nu poți lăsa acest câmp gol!";
                            } else if ($_POST['repeat'] != $new_password) {
                                $errors['repeat_password'] = "Valoarea din acest câmp trebuie să coincidă cu noua parolă!";
                            } else {
                                $repeat_password = $_POST['repeat'];
                                try {
                                    $user->updatePassword($_SESSION['userURL'], $new_password);
                                } catch (Exception $e) {
                                    echo $e->getMessage();
                                }
                            }
                        }
                    }
                } else {
                    $errors['old_password'] = "Parola nu e corectă!";
                }
            }
        }



    ?>


        <div class="content">
            <?php
            include('./templates/left.php'); ?>

            <div class="right_content">
                <?php
                include('./templates/nav.php');
                if (!isset($_GET['user']) || $_GET['user'] == $_SESSION['userURL']) { ?>

                    <div class="profile">
                        <div class="profile_cover">
                            <div class="cover_image <?php echo $_SESSION['userCover']; ?>">
                                <div class="image_hover">
                                    <p>Click pentru a alege altă imagine</p>
                                </div>
                            </div>
                            <div class="profile_image">
                                <div class="profile_container">

                                    <img src="<?php if ($_SESSION['userProfile']) {
                                                    echo $_SESSION['userProfile'];
                                                } ?>" alt="">
                                    <div class="profile_hover">
                                        <svg width="40" height="30" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 3L6.7396 1.8906C7.11053 1.3342 7.73499 1 8.4037 1H11.5963C12.265 1 12.8895 1.3342 13.2604 1.8906L14 3H19V14H1V3H6Z" stroke="#444444" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10 11C11.6569 11 13 9.65685 13 8C13 6.34315 11.6569 5 10 5C8.34315 5 7 6.34315 7 8C7 9.65685 8.34315 11 10 11Z" stroke="#444444" stroke-width="1.5" />
                                        </svg>

                                    </div>
                                </div>
                            </div>
                            <div class="profile_name">
                                <h2 class="left_text regular"><?php echo $_SESSION['name']; ?></h2>
                                <?php
                                $reward = new Rewards();
                                $title_ids = $reward->getUnlockedTitles($_SESSION['user_id']); ?>
                                <h4 id="selectedTitle">
                                    <?php
                                    if ($title_ids) {
                                        foreach ($title_ids as $t) {
                                            if ($t['selected'] == 1) {
                                                $thisTitle = $reward->getRewardById($t['reward_id']);
                                                echo $thisTitle['name'];
                                            }
                                        }
                                    }
                                    ?>
                                </h4>
                            </div>
                        </div>
                        <div id="chooseCover" class="modal">

                            <!-- Modal content -->
                            <div class="modal-content">
                                <svg id="close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.31 13.31">
                                    <path d="M37.73,39.06a1,1,0,0,1-.71-.29L25.71,27.46a1,1,0,0,1,0-1.42,1,1,0,0,1,1.41,0L38.44,37.36a1,1,0,0,1,0,1.41A1,1,0,0,1,37.73,39.06Z" transform="translate(-25.42 -25.75)" />
                                    <path d="M26.42,39.06a1,1,0,0,1-.71-.29,1,1,0,0,1,0-1.41L37,26a1,1,0,1,1,1.42,1.42L27.12,38.77A1,1,0,0,1,26.42,39.06Z" transform="translate(-25.42 -25.75)" />
                                </svg>
                                <h3 class="left_text">Alege o imagine de copertă</h3>

                                <div class="choose_cimage">
                                    <div class="cover1"></div>
                                    <div class="cover2"></div>
                                    <div class="cover3"></div>
                                    <div class="cover4"></div>
                                    <div class="cover5"></div>
                                    <div class="cover6"></div>
                                </div>
                            </div>

                        </div>
                        <div id="chooseProfile" class="modal">

                            <!-- Modal content -->
                            <div class="modal-content">
                                <div class="">
                                    <svg id="close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.31 13.31">
                                        <path d="M37.73,39.06a1,1,0,0,1-.71-.29L25.71,27.46a1,1,0,0,1,0-1.42,1,1,0,0,1,1.41,0L38.44,37.36a1,1,0,0,1,0,1.41A1,1,0,0,1,37.73,39.06Z" transform="translate(-25.42 -25.75)" />
                                        <path d="M26.42,39.06a1,1,0,0,1-.71-.29,1,1,0,0,1,0-1.41L37,26a1,1,0,1,1,1.42,1.42L27.12,38.77A1,1,0,0,1,26.42,39.06Z" transform="translate(-25.42 -25.75)" />
                                    </svg>
                                </div>
                                <h3 class="left_text">Alege o imagine de profil</h3>

                                <div class="choose_pimage">
                                    <div class="profile"><img src="./img/faces/face1-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face2-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face3-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face4-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face5-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face6-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face7-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face8-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face9-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face10-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face11-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face12-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face13-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face14-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face15-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face16-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face17-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face18-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face19-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face20-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face21-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face22-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face23-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face24-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face25-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face26-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face27-01.png" alt=""></div>
                                    <div class="profile"><img src="./img/faces/face28-01.png" alt=""></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="flex" style="margin-top: 7vh;">
                        <div class="update_credentials">

                            <div>
                                <label for="change username">Schimbă numele</label>
                                <div class="flex">
                                    <h3 class="left_text regular gray-text" id="updateName">
                                        <?php echo $_SESSION['name']; ?></h3>
                                    <svg id="refresh" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 18">
                                        <defs>
                                            <style>
                                                .cls-1 {
                                                    fill: none;
                                                    stroke: #231f20;
                                                    stroke-linecap: round;
                                                    stroke-width: 2px;

                                                }
                                            </style>
                                        </defs>
                                        <path class="cls-1" d="M44.14,28.75l-3,3-3-3" transform="translate(-24.14 -19.75)" />
                                        <path class="cls-1" d="M33.14,36.75a8,8,0,1,1,8-8v2" transform="translate(-24.14 -19.75)" />
                                    </svg>
                                </div>

                            </div>
                            <br>
                            <div class="changeEmail">
                                <form action="profil.php" method="post">
                                    <label for="schimba email">
                                        Schimbă emailul
                                    </label>
                                    <div class="flex">
                                        <input type="text" id="changeEmail" name="changeEmail" placeholder="<?php echo $_SESSION['userEmail'] ?>">
                                        <button id="changeEmailBtn">Schimbă</button>
                                    </div>
                                </form>

                                <p class="errors"></p>

                                <div id="changeEmailModal" class="modal">

                                    <!-- Modal content -->
                                    <div class="modal-content">
                                        <div class="closeEmail">
                                            <svg id="close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.31 13.31">
                                                <path d="M37.73,39.06a1,1,0,0,1-.71-.29L25.71,27.46a1,1,0,0,1,0-1.42,1,1,0,0,1,1.41,0L38.44,37.36a1,1,0,0,1,0,1.41A1,1,0,0,1,37.73,39.06Z" transform="translate(-25.42 -25.75)" />
                                                <path d="M26.42,39.06a1,1,0,0,1-.71-.29,1,1,0,0,1,0-1.41L37,26a1,1,0,1,1,1.42,1.42L27.12,38.77A1,1,0,0,1,26.42,39.06Z" transform="translate(-25.42 -25.75)" />
                                            </svg>
                                        </div>
                                        <h3 class="regular">Codul primit pe noua adresă:</h3>
                                        <p id="generatedCode"></p>

                                        <input type="text" name="changeEmailConfirm" id="changeEmailConfirm">
                                        <button id="submitChangeEmail">Schimbă emailul</button>
                                    </div>

                                </div>


                            </div>
                            <br>
                            <div class="changePassword">
                                <form action="profil.php" method="post">

                                    <label for="schimba parola">
                                        Schimbă parola
                                    </label>

                                    <div class="flex">
                                        <label for="schimba parola">Parola veche</label>
                                        <div class="tooltip">
                                            <svg width="13" height="13" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" fill="#8791c8" clip-rule="evenodd" d="M17 8.5C17 13.1944 13.1944 17 8.5 17C3.80558 17 0 13.1944 0 8.5C0 3.80558 3.80558 0 8.5 0C13.1944 0 17 3.80558 17 8.5ZM8 6.5V5H9V6.5H8ZM9 12V8H8V12H9Z" fill="#121923" />
                                            </svg>
                                            <p class="tooltiptext">Trebuie să îți introduci parola veche</p>
                                        </div>
                                    </div>
                                    <input type="password" name="old_password" id="old_password">
                                    <p class="errors"><?php echo $errors['old_password']; ?></p>
                                    <div class="flex">
                                        <label for="schimba parola">Parola nouă</label>
                                        <div class="tooltip">
                                            <svg width="13" height="13" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" fill="#8791c8" clip-rule="evenodd" d="M17 8.5C17 13.1944 13.1944 17 8.5 17C3.80558 17 0 13.1944 0 8.5C0 3.80558 3.80558 0 8.5 0C13.1944 0 17 3.80558 17 8.5ZM8 6.5V5H9V6.5H8ZM9 12V8H8V12H9Z" fill="#121923" />
                                            </svg>
                                            <p class="tooltiptext">Trebuie să îți introduci o parolă nouă</p>
                                        </div>
                                    </div>
                                    <input type="password" name="psw" id="psw">
                                    <div class="message">
                                        <p class="invalid" id="capital">O <strong>literă mare</strong></p>
                                        <p class="invalid" id="letter">O <strong>literă mică</strong></p>
                                        <p class="invalid" id="number">Un <strong>număr</strong></p>
                                        <p class="invalid" id="length">Cel puțin <strong>8 caractere</strong></p>
                                    </div>
                                    <p class="errors"><?php echo $errors['new_password']; ?></p>
                                    <div class="flex">
                                        <label for="schimba parola">
                                            Confirmă parola nouă
                                        </label>
                                        <div class="tooltip">
                                            <svg width="13" height="13" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" fill="#8791c8" clip-rule="evenodd" d="M17 8.5C17 13.1944 13.1944 17 8.5 17C3.80558 17 0 13.1944 0 8.5C0 3.80558 3.80558 0 8.5 0C13.1944 0 17 3.80558 17 8.5ZM8 6.5V5H9V6.5H8ZM9 12V8H8V12H9Z" fill="#121923" />
                                            </svg>
                                            <p class="tooltiptext">Trebuie să îți confirmi parola introdusă</p>
                                        </div>
                                    </div>
                                    <input type="password" name="repeat" id="repeat">
                                    <div class="message">
                                        <p class="invalid" id="confirm">Parolele nu se potrivesc!</p>
                                        <p class="valid hidden" id="confirm2">Parolele se potrivesc!</p>
                                    </div>
                                    <p class="errors"><?php echo $errors['repeat_password']; ?></p>
                                    <input type="submit" name="changePsw" id="changePsw" value="Schimbă">

                                </form>
                            </div>
                        </div>
                        <div class="progress flex">
                            <div class="single_ring">
                                <div class="ring">
                                    <svg class="progress-ring" width="230" height="230">
                                        <circle class="progress-ring__circle course_progress" stroke="#a1ebff" stroke-width="15" fill="transparent" r="100" cx="115" cy="115" />
                                    </svg>
                                    <?php
                                    $user = new Users();
                                    $ctarget = $user->getCourseTargetbyId($_SESSION['user_id']);
                                    $progress = new Progress();
                                    $course_progress = $progress->getTotalCoursePoints($_SESSION['user_id']);
                                    ?>
                                    <p class="ringtext" id="<?php echo $course_progress / $ctarget; ?>"><?php echo $course_progress; ?><span class="total">/<?php echo $ctarget; ?></span></p>

                                </div>
                                <p class="ringtitle">Puncte din cursuri</p>
                            </div>

                            <div div class="single_ring">
                                <div class="ring">
                                    <svg class="progress-ring" width="230" height="230">
                                        <circle class="progress-ring__circle community_progress" stroke="#ed7e7e" stroke-width="15" fill="transparent" r="100" cx="115" cy="115" />
                                    </svg>
                                    <?php
                                    $community_progress = $user->getTotalCommunityPoints($_SESSION['user_id']);
                                    $comm_target = $user->getCommunityTargetbyId($_SESSION['user_id']);

                                    ?>
                                    <p class="ringtext" id="<?php echo $community_progress / $comm_target; ?>"><?php echo $community_progress; ?><span class="total">/<?php echo $comm_target; ?></span></p>

                                </div>
                                <p class="ringtitle">Puncte din comunitate</p>
                            </div>

                        </div>
                    </div>
                    <hr class="separator_dots" style="align-self:center">
                    <div class="badges_section">
                        <h3 class="regular left_text">Insignele tale</h3>
                        <div class="badges">
                            <?php
                            $badges = array();
                            $temp_badge = ['id' => 0, 'url' => ''];

                            $badge_ids = $reward->getUnlockedBadges($_SESSION['user_id']);
                            if ($badge_ids) {
                                foreach ($badge_ids as $badge_id) {
                                    $r = $reward->getRewardById($badge_id['reward_id']);
                                    $temp_badge['id'] = $r['id'];
                                    $temp_badge['url'] = $r['url'];
                                    array_push($badges, $temp_badge);
                                }
                            }
                            foreach ($badges as $badge) { ?>
                                <img src="<?php echo $badge['url']; ?>" alt="" id="<?php echo $badge['id'] ?>" class="<?php
                                                                                                                        if ($reward->isSelected($badge['id'], $_SESSION['user_id'])) {
                                                                                                                            echo "selected";
                                                                                                                        }
                                                                                                                        ?>">
                            <?php } ?>


                        </div>
                    </div>
                    <hr class="separator_dots" style="align-self:center">
                    <div class="titles_section">
                        <h3 class="regular left_text">Titlurile tale</h3>
                        <div class="titles">
                            <?php
                            $titles = array();
                            $temp_title = ['id' => 0, 'name' => '', 'category' => 0];
                            if ($title_ids) {
                                foreach ($title_ids as $title_id) {
                                    $title = $reward->getRewardById($title_id['reward_id']);
                                    if ($title['category'] == 1) {
                                        $class = "community_title";
                                    } else if ($title['category'] == 2) {
                                        $class = "course_title";
                                    } ?>
                                    <button class="<?php echo $class; ?> title_reward regular <?php
                                                                                                if ($reward->isSelected($title['id'], $_SESSION['user_id'])) {
                                                                                                    echo "selected";
                                                                                                }
                                                                                                ?>" id="<?php echo $title['id'] ?>">
                                        <?php echo $title['name']; ?>
                                    </button>
                            <?php }
                            } ?>

                        </div>
                    </div>
                    <hr class="separator_dots" style="align-self:center">

                    <?php if ($user->isAdmin($_SESSION['user_id'])) { ?>
                        <div class="admin">
                            <h3 class="regular left_text">Privilegii administrator</h3>
                            <br>
                            <p class="regular">Încarcă un curs nou</p>
                            <a href="form.php">
                                <button style="margin-left: 0;" class="regular">Încarcă un curs</button>
                            </a>
                            <br><br>
                            <p class="regular">Schimbă starea unui cont</p>
                            <div id="changeStatus" class="flex">
                                <?php $allUsers = $user->getAllUsers();
                                if ($allUsers) { ?>
                                    <select name="" id="selectUser" style="margin-left: 0;">
                                        <option value="0" disabled selected>Selectează</option>
                                        <?php foreach ($allUsers as $platformUser) {
                                            if ($platformUser['url'] != $_SESSION['userURL']) {
                                        ?>
                                                <option value="<?php echo $platformUser['url']; ?>"><?php echo $platformUser['name']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                    <select name="" id="selectStatus" disabled>
                                        <option value="0" disabled selected>Selectează</option>

                                        <?php
                                        $s = $user->getAllStatus();
                                        foreach ($s as $status) { ?>
                                            <option value="<?php echo $status['id']; ?>"><?php echo $status['status']; ?></option>
                                        <?php }
                                        ?>

                                    </select>
                                <?php
                                }
                                ?>

                            </div>
                            <p id="success"></p>

                        </div>
                    <?php } ?>
                    <div style="height: 300px;">

                    </div>
                    <?php } else {
                    $user = new Users();
                    $thisUser = $user->getUserbyURL($_GET['user']);
                    if ($thisUser) {


                    ?>
                        <div class="profile">
                            <div class="profile_cover">
                                <div class="cover_image <?php echo $thisUser['cover_image']; ?>">
                                </div>
                                <div class="profile_image">
                                    <div class="profile_container">

                                        <img src="<?php if ($thisUser['profile_image']) {
                                                        echo $thisUser['profile_image'];
                                                    } ?>" alt="">

                                    </div>
                                </div>
                                <div class="profile_name">
                                    <h2 class="left_text regular"><?php echo $thisUser['name'];

                                                                    ?></h2>
                                    <?php
                                    $reward = new Rewards();
                                    $unlocked_titles = $reward->getUnlockedTitles($thisUser['id']);
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
                        <div class="progress flex" style="margin-top: 100px;">
                            <div class="single_ring">
                                <div class="ring">
                                    <svg class="progress-ring" width="230" height="230">
                                        <circle class="progress-ring__circle course_progress" stroke="#a1ebff" stroke-width="15" fill="transparent" r="100" cx="115" cy="115" />
                                    </svg>
                                    <?php

                                    $ctarget = $thisUser['course_target'];
                                    $progress = new Progress();
                                    $course_progress = $progress->getTotalCoursePoints($thisUser['id']);
                                    ?>
                                    <p class="ringtext" id="<?php echo $course_progress / $ctarget; ?>"><?php echo $course_progress; ?><span class="total">/<?php echo $ctarget; ?></span></p>

                                </div>
                                <p class="ringtitle">Puncte din cursuri</p>
                            </div>
                            <div div class="single_ring">
                                <div class="ring">
                                    <svg class="progress-ring" width="230" height="230">
                                        <circle class="progress-ring__circle community_progress" stroke="#ed7e7e" stroke-width="15" fill="transparent" r="100" cx="115" cy="115" />
                                    </svg>
                                    <?php
                                    $community_progress = $user->getTotalCommunityPoints($thisUser['id']);
                                    $comm_target = $user->getCommunityTargetbyId($thisUser['id']);

                                    ?>
                                    <p class="ringtext" id="<?php echo $community_progress / $comm_target; ?>"><?php echo $community_progress; ?><span class="total">/<?php echo $comm_target; ?></span></p>

                                </div>
                                <p class="ringtitle">Puncte din comunitate</p>
                            </div>
                        </div>
                        <?php

                        $unlocked_badges = $reward->getUnlockedBadges($thisUser['id']);
                        ?>
                        </br>
                        </br>
                        </br>
                        </br>
                        <hr class="separator_dots" style="align-self:center">


                        <div class="badges_section">
                            <h3 class="regular">Insignele utilizatorului</h3>
                            <div class="badges">
                                <?php
                                if ($unlocked_badges) {
                                    foreach ($unlocked_badges as $unlocked_badge) {
                                        $badge = $reward->getRewardById($unlocked_badge['reward_id']);
                                ?>
                                        <img src="<?php echo $badge['url'] ?>" alt="" class="<?php if ($unlocked_badge['selected'] == 1) {
                                                                                                    echo "selected";
                                                                                                } ?>">
                                <?php }
                                } ?>
                            </div>
                        </div>
                        </br>
                        </br>
                        </br>
                        </br>
                        <hr class="separator_dots" style="align-self:center">
                        <div class="titles_section">
                            <h3 class="regular">Titlurile utilizatorului</h3>
                            <div class="titles">

                                <?php
                                if ($unlocked_titles) {
                                    foreach ($unlocked_titles as $unlocked_title) {
                                        $title = $reward->getRewardById($unlocked_title['reward_id']);
                                ?>
                                        <div class="title_rwd" style="background-color:<?php if ($title['category'] == 2) {
                                                                                            echo "rgb(112, 224, 255)";
                                                                                        } else {
                                                                                            echo "rgb(237,126,126)";
                                                                                        } ?>;">
                                            <p><?php echo $title['name']; ?></p>
                                        </div>

                                <?php }
                                } ?>

                            </div>
                        </div>
                        <div style="height: 300px;">
                        </div>
                <?php
                    }
                }
                ?>


            </div>
        </div>
    <?php

        include('./templates/footer.php');
    }

    ?>