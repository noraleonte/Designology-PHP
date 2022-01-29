<?php
include('../includes/autoload.php');
session_start();
if (!empty($_POST['chapter_id'])) {
    $chapter_id = $_POST['chapter_id'];

    $progress = new Progress();
    try {
        $progress->setChapterProgress($_SESSION['userEmail'], $chapter_id);
        $totalPoints = $progress->getTotalCoursePoints($_SESSION['user_id']);
        $reward = new Rewards();
        $nextTarget = $reward->getNextReward($totalPoints, 2);
        $user = new Users();
        $currentTarget = $user->getCourseTargetbyId($_SESSION['user_id']);
        if ($currentTarget < $nextTarget['points_necessary']) {
            try {
                $user->setCourseTargetbyId($_SESSION['user_id'], $nextTarget['points_necessary']);
                $unlockedReward = $reward->unlockReward($currentTarget, $_SESSION['user_id'], 2);
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
                            <img src=\"" . $unlockedReward['url'] . "\" alt=\"\" style=\"width: 200px;\" class=\"badge_reward\">
                         
                            <button class=\"close\">
                            Închide
                            </button>
                    </div>

                </div>
                
            </div>";
                }
            } catch (Exception $e) {
            }
        } else {
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
