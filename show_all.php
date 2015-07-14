<html>
    <head>
        <title>
            Explore Page
        </title>
        <link rel="stylesheet" href="stylesheets/top_bottom.css"/>
        <link rel="stylesheet" href="stylesheets/show_all.css"/>
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
            <form id="search_bar" method="post" action="explore.php">
                <input id="explore-search-bar" name="search" type="text" placeholder="What would you like to know?" value="<?php echo ($_POST['search']); ?>"/>
                <input id="explore-submit" type="submit" value="Search"/>
            </form>
        </div>
        <div id="results">
            <table width="100%" style="padding: 0% 6%" align="center">
	      <tr class='fadeInUp'>
<?php

include('CommonMethods.php');
$debug = false;
$COMMON = new Common($debug); // common methods
    
$sql = "SELECT `category` FROM `resources`";

$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

$cats = array();
$numResults = 0;

while ($row = mysql_fetch_row($rs)) {
//    if ($cats.indexOf($row[0]) == -1){
    if (!in_array($row[0], $cats)) {
        if ($numResults % 3 == 0 && $numResults != 0){
            echo("</tr><tr class='fadeInUp'>");
        }
        
        echo("<td align='center'>");
        echo("<div id='category" . $numResults . "' class='category' onclick=\"post('explore.php', {search: '" . $row[0] . "'})\"><div id='cat-word'>");
                echo($row[0]);
        echo("</div></div>");
        echo("</td>");
        
        $cats[] = $row[0];
        $numResults += 1;
    }
}

if ($numResults % 3 == 0 && $numResults != 0){
    echo("</tr>");
}

?>
           </table> 

           <div id="home-bottom-bar">
           </div>
        </div>
        <!-- Includes -->

        <div id="numCategories" style="visibility: hidden">
            <?php echo($numResults); ?>
        </div>
        
        <script type="text/javascript" src="js/assets/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="js/assets/jquery-2.1.3.js"></script>
        <script type="text/javascript" src="js/show_all.js"></script>
        <script type="text/javascript" src="js/global.js"></script>
        <script type="text/javascript" src="js/home.js"></script>
            
    </body>
</html>
