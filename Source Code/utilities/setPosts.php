<?php
include('../includes/autoload.php');
session_start();
if (!empty($_POST['content']) && !empty($_POST['topic'])) {
    $community = new Community();
    try {
        $community->newPost($_SESSION['user_id'], $_POST['content'], $_POST['topic']);
        $reward = new Rewards();
        $selected_title = '';
        $unlocked_titles = $reward->getUnlockedTitles($_SESSION['user_id']);
        if ($unlocked_titles) {
            foreach ($unlocked_titles as $t) {
                if ($t['selected'] == 1) {
                    $title = $reward->getRewardById($t['reward_id']);
                    $selected_title = $title['name'];
                    break;
                }
            }
        }

        echo "<div class=\"recent_posts\">";
        echo "<div class=\"post\">
        <div class=\"user_details\">
            <div class=\"profile_img\">
                <img src=\"" . $_SESSION['userProfile'] . "\" alt=\"\">
            </div>
            <div class=\"details\">
                <p class=\"user_name\">" . $_SESSION['name'] . " </p>
                <p class=\"user_title\">" . $selected_title . "</p>
            </div>
        </div>
        <div class=\"post_content\">
            <p class=\"regular\">
                " . $_POST['content'] . "
        </div>
        <div class=\"reactions\">
            <div class=\"appreciate\">
                <svg width=\"24\" height=\"22\" viewBox=\"0 0 24 22\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                    <path d=\"M12 20L10.55 18.7052C5.4 14.1243 2 11.103 2 7.3951C2 4.37384 4.42 2 7.5 2C9.24 2 10.91 3.24441 12 4.5C13.09 3.24441 14.76 2 16.5 2C19.58 2 22 4.37384 22 7.3951C22 11.103 18.6 14.1243 13.45 18.715L12 20Z\" stroke=\"#808080\" stroke-width=\"2\" stroke-linejoin=\"round\" />
                </svg>
            </div>
            <div class=\"\">
                <p class=\"comments\"><span class=\"number\">0</span> comentarii</p>
            </div>
        </div>
    </div>
    </div>";

        $user = new Users();
        $user->updateCommunityProgress($_SESSION['user_id'], 5);
        $communityPoints = $user->getTotalCommunityPoints($_SESSION['user_id']);
        $currentTarget = $user->getCommunityTargetbyId($_SESSION['user_id']);
        if ($communityPoints >= $currentTarget) {
            $nextTarget = $reward->getNextReward($communityPoints, 1);
            $user->setCommunityTargetbyId($_SESSION['user_id'], $nextTarget['points_necessary']);
            $unlockedReward = $reward->unlockReward($currentTarget, $_SESSION['user_id'], 1);
            echo "<div id=\"congratulations\" class=\"modal\">

                
                <div class=\"modal-content\">
                
                    <h3 class=\"\">Felicitări!</h3>
        
                    <div class=\"reward\">";

            if ($unlockedReward['type'] == 1) {
                echo "
                            <h3 class=\"light\">Ai deblocat titlul: </h3>
                            <h2 class=\"regular\">" . $unlockedReward['name'] . "</h2>
                            <button class=\"close\">
                            Închide
                            </button>
                
                            </div>
                </div>
               
            </div>";
            } else {
                echo "<h3 class=\"light\">Ai deblocat insigna: </h3>
                            <img src=\"" . $unlockedReward['url'] . "\" alt=\"\" style=\"width: 15vw; min-width: 100px;\" class=\"badge_reward\">
                         
                            <button class=\"close\">
                            Închide
                            </button>
                    </div>

                </div>
                
            </div>";
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
