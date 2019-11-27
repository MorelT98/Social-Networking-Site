        <?php
            include_once 'header.php';
            if(!$loggedin) die();
        ?>

        <div class="main">
            <h3>Your Profile</h3>
            <?php
                // DISPLAY TEXT
                // If the user entered some text, save it into the database
                if(isset($_POST['text'])){
                    $text = sanitize_string($_POST['text']);
                    $text = preg_replace('/\s\s+/', ' ', $text);

                    $result = query("SELECT * FROM profiles WHERE user='$user'");
                    if($result->num_rows > 0){
                        query("UPDATE profiles SET text='$text' where user='$user'");
                    } else {
                        $result = query("INSERT INTO profiles VALUES('$user', '$text')");
                    }
                } else {
                    // Display the current text that the user has in the database
                    $result = query("SELECT * FROM profiles WHERE user='$user'");

                    if($result->num_rows > 0) {
                        $row = $result->fetch_row();
                        $text = stripslashes($row[1]);
                    } else $text = "";
                }

                $text = stripslashes(preg_replace('/\s\s+/', ' ', $text));
                
                // DISPLAY IMAGES
                if(isset($_FILES['image']['name'])){
                    $saveto = "$user.jpg";
                    move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
                    $typeok = TRUE;

                    switch($_FILES['image']['type']){
                        case "image/gif": $src = imagecreatefromgif($saveto); break;
                        case "image/jpeg": // Allow both regular and progressive jpegs
                        case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
                        case "image/png": $src = imagecreatefrompng($saveto); break;
                        default: $typeok = FALSE; break;
                    }

                    if($typeok) {
                        list($w, $h) = getimagesize($saveto);
                        
                        $max = 100;
                        $tw = $w;
                        $th = $h;

                        if($w > $h && $max < $w) {
                            $th = $max / $w * $h;
                            $tw = $max;
                        } else if($h > $w && $max < $h){
                            $tw = $max / $h * $w;
                            $th = $max;
                        } else if($max < $w){
                            $tw = $th = $max;
                        }

                        $tmp = imagecreatetruecolor($tw, $th);
                        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
                        imageconvolution($tmp, array(array(-1, -1, -1),
                                    array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
                        imagejpeg($tmp, $saveto);
                        imagedestroy($tmp);
                        imagedestroy($src);
                    }
                }

                showProfile($user);
            ?>
            <form method='post' action='profile.php' enctype='multipart/form-data'>
                <h3>Enter or edit your details and/or upload an image</h3>
                <textarea name='text' cols='50' rows='3'><?php echo $text; ?></textarea><br/>
                Image: <input type='file' name='image' size='14' maxlength='32'/>
                <input type='submit' value='Save Profile' />
            </form>
        </div><br/>
    </body>
</html>