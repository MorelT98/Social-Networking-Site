<html>
    <head>
        <title>Setting up database</title>
    </head>
    <body>
        <h3>Setting up...</h3>
        <?php
        include_once 'functions.php';

        query("CREATE DATABASE IF NOT EXISTS $appname");
        select_db($appname);

        createTable('members',
                    'user VARCHAR(16),
                    pass VARCHAR(16),
                    firstname VARCHAR(32),
                    lastname VARCHAR(32),
                    email VARCHAR(32),
                    age  SMALLINT UNSIGNED,
                    INDEX(firstname(8)),
                    INDEX(lastname(8)),
                    INDEX(user(6))');

        createTable('messages',
                    'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    auth VARCHAR(16),
                    recip VARCHAR(16),
                    pm CHAR(1),
                    time INT UNSIGNED,
                    message VARCHAR(4096),
                    INDEX(auth(6)),
                    INDEX(recip(6))');

        createTable('friends',
                    'user VARCHAR(16),
                    friend VARCHAR(16),
                    INDEX(user(6)),
                    INDEX(friend(6))');

        createTable('profiles',
                    'user VARCHAR(16),
                    text VARCHAR(4096),
                    INDEX(user(6))');
        
        // After all the setup, redirect to the login page
        header("Location: header.php");
        exit;
        ?>
        <br/>...done.
    </body>
</html>
