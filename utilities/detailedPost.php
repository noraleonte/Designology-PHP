<?php
include('../includes/autoload.php');
session_start();
if (!empty($_POST['post_id'])) {
    $community = new Community();
    $post = $community->getPostDetails($_POST['post_id']);
    $reward = new Rewards();
    $selected_title =  $reward->getSelectedTitles($post['user_id']);
    $number = $community->countLikes($post['id']);
    if ($number == 1) {
        $stats = "O";
        $word = " Apreciere";
    } else if ($number == 2) {
        $stats = "DOUĂ";
        $word = " Aprecieri";
    } else if ($number == 0) {
        $stats = 0;
        $word = " Aprecieri";
    } else {
        $stats = $number;
        $word = " Aprecieri";
    }

    echo "<div id=\"" . $post['id'] . "\" class=\"modal post modal_post\">
            <div class=\"modal-content\">
                <svg id=\"close\" width=\"14\" height=\"14\" viewBox=\"0 0 14 14\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                        <path d=\"M12.6569 12.6569L1.34316 1.34315\" stroke=\"#808080\" stroke-width=\"2\" stroke-linecap=\"round\" />
                        <path d=\"M12.6568 1.34315L1.34314 12.6569\" stroke=\"#808080\" stroke-width=\"2\" stroke-linecap=\"round\" />
                </svg>    
            
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
                <div class=\"like\">";
    if ($community->getLike($_SESSION['user_id'], $post['id'])) {
        echo "
        <div class=\"likes\">
        <div class=\"appreciate appreciated\">
        
                    <svg width=\"24\" height=\"22\" viewBox=\"0 0 24 22\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                                <path d=\"M12 20L10.55 18.7052C5.4 14.1243 2 11.103 2 7.3951C2 4.37384 4.42 2 7.5 2C9.24 2 10.91 3.24441 12 4.5C13.09 3.24441 14.76 2 16.5 2C19.58 2 22 4.37384 22 7.3951C22 11.103 18.6 14.1243 13.45 18.715L12 20Z\" stroke=\"#808080\" stroke-width=\"2\" stroke-linejoin=\"round\" />
                                            </svg>
                                            </div>
                                            <p class=\"stats\"><span class=\"likes_number\">" . $stats . "</span> <span>" . $word . "</span></p>
                                            
                                            </div>
                                        </div>
                    ";
    } else {
        echo "<div class=\"appreciate\">
        <svg width=\"24\" height=\"22\" viewBox=\"0 0 24 22\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                    <path d=\"M12 20L10.55 18.7052C5.4 14.1243 2 11.103 2 7.3951C2 4.37384 4.42 2 7.5 2C9.24 2 10.91 3.24441 12 4.5C13.09 3.24441 14.76 2 16.5 2C19.58 2 22 4.37384 22 7.3951C22 11.103 18.6 14.1243 13.45 18.715L12 20Z\" stroke=\"#808080\" stroke-width=\"2\" stroke-linejoin=\"round\" />
                                </svg>
                            </div>
        ";
    }
    $comments = $community->getAllComments($post['id']);
    echo "
                <div class=\"multiple_comments\"> ";
    if ($comments) {
        foreach ($comments as $comment) {

            echo "
                    <div class=\"comment\">
                        <div class=\"user_details\">
                            <div class=\"profile_img\">
                                <img src=\"" . $comment['profile_image'] . "\" alt=\"\">
                            </div>
                            <div class=\"details\">
                                <p class=\"user_name\">" . $comment['user_name'] . "</p>
                            </div>
                        </div>
                        <div class=\"post_content\">
                            <p class=\"regular\">" . $comment['content'] . "</p>
                        </div>
                    </div>
                ";
        }
    }
    echo "</div>
        <div class=\"new_comment\">
        <input class=\"comment_content\" type=\"text\" id=\"" . $post['id'] . "\" placeholder=\"Adaugă un comentariu\">
        <svg class=\"add_comment\" width=\"21\" height=\"20\" viewBox=\"0 0 21 20\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                <path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M18.5622 9.10565C19.3031 9.47313 19.3031 10.5299 18.5622 10.8973L2.44436 18.8923C1.77965 19.222 1 18.7384 1 17.9964V12L10 10L1 7.79437L1 2.00654C1 1.26455 1.77966 0.780976 2.44437 1.11069L18.5622 9.10565Z\" stroke=\"#808080\" stroke-width=\"2\" stroke-linejoin=\"round\"/>
        </svg>

        </div>
    </div>
            </div>
        </div>";
}
