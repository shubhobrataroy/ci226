
<!DOCTYPE html>

<?php $this->load->helper('url');
$path=base_url(); ?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Online Routine Maker</title>
    <link rel='stylesheet' href="http://localhost/ci226/application/views/jquery/jquery1.js">
    <link rel="stylesheet" href="http://localhost/ci226/application/views/css/style.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="http://localhost/ci226/application/views/css/bootstrap.css">
    <script src="http://localhost/ci226/application/views/js/jquery.min.js"></script>
    <script src="http://localhost/ci226/application/views/js/bootstrap.js"></script>
    <script src="http://localhost/ci226/application/views/register/js/validate.js"></script>

    <script>
        function validation() {
            if (document.getElementById('user').value == '' | document.getElementById('p').value == '') {
                alert("Field is empty");
                return false;
            }
            else return true;
        }
    </script>



</head>

<body>
<center><img src="http://localhost/ci226/application/views/lg.png" height="200px" width="600px"></img></center>
<center><font color="blue">Online Routine Maker</font></center>
<br/>
<div class="login-card">
    <h1>Log-in</h1><br>
    <form name='myForm' action="<?php echo $path ?>welcome" method="post" onsubmit="validation()">

        <input type="text" id="user" name="username" placeholder="Username" > <?php echo form_error('username'); ?> <br>
        <input type="password" name="password" id="p" placeholder="Password"> <?php echo form_error('password'); ?><br>
        <input type="submit" name="login" value="login" ><br>
    </form>


    <h6><?php if($message!="") echo "Wrong Username/Password"?></h6>
    <div class="login-help">
        <a href="#" data-toggle="modal" data-target="#Register">Register</a> • <a href="#">Forgot Password</a>
    </div>
</div>


<div id="Register" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Register</h4>
            </div>
            <div class="modal-body" >
                <form id="registrationForm">

                    <h3 >Your Personal Information</h3>
                    <div id="usernameAlert"></div>
                    <input class="form-control" type="text" name="username2" id="username2" value="" placeholder="Your Desired Username" /> <br>
                    <input class="form-control" type="text" name="email" id="email" value="" onkeyup="validateRegistration()" placeholder="Your E-mail Address">
                    <div id="emailAlert"></div>
                    <h3 >Your Password</h3>
                    <input type="password" name="password" id="password" value="" placeholder="Your Password"><br/>
                    <input type="password" name="confirm"  id="confirm" value="" onkeyup="validateRegistration()" onfocusout="validateRegistration()" placeholder="Confirm Password">
                    <div id="passwordAlert"></div>

                    <h3 >Your Address</h3>
                    <select class="form-control">
                        <option value="">Dhaka</option>
                        <option value="">Chittagong</option>
                        <option value="">N/A</option>
                    </select><br/>
                    <textarea class="form-control" name="address" id="address" placeholder="Your Full Address"></textarea>
                    <div id="addressAlert"></div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-lg">Register</button>
                        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Cancel</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script src="http://localhost/ci226/application/views/jquery/jquerylib.js"></script>

</body>

</html>