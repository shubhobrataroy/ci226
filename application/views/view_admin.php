<head>
    <title>Admin page</title>
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
            <h1 class="text-center" style='color:white'>Admin Panel</h1>
            <?php

            $user=$this->session->userdata('username');
            $privilege=strtolower($this->session->userdata('privilege'));
            if($privilege != 'admin')
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
                <a class='buttonViolate  col-md-2 ' href='<?php echo base_url()."admin/add_course" ?>'>Add Course</a>
                <a class='buttonViolate  col-md-2 ' href='<?php echo base_url()."admin/add_department" ?>'>Add Department</a>
                <a class='buttonViolate  col-md-2 ' href='<?php echo base_url()."admin/add_schedule" ?>'>Schedule</a>
            </form>

            <br/>
            <br/>
            <?php echo $html ?>
        </div>


    </div>


</body>

