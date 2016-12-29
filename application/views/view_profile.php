<head>
<style>
.req{
color:red;
}
.suc{
color:green;
}
</style>
    <title>Student page</title>
</head>
<?php $this->load->library('session'); ?>

<?php if( $this->session->userdata('username')==null) exit('Not allowed'); ?>
<?php $this->load->helper('url');
$path=base_url()."application/views/"; ?>

<link rel="stylesheet" href="<?php echo $path ?>css/bootstrap.css">
<script src="<?php echo $path ?>js/jquery.min.js"></script>
<script src="<?php echo $path ?>js/bootstrap.js"></script>
<meta name="viewport" content="width=device-width">

<body>

<div class="row">
    <div id='head' class="col-sm-12" style=" background-color:#673AB7;" >
        <h1 class="text-center" style='color:white'>Student Panel</h1>
        <?php

        $user=$this->session->userdata('username');
        $privilege=strtolower($this->session->userdata('privilege'));
        if($privilege != 'student')
        {
            echo "<script>alert('Sorry You are not allowed ');</script>";

            exit("Not allowed");
        }

        echo "<label style='color:white;margin:0% 0% 0% 85%;'><h5>Looged as <span id='currentUser'>".$user."</span></h5></label>";
        ?>
        <br />
        <a href="<?php echo base_url().'admin/logout' ?>" style='color:white;margin:0% 0% 0% 85%;'>Log out </a>
    </div>

    <!-- Upper Buttons -->
    <div class="row btn-block col-md-12 " style="margin: auto;margin-top: 0.3%;">
        <form method="post" action="">
            <a class='buttonViolate  col-md-4 ' href='<?php echo base_url().'admin' ?>'>Make Routine</a>
            <a class='buttonViolate  col-md-4 ' href=''>Suggested Course</a>
            <a class='buttonViolate  col-md-4 ' href='<?php echo base_url().'profile' ?>'><span style="border-bottom:2px solid blue;">Update Profile</span></a>
        </form>

 <?php echo form_open('profile'); ?>
<div align="center">
<div style="width:40%;margin-top:50px;">
<?php echo '<div class="suc">'.$message1.'</div>'; ?>
<?php echo '<div class="req">'.$message2.'</div>'; ?>
                  <h3>Personal Information</h3>
                  <div><?php echo '<div class="req">'.$message.'</div>'; ?></div>
                  <input class="form-control" name="username" id="username" value="<?php echo $username;?>" placeholder="Your Username" type="text"> <br>
                  <input class="form-control" name="email" id="email" value="<?php echo $email;?>" placeholder="Your E-mail Address" type="text">
                  
                  <h3>Your Password</h3>
                  <input name="password" id="password" value="<?php echo $pass;?>" placeholder="Your Password" type="password"><br>
                 

                  <h3>Your Address</h3>
                  <select class="form-control" name="dist">
				  <?php 
				  $ds=array('Dhaka','Chittagong','N/A');
				  foreach($ds as $d)
				  {
				  if($d==$district)
				  {
				  echo '<option value="'.$d.'" selected>'.$d.'</option>';
				  }
				  else
				  {
				  echo '<option value="'.$d.'">'.$d.'</option>';
				  }
				  }
                    
                  
					?>
                  </select><br>
                  <textarea class="form-control" name="address" id="address" placeholder="Your Full Address"><?php echo $address;?></textarea><br><br>
                 <button type="submit" class="btn btn-info btn-lg">Update</button>
                  <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Cancel</button>
            
</div>
</div>
                </form> 

    </div>


</div>


</body>

