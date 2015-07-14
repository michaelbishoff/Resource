<html>
    <head>
        <title>
            Home Page
        </title>
        <link rel="stylesheet" href="stylesheets/top_bottom.css"/>
        <link rel="stylesheet" href="stylesheets/explore.css"/>
    </head>
    <body>
        <div id="home-top-bar">
            <table>
                <tr>
                    <td id="title">
                        <a href="index.php">
                            <div class="block">
                                <div class="word">
                                    Resource
                                </div>
                            </div>
                        </a>
                    </td>
                    <td id="add-new">
                        <div class="block">
                            <div class="word2">
                                Add New Resource
                            </div>
                        </div>
                    </td>
                    <td id="explore">
                        <a href="show_all.php">
                            <div class="block">
                                <div class="word2">
                                    Explore
                                </div>
                            </div>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <div id="search-bar">
            <form method="post" action="explore.php">
                <input id="explore-search-bar" name="search" type="text" placeholder="What would you like to know?" value="<?php echo ($_POST['search']); ?>"/>
                <input id="explore-submit" type="submit" value="Search"/>
            </form>
        </div>
        <div id="results">
<?php

include('CommonMethods.php');
$debug = false;
$COMMON = new Common($debug); // common methods

/*
// The user clicked Explore
if (!(empty($_POST['explore']))) {
    print("LOAD EXPLORE!!");
}
*/

// If the user searched for something
if (!(empty($_POST['search']))) {
    $sql = "SELECT * FROM `resources` WHERE `category`='" . $_POST['search'] . "' ORDER BY `votes` DESC";

    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

    $numResults = 1;

    while ($row = mysql_fetch_row($rs)) {
        echo("<div id='result" . $numResults . "' class='result fadeInUp'>");
            echo("<table><tr><td>");
            echo("<div class='voting' id='" . $row[0] . "'>");
                echo("<span class='up vote'></span>");
                echo("<div class='totalVotes'>" . $row[4] . "</div>");
                echo("<span class='down vote'></span>");
            echo("</div>");
            echo("</td><td width='100%' height='80px'><a href='" . $row[3] . "' >");
            echo("<div class='resourceLink'>" . $row[2] . "</div></a></td></tr></table>");
        echo("</div>");

        $numResults += 1;
    }
}

// User voted Up or Down
else if (!(empty($_POST['votes']))) {
    if (intval($_POST['votes']) < -4){
        $sql = "DELETE FROM `resources` WHERE `id`=" . $_POST['resultId'];
    }
    else {
        $sql = "UPDATE `resources` SET `votes`=" . $_POST['votes'] . " WHERE `id`=" . $_POST['resultId'];
    }

    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}

?>
<!--
            <div id="result1" class="result">
                <div class="voting">
                    <span class="vote up"></span>
                    <div class="totalVotes">5</div>
                    <span class="vote down"></span>
                </div>
                <a href="https://www.google.com" class="resourceLink">
                    Test Content
                </a>
            </div>
        </div>
-->
            <div id="home-bottom-bar">
            </div>
        </div>
        
        <!-- Includes -->

        <div id="numResults" style="visibility: hidden">
            <?php echo($numResults); ?>
        </div>

        <script type="text/javascript" src="js/assets/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="js/assets/jquery-2.1.3.js"></script>
        <script type="text/javascript" src="js/explore.js"></script>
        <script type="text/javascript" src="js/global.js"></script>
        <script type="text/javascript" src="js/home.js"></script>
            
    </body>
</html>
