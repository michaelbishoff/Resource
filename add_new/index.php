<html>
    <head>
        <title>Add New Resource</title>
        <link rel="stylesheet" href="../stylesheets/top_bottom.css"/>
        <link rel="stylesheet" href="../stylesheets/add_new.css"/>
    </head>
    <body>
        <div id="home-top-bar">
            <table>
                <tr>
                    <td id="title">
                        <a href="../index.php">
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
                        <a href="../show_all.php">
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
        <div id="home-body">
            <form method="post" action="index.php">
	      <div id="add-statement">Add a new resource!</div>
                <div class="link-type" id="wrap">
                    <div id="name">
                        Resource type:
                    </div>
                    <div id="types">
                        <input type="radio" name="category" value="Foundational"> Foundational
                        <input type="radio" name="category" value="Frontend"> Frontend
                        <input type="radio" name="category" value="Backend"> Backend
                        <input type="radio" name="category" value="Database"> Database
                        <input type="radio" name="category" value="API">API
                        <input type="radio" name="category" value="Mobile"> Mobile
                    </div>
                </div>
                <div class="link-title" id="wrap">
                    <div id="name">
                        Title:
                    </div>
                    <input type="text" id="l_title" name="l_title"/>
    
                </div>
                <div class="link-url" id="wrap">
                    <div id="name">
                        URL
                    </div>
                    <input type="text" id="url" name="url" />
                </div>
		<input id="add-submit" type="submit" value="Submit"/>                     
<?php 
    include('../CommonMethods.php');
    $debug = false;
    $COMMON = new Common($debug); // common methods
    
    // If the user is trying to submit
    if (!empty($_POST['category'])){    
        $category = $_POST['category'];
        $linkTitle = $_POST['l_title'];
        $link = $_POST['url'];

        $sql = "INSERT INTO`resources` VALUES ('', '" . $category . "', '" . $linkTitle . "', '" . $link . "', 0)";

        $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    }
?>
            </form>
        </div>
        <div id="home-bottom-bar">
        </div>
        
        <!-- Includes -->
        <script type="text/javascript" src="../js/assets/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="../js/assets/jquery-2.1.3.js"></script>
        <script type="text/javascript" src="../js/global.js"></script>
        <script type="text/javascript" src="../js/add_new.js"></script>
    </body>
</html>
