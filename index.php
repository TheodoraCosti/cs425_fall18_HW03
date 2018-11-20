<?php
// Start session
session_start();
?>
<!DOCTYPE HTML>
<html>

    <head>
        <title>EPL425 Question Game-Home Page</title>
        <meta name="author" content="Theodora Costi">
        <meta name="description" content="Homework 3, CS425 Fall2018, University of Cyprus - Home Page">
        <meta name="keywords" content="Homework3, EPL425, Fall18, PHP, HomePage, QuizGame, QuestionGame">
        <meta http-equiv="content-type" content="text/html" charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
    </head>

    <body> 
        <a name="top"></a>
        <div id="main">
            <div id="header">
                <div id="logo">
                    <div id="logo_text">
                        <h1><a href="index.php">QUESTION<span class="logo_colour"> GAME</span></a></h1>
                        <h2>Test Your Knowledge. Enjoy The Game.</h2>
                    </div>
                </div>
                <div id="menubar">
                    <ul id="menu">
                        <li class="selected"><a href="index.php">Home</a></li>
                        <li><a href="help.php">Help</a></li>
                        <li><a href="high_scores.php">High Scores</a></li>
                    </ul>
                </div>
            </div>
            <?php
            // Load the XML file 
            $xml = simplexml_load_file("quiz.xml") or die("Error: Cannot create object");
            ?>
            <div id="site_content">
                <div id="content">
                    <form action="index.php" method="post">
                        <div <?php
                        if (isset($_POST['start']) || isset($_POST['next']) || isset($_POST['finish']) || isset($_POST['yes'])) {
                            ?>
                                style="display: none;"
                            <?php } elseif (isset($_POST['no']) || isset($_POST['end'])) {
                                ?>
                                style="display: block;"
                                <?php
                            }
                            ?>>
                            <h1>Welcome to EPL425 Trivia Question Game!</h1>
                            <input type="submit" name="start" value="START">
                        </div>
                    </form>
                    <form action="index.php" method="post">
                        <div <?php
                        if (isset($_POST['start']) || isset($_POST['next'])) {
                            ?>
                                style="display: block;"
                                <?php
                            } else {
                                ?>
                                style="display: none;"
                                <?php
                            }
                            ?>>
                                <?php
                                if (isset($_POST['start'])) {
                                    session_destroy();  // Destroy all sessions that have started
                                    session_start();    //Create new session for new game
                                    $count = 0;
                                    while ($count < 25) {   //Initialize the visited question arrays with zero->false
                                        $vEasy[$count] = 0;
                                        $vMedium[$count] = 0;
                                        $vAdvance[$count] = 0;
                                        $count++;
                                    }
                                    $result_array = [];
                                    $_SESSION['result_array'] = $result_array;
                                    $qNum = sizeof($_SESSION['result_array']) + 1;
                                    echo "<h3>Question No# $qNum </h3>";    //Print Question number
                                    $rand_question = rand(0, 24);   //Get a random question
                                    $level="MEDIUM";
                                    $vMedium[$rand_question] = 1;   //Game begins with medium question so make this question 1->true
                                    $question = $xml->$level->Question[$rand_question]["Text"];
                                    $answerA = $xml->$level->Question[$rand_question]->answer[0];
                                    $answerB = $xml->$level->Question[$rand_question]->answer[1];
                                    $answerC = $xml->$level->Question[$rand_question]->answer[2];
                                    $result_array2 = [];
                                    $result_array2[0] = "MEDIUM";
                                    if ($answerA["Correct"] === "true") {
                                        $result_array2[1] = 1;
                                    } elseif ($answerB["Correct"] == "true") {
                                        $result_array2[1] = 2;
                                    } else {
                                        $result_array2[1] = 3;
                                    }
                                    $_SESSION['result_array'][0] = $result_array2;
                                    $_SESSION['v_easy'] = $vEasy;
                                    $_SESSION['v_medium'] = $vMedium;
                                    $_SESSION['v_advance'] = $vAdvance;
                                }
                                if (isset($_POST['next'])) {
                                    $player_ans = $_POST['answer'];
                                    switch ($player_ans) {
                                        case "1": {
                                                $_SESSION['result_array'][sizeof($_SESSION['result_array']) - 1][2] = 1;
                                                break;
                                            }
                                        case "2": {
                                                $_SESSION['result_array'][sizeof($_SESSION['result_array']) - 1][2] = 2;
                                                break;
                                            }
                                        case "3": {
                                                $_SESSION['result_array'][sizeof($_SESSION['result_array']) - 1][2] = 3;
                                                break;
                                            }
                                    }
                                    if ($_SESSION['result_array'][sizeof($_SESSION['result_array']) - 1][1] !== $_SESSION['result_array'][sizeof($_SESSION['result_array']) - 1][2]) {
                                        switch ($_SESSION['result_array'][sizeof($_SESSION['result_array']) - 1][0]) {
                                            case "EASY": {
                                                    $level = "EASY";
                                                    break;
                                                }
                                            case "MEDIUM": {
                                                    $level = "EASY";
                                                    break;
                                                }
                                            case "ADVANCE": {
                                                    $level = "MEDIUM";
                                                    break;
                                                }
                                        }
                                    } else {
                                        switch ($_SESSION['result_array'][sizeof($_SESSION['result_array']) - 1][0]) {
                                            case "EASY": {
                                                    $level = "MEDIUM";
                                                    break;
                                                }
                                            case "MEDIUM": {
                                                    $level = "ADVANCE";
                                                    break;
                                                }
                                            case "ADVANCE": {
                                                    $level = "ADVANCE";
                                                    break;
                                                }
                                        }
                                    }
                                    $rand_question = rand(0, 24);
                                    switch ($level) {
                                        case "EASY": {
                                                while ($_SESSION['v_easy'][$rand_question] === 1) {
                                                    $rand_question = rand(0, 24);
                                                }
                                                $_SESSION['v_easy'][$rand_question] = 1;
                                                break;
                                            }
                                        case "MEDIUM": {
                                                while ($_SESSION['v_medium'][$rand_question] === 1) {
                                                    $rand_question = rand(0, 24);
                                                }
                                                $_SESSION['v_medium'][$rand_question] = 1;
                                                break;
                                            }
                                        case "ADVANCE": {
                                                while ($_SESSION['v_advance'][$rand_question] === 1) {
                                                    $rand_question = rand(0, 24);
                                                }
                                                $_SESSION['v_advance'][$rand_question] = 1;
                                                break;
                                            }
                                    }
                                    $qNum = sizeof($_SESSION['result_array']) + 1;
                                    echo "<h3>Question No# $qNum </h3>";
                                    $question = $xml->$level->Question[$rand_question]["Text"];
                                    $answerA = $xml->$level->Question[$rand_question]->answer[0];
                                    $answerB = $xml->$level->Question[$rand_question]->answer[1];
                                    $answerC = $xml->$level->Question[$rand_question]->answer[2];
                                    $result_array2 = [];
                                    $result_array2[0] = $level;
                                    if ($answerA["Correct"] == "true") {
                                        $result_array2[1] = 1;
                                    } elseif ($answerB["Correct"] == "true") {
                                        $result_array2[1] = 2;
                                    } else {
                                        $result_array2[1] = 3;
                                    }
                                    $_SESSION['result_array'][sizeof($_SESSION['result_array'])] = $result_array2;
                                }
                                if (isset($_POST['finish'])) {
                                    $player_ans = $_POST['answer'];
                                    switch ($player_ans) {
                                        case "1": {
                                                $_SESSION['result_array'][sizeof($_SESSION['result_array']) - 1][2] = 1;
                                                break;
                                            }
                                        case "2": {
                                                $_SESSION['result_array'][sizeof($_SESSION['result_array']) - 1][2] = 2;
                                                break;
                                            }
                                        case "3": {
                                                $_SESSION['result_array'][sizeof($_SESSION['result_array']) - 1][2] = 3;
                                                break;
                                            }
                                    }
                                }
                                ?>
                            <h3><?php echo $question; ?></h3>
                            <h4><input type="radio" name="answer" value="1"> <?php echo $answerA; ?></input></h4><br>
                            <h4><input type="radio" name="answer" value="2"> <?php echo $answerB; ?></input></h4><br>
                            <h4><input type="radio" name="answer" value="3"> <?php echo $answerC; ?></input></h4><br>
                            <?php
                            $qNum = sizeof($_SESSION['result_array']);
                            $questionsLeft = 5 - $qNum;
                            if ($qNum < 5) {
                                ?>
                                <input type="submit" name="next" value="NEXT">
                                <?php
                            } else {
                                ?>
                                <input type="submit" name="finish" value="FINISH">
                                <?php
                            }
                            ?>	
                            <input type="submit" name="end" value="END">
                            <div class="row">
                                <div class="column">
                                    <h3><?php echo $questionsLeft; ?> questions left</h3>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="index.php" method="post">
                        <div  
                        <?php
                        if (isset($_POST['finish'])) {
                            ?>
                                style="display: block"
                                <?php
                            } else {
                                ?>
                                style="display: none;"
                                <?php
                            }
                            ?>>
                                <?php
                                $score = 0;
                                $count2 = 0;
                                while ($count2 < sizeof($_SESSION['result_array'])) {
                                    if ($_SESSION['result_array'][$count2][1] === $_SESSION['result_array'][$count2][2]) {
                                        switch ($_SESSION['result_array'][$count2][0]) {
                                            case "EASY": {
                                                    $score++;
                                                    break;
                                                }
                                            case "MEDIUM": {
                                                    $score += 5;
                                                    break;
                                                }
                                            case "ADVANCE": {
                                                    $score += 10;
                                                    break;
                                                }
                                        }
                                    }
                                    $count2++;
                                }
                                ?>
                            <table>
                                <tr>
                                    <th>Question No#</th>
                                    <th>Difficulty level</th>
                                    <th>Your answer</th>
                                    <th>Points earned</th>
                                </tr>
                                <?php
                                $count3 = 0;
                                while ($count3 < sizeof($_SESSION['result_array'])) {
                                    ?>
                                    <tr>
                                        <th><?php echo $count3 + 1; ?></th>
                                        <th><?php echo $_SESSION['result_array'][$count3][0]; ?></th>
                                        <th><?php
                                            if ($_SESSION['result_array'][$count3][1] !== $_SESSION['result_array'][$count3][2]) {
                                                echo "INCORRECT";
                                            } else {
                                                echo "CORRECT";
                                            }
                                            ?></th>
                                        <th><?php
                                            if ($_SESSION['result_array'][$count3][1] !== $_SESSION['result_array'][$count3][2]) {
                                                echo "0";
                                            } else {
                                                if ($_SESSION['result_array'][$count3][0] === "EASY") {
                                                    echo "1";
                                                } elseif ($_SESSION['result_array'][$count3][0] === "MEDIUM") {
                                                    echo "5";
                                                } else {
                                                    echo "10";
                                                }
                                            }
                                            ?></th>
                                    </tr>
                                    <?php
                                    $count3++;
                                }
                                ?>
                            </table>
                            <h4>Overall score:<?php echo "$score"; ?> points</h4>
                            <h4>Would you like to save your score? <input type="submit" name="yes" value="YES"> <input type="submit" name="no" value="NO"></h4>
                        </div>
                    </form>
                    <form action="index.php" method="post">
                        <div 
                        <?php if (isset($_POST['yes'])) { ?>
                                style="display: block;"
                            <?php } else {
                                ?>
                                style="display: none;"
                            <?php }
                            ?>>
                            <h4>Give a nickname:</h4>
                            <input type="text" name="nickname" id="nickname" placeholder="Enter your nickname..." maxlength="10" required><br>
                            <input type="submit" name="save" value="SAVE">
                            <?php
                            if (isset($_POST['save'])) {
                                $total = 0;
                                $count4 = 0;
                                while ($count4 < sizeof($_SESSION['result_array'])) {
                                    if ($_SESSION['result_array'][$count4][1] === $_SESSION['result_array'][$count4][2]) {
                                        switch ($_SESSION['result_array'][$count4][0]) {
                                            case "EASY": {
                                                    $total++;
                                                    break;
                                                }
                                            case "MEDIUM": {
                                                    $total += 5;
                                                    break;
                                                }
                                            case "ADVANCE": {
                                                    $total += 10;
                                                    break;
                                                }
                                        }
                                    }
                                    $count4++;
                                }
                            }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
            <footer>
                <button id="myBtn"><a href="#top" style="color: black">Top</a></button>
            </footer>
        </div>
    </body>
</html>
