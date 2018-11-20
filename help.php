<!DOCTYPE HTML>
<html>

    <head>
        <title>EPL425 Question Game-Help Page</title>
        <meta name="author" content="Theodora Costi">
        <meta name="description" content="Homework 3, EPL425 Fall2018, University of Cyprus - Help Page">
        <meta name="keywords" content="Homework3, EPL425, Fall18, PHP, HelpPage, QuizGame, QuestionGame">
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
                        <!-- class="logo_colour", allows you to change the colour of the text -->
                        <h1><a href="index.php">QUESTION<span class="logo_colour"> GAME</span></a></h1>
                        <h2>Test Your Knowledge. Enjoy The Game.</h2>
                    </div>
                </div>
                <div id="menubar">
                    <ul id="menu">
                        <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
                        <li><a href="index.php">Home</a></li>
                        <li class="selected"><a href="help.php">Help</a></li>
                        <li><a href="high_scores.php">High Scores</a></li>
                    </ul>
                </div>
            </div>
            <div id="site_content">
                <div id="content">
                    <!-- insert the page content here -->
                    <h1><center>GAME INSTRUCTIONS</center></h1>
                    <p>This question game is designed to entertain you and test you on your Harry Potter, Game of Thrones and Disney knowledge.</p>
                    <p>This game consist of 25 multiple-choice questions. Choose the button that you think is the correct answer. The game starts with medium difficulty and depended on your answer, if your answer is correct you will have an advance difficulty question otherwise an easy difficulty question. The difficulty change depends on your correctness.</p>
                    <p>After you answer a question, select the "Next Question" button in order to continue to the next one.<br> You are free to end the game by selecting the "End Game" button, but your score will not be saved.</p>
                    <p>Your total score is calculated based on your responses to all the questions. If you answer wrong to a question or you choose to move on without answering you get 0 points for that question. For each easy question that you answer correctly you get 1 point, for each medium you get 5 point and for each hard question you get 10 points. </p>
                    <h2><center>Enjoy!</center></h2>
                </div>
            </div>
            <footer>
                <button id="myBtn"><a href="#top" style="color: black">Top</a></button>
            </footer>
        </div>
    </body>
</html>
