<?php session_start();?>
<?php
        $username = $_POST['username'];
        $password = $_POST['password'];
        mysql_connect('127.0.0.1', 'root', 'password');

        $query = "select * from person where pid = (Select pid from useraccount where email = '$username' and password = '$password')";

        $data = mysql_db_query(webdesignEnterpriseDb, $query);

        if (mysql_num_rows($data) == 1) {
            while ($row = mysql_fetch_array($data, MYSQL_ASSOC)) {
                $_SESSION['pid'] = $row['id'];
                $_SESSION['pname'] = $row['name'];
            }
            header('Location: AfterLogin.php');
        }
        ?>