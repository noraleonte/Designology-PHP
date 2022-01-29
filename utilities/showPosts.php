<?php
include('../includes/autoload.php');
session_start();
if (!empty($_POST['topic'])) {
    $community = new Community();
    if (!empty($_POST['user'])) {
        if ($_POST['user']) {
            if ($_POST['liked']) {
                if ($_POST['topic'] == -1) {
                    $posts = $community->getAllLikedPosts($_SESSION['user_id']);
                } else {
                    $posts = $community->getLikedPostsByTopic($_POST['topic'], $_SESSION['user_id']);
                }
            } else {
                if ($_POST['topic'] == -1) {
                    $posts = $community->getAllPostsbyUser($_SESSION['user_id']);
                } else {
                    $posts = $community->getPostsByTopicbyUser($_POST['topic'], $_SESSION['user_id']);
                }
            }
        } else {
            if ($_POST['topic'] == -1) {
                $posts = $community->getAllPosts();
            } else {
                $posts = $community->getPostsByTopic($_POST['topic']);
            }
        }
    } else {
        if ($_POST['topic'] == -1) {
            $posts = $community->getAllPosts();
        } else {
            $posts = $community->getPostsByTopic($_POST['topic']);
        }
    }


    $reward = new Rewards();

    if ($posts) {

        echo "<div class=\"recent_posts\">";
        foreach ($posts as $post) {
            $selected_title = $reward->getSelectedTitles($post['user_id']);
            $likeNumber = $community->countLikes($post['id']);
            $commentNumber = $community->countComments($post['id']);

            echo "<div class=\"post\" id=\"" . $post['id'] . "\">
                                        <div class=\"user_details\">";
            if ($post['profile_image']) {
                echo  "<div class=\"profile_img\"><img src=\"" . $post['profile_image'] . "\" alt=\"\"></div>";
            }
            echo "<div class=\"details\">
                                            <a href=\"./profil.php?user=" . $post['url'] . "\"><p class=\"user_name\">" . $post['user_name'] . "</p></a>
                                                <p class=\"user_title\">" . $selected_title . "</p>
                                            </div>
                                        </div>
                                        <div class=\"post_content\">
                                        <p class=\"semi-bold uppercase\">" . $post['topic_name'] . "</p>
                                            <p class=\"regular\">" . $post['content'] . "</p>
                                        </div>
                                        <div class=\"reactions\">
                                            <div class=\"likes\">
                                                <div class=\"appreciate ";
            if ($community->getLike($_SESSION['user_id'], $post['id'])) {
                echo "appreciated";
            }
            echo "\">
                                                    <svg id=\"appreciate_svg\" width=\"24\" height=\"22\" viewBox=\"0 0 24 22\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                                        <path d=\"M12 20L10.55 18.7052C5.4 14.1243 2 11.103 2 7.3951C2 4.37384 4.42 2 7.5 2C9.24 2 10.91 3.24441 12 4.5C13.09 3.24441 14.76 2 16.5 2C19.58 2 22 4.37384 22 7.3951C22 11.103 18.6 14.1243 13.45 18.715L12 20Z\" stroke=\"#808080\" stroke-width=\"2\" stroke-linejoin=\"round\" />
                                                    </svg>
                                                </div>
                                                <p class=\"stats\"><span class=\"likes_number\">";
            if ($likeNumber == 1) {
                echo "O";
            } else if ($likeNumber == 2) {
                echo "DOUĂ";
            } else {
                echo $likeNumber;
            }
            echo "</span> <span>";
            if ($likeNumber == 1) {
                echo "apreciere";
            } else {
                echo "aprecieri";
            }
            echo "</span></p>
                                            </div>

                                            <div class=\"\">

                                                <p class=\"comments\"><span class=\"number\">";
            if ($commentNumber == 1) {
                echo "UN";
            } else if ($commentNumber == 2) {
                echo "DOUĂ";
            } else {
                echo $commentNumber;
            }
            echo "</span>";
            if ($commentNumber == 1) {
                echo " comentariu";
            } else {
                echo " comentarii";
            }
            echo "</p>
                                            </div>
                                        </div>
                                    </div>";
        }
    } else {
        echo "<div class=\"recent_posts\">";

        echo "Hmm...Se pare că nu a postat nimeni aici...";
        echo "</div>";
    }
    echo "</div>";
}
