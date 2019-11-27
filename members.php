        <?php
            include_once 'header.php';
            if(!$loggedin) die();
        ?>

        <div class='main'>
        <?php
            if(isset($_GET['view'])){
                $view = sanitize_string($_GET['view']);

                if($view == $user) $name = "Your";
                else $name = "$view's";

                echo "<h3>$name Profile</h3>";
                showProfile($view);
                echo "<a class='button' href='messages.php?view=$view'>" . 
                "View $name messages</a><br/><br/>";
                die("</div></body></html>");
            }

            if(isset($_GET['add'])){
                $add = sanitize_string($_GET['add']);
                // Check if the two memebers are not friends already
                $result = query("SELECT * FROM friends WHERE user='$add' AND friend='$user'");
                if($result->num_rows == 0){
                    query("INSERT INTO friends VALUES ('$add', '$user')");
                }
            } elseif(isset($_GET['remove'])){
                $remove = sanitize_string($_GET['remove']);
                query("DELETE FROM friends WHERE user='$remove' AND friend='$user'");
            }

            $result = query("SELECT user FROM members ORDER BY user");
            $num = $result->num_rows;

            echo "<h3>Other Members</h3><ul>";

            for($j = 0; $j < $num; $j++) {
                $row = $result->fetch_row();
                if($row[0] == $user) continue;

                echo "<li><a href='members.php?view=$row[0]'>$row[0]</a>";
                $follow = "follow";

                $t1 = query("SELECT * FROM friends WHERE user='$row[0]' AND friend='$user'")->num_rows;
                $t2 = query("SELECT * FROM friends WHERE user='$user' AND friend='$row[0]'")->num_rows;
                if(($t1 + $t2) > 1) echo " &harr; is a mutual friend";
                elseif($t1) echo " &larr; you are following";
                elseif($t2) {
                    echo " &rarr; is following you";
                    $follow = "recip";
                }
                if(!$t1) echo " [<a href='members.php?add=" . $row[0] . "'>$follow</a>]";
                else echo " [<a href='members.php?remove=" . $row[0] . "'>drop</a>]";
            }
        ?><br/>
        </div>
    </body>
</html>