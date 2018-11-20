<!DOCTYPE HTML>
<html>

<head>
  <title>EPL425 Question Game-High Scores Page</title>
  <meta name="author" content="Theodora Costi">
  <meta name="description" content="Homework 3, EPL425 Fall2018, University of Cyprus - High Scores Page">
  <meta name="keywords" content="Homework3, EPL425, Fall18, PHP, HighScoresPage, QuizGame, QuestionGame">
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
          <li><a href="index.php">Home</a></li>
          <li><a href="help.php">Help</a></li>
          <li class="selected"><a href="high_scores.php">High Scores</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div id="content">
      <table id="scoreList">
			<tr>
				<th>Nickname</th>
				<th>Score</th>
			</tr>
		</table>  
      </div>
    </div>
      <footer>
      <button id="myBtn"><a href="#top" style="color: black">Top</a></button>
  </div>
  </footer>
</body>
</html>
