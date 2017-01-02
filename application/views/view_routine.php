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
            <a class='buttonViolate  col-md-4 ' href='<?php echo base_url().'routine' ?>'><span style="border-bottom:2px solid blue;">Make Routine</span></a>
            <a class='buttonViolate  col-md-4 ' href='<?php echo base_url().'suggested' ?>'>Suggested Course</a>
            <a class='buttonViolate  col-md-4 ' href='<?php echo base_url().'profile' ?>'>Update Profile</a>
        </form>

<div align="center">
<div style="width:40%;margin-top:50px;">

 <?php echo form_open('routine'); ?>
<h4>Minimum credit(s): 12</h4>
<?php echo $html2; ?>
<?php echo '<div class="req">'.$message.'</div>'; ?>
<?php echo '<div class="suc">'.$message1.'</div>'; ?>
<?php 
echo $html;
if(strlen($html)>1)
{
echo '<input type="submit" name="submit" value="Submit"/>';
}
?>

</form>
                  
</div></div>				  
                 



</body>

