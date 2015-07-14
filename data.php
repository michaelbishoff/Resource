<table border="1">
   <tr>
     <td>id</td>
     <td>Category</td>
     <td>Title</td>
     <td>Link</td>
     <td>votes</td>
   </tr>

<?php

   include('CommonMethods.php');                                              
   $debug = false;                                                            
   $COMMON = new Common($debug); // common methods                            

   $sql = "SELECT * FROM `resources`";

   $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

   while ($row = mysql_fetch_row($rs)) {
      echo("<tr>");
   foreach ($row as $element) {
      echo("<td>" . $element . "</td>");
   }
   echo("</tr>");
   }

?>