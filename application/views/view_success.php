<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->library('session');
#if( $this->session->userdata('username')==null) exit('Not allowed');
?>


<h1>Welcome</h1>
<h3>Accounts Portal</h3>
<h3>Logged as <?php echo $this->session->userdata('username') ?> </h3>

<ul>
    <li><a href="http://localhost/ci226/transaction/">Transaction</a></li>
    <li><a href="http://localhost/ci226/product/">Product Inventory (search, Delete, Edit, Update)</a></li>
    <li><a href="http://localhost/ci226/balance">Balance Information</a></li>
</ul>

<a href="http://localhost/ci226/welcome/logout">Logout</a>

