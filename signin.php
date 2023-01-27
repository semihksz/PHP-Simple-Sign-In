<?php
//we include the connection file.
require_once 'config.php';
//in order for our login page not to be long and confusing, we created a separate file from the functions name and included the file.
require_once 'function.php';

//We are checking whether the login button has been clicked. We are using the set for this.
if (isset($_POST['signin'])) {
    //We transfer the data from the POST to individual variables.
    $user_mail = $_POST['user_mail'];
    //since we have saved the password encrypted in the database, we need to encrypt and log in while logging in.
    $user_pass = sha1(md5($_POST['user_pass']));
    //if the mail and password are not empty, we make a query.
    if ($user_mail != '' && $user_pass != '') {
        //we bring the data we want from the database.
        $signin = $db->prepare(query: "SELECT * FROM members WHERE user_mail=? and user_pass=?");
        $signin->execute([$user_mail, $user_pass]);
        $signin->fetch(PDO::FETCH_ASSOC);
        //we check the data and if the data has arrived, we say successful and direct it to the page. If the wrong entry was made, we say try again.
        $signincontrol = $signin->rowCount();
        if ($signincontrol > 0) {
            //we call the functions that we defined on the functions page here.
            alert_success();
            header("refresh:2 index.php");
        } else {
            //we call the functions that we defined on the functions page here.
            alert_danger();
            header("refresh:2");
        }
    } else {
        echo "Please enter your information in full.";
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Sign In</title>
</head>

<body>
    <!-- Sign In -->
    <div class="container mt-5">
        <div class="card">
            <div class="row p-5">
                <div class="col">
                    <img src="img/signin-image.jpg" alt="">
                </div>
                <div class="col p-5">
                    <form method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label> <!-- when the boxes are empty and the record button is pressed, we write a short if query so that the entered data is not deleted from the boxes. -->
                            <input type="email" name="user_mail" class="form-control" placeholder="Enter Email" value="<?= isset($_POST['user_mail']) ? $_POST['user_mail'] : null; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="user_pass" class="form-control" placeholder="Password" value="<?= isset($_POST['user_pass']) ? $_POST['user_pass'] : null; ?>">
                        </div>
                        <button type="submit" name="signin" class="btn btn-primary">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>