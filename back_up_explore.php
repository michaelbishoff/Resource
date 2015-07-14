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
                        <div class="block">
                            <div class="word">
                                Resource
                            </div>
                        </div>
                    </td>
                    <td id="add-new">
                        <div class="block">
                            <div class="word2">
                                Add New Resource
                            </div>
                        </div>
                    </td>
                    <td id="explore">
                        <div class="block">
                            <div class="word2">
                                Explore
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div id="home-body">
            <form method="post" action="explore.php">
                <input id="explore-search-bar" name="search" type="text" placeholder="What would you like to know?" value="<?php echo ($_POST['search']); ?> "/>
                <input id="explore-submit" type="submit" value="Search"/>
            </form>
        </div>
        <div id="home-bottom-bar">
        </div>
        
        <!-- Includes -->
        <script type="text/javascript" src="js/assets/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="js/assets/jquery-2.1.3.js"></script>
        <script type="text/javascript" src="js/global.js"></script>
        <script type="text/javascript" src="js/home.js"></script>
    </body>
</html>