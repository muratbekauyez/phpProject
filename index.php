<?php
session_start();

//if already logged in, then ridirect to profile page
if (isset($_SESSION['user'])) {
    header('location: profile.php');
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>
<link rel="stylesheet" href="style/index.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    /*login if user and password correct, else show message*/
    $(document).ready(function () {
        $('#authorisate').click(function () {
            var login = $('#login_auth').val();
            var password = $('#password_auth').val();

            if (login == '' || password == '') {
                alert('Please fill all the fields');
            } else {
                $.ajax(
                    {
                        url: 'authorisation.php',
                        method: 'POST',
                        data: {
                            status: 1,
                            login: login,
                            password: password
                        },
                        success: function (data) {
                            if (data.message == 'success') {
                                window.location.href = "profile.php";
                            } else {
                                $('#response_auth').html(data.errorMessage);
                            }

                        },
                        datatype: 'text'
                    }
                );
            }
        });

 	});   
    /*Registration click*/
    $(document).ready(function () {
    	
        $('#registrate').click(function () {
            var login = $('#login_reg').val();
            var password = $('#password_reg').val();
            var firstName = $('#firstName').val();
            var secondName = $('#secondName').val();
            var avatar = $('#avatar').val();
            var birthday = $('#birthday').val();


            if (login == '' || password == '' || firstName == '' || !birthday) {
                alert('Please fill all the fields');
            } else {
                $.ajax({
                    url: 'registration.php',
                    method: 'POST',
                    data: {
                        status: 1,
                        login: login,
                        password: password,
                        firstName: firstName,
                        secondName: secondName,
                        avatar: avatar,
                        birthday: birthday
                    },
                    success: function (data) {
                        if (data.message == 'registered') {
                        	window.location.href = "profile.php";
                        } else {
                            $('#response_reg').html(data.errorMessage);
                        }

                    },
                    datatype: 'text'
                });
            }
        });



    });
</script>
</head>
<body>
<div class="auth_container">
    <form method="post">
        <h2>Log In</h2>
        <input name="login_auth" id="login_auth" placeholder="Enter login" size="25">

        <input type="password" id="password_auth" name="password_auth" placeholder="Enter password" size="25">

        <input type="button" name="authorisate" id="authorisate" value="Submit">

        <span id="response_auth" style="color: red"></span>
    </form>
</div>

<div class="reg_container">
    <form method="post" action="registration.php">
        <h2 id='test'>First Time Here? Sign up</h2>

        <input name="login_reg" id="login_reg" placeholder="Login*" size="25">
        <span id="response_reg" style="color: red"></span>

        <input name="firstName" id="firstName" placeholder="First Name*" size="25">


        <input name="secondName" id="secondName" placeholder="Second Name" size="25">

        <input type="password" id="password_reg" name="password_reg" placeholder="Password*" size="25">

        <input name="avatar" id="avatar" placeholder="URL" size="25">

        <input type="text" name="birthday" id="birthday"  placeholder="Birthday*" size="25" onfocus="(this.type='date')" onblur="(this.type='text')">

        <input type="button" name="registrate" id="registrate" value="Registrate">
    </form>
</div>

</body>
</html>