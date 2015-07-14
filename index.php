<html>
    <head>
        <title>
            Home Page
        </title>
        <link rel="stylesheet" href="stylesheets/top_bottom.css"/>
        <link rel="stylesheet" href="stylesheets/home.css"/>
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
        <div id="home-body">
            <div id="question">What would you like to learn?</div>
            <form method="post" action="explore.php">
                <input id="home-search-bar" name="search" type="text" placeholder="What would you like to know?"/>
                <input id="home-submit" type="submit" value="Search"/>
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