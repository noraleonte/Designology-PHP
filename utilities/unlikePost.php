<?php
include('../includes/autoload.php');
session_start();
if (!empty($_POST['post_id'])) {
    $community = new Community();
    try {
        $community->deleteLike($_SESSION['user_id'], $_POST['post_id']);
        $reward = new Rewards();

        $user = new Users();
        $user->updateCommunityProgress($_SESSION['user_id'], -1);
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
