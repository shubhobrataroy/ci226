<?php
Class profile_model extends CI_Model
{
 function get_profile($username)
 {
   $this -> db -> select('username,email, district,address');
   $this -> db -> from('user_data');
   $this -> db -> where('username', $username);
   
   
   $this -> db -> limit(1);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
  function get_password($username)
 {
   $this -> db -> select('password');
   $this -> db -> from('users');
   $this -> db -> where('username', $username);
   
   
   $this -> db -> limit(1);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
 function update($username,$email, $pass,$add,$dist)
 {
  $data1 = array(
        'username' => $username,
        'email' => $email,
        
		'address' => $add,
		'district' => $dist
         );
$this->db->where('username', $username);
$query1 = $this->db->update('user_data', $data1);
   $data2 = array('password' => $pass);
   $this->db->where('username', $username);
   $query2 = $this->db->update('users', $data2);
   
 
   if($query1 && $query2 )
   {
     return true;
   }
   else
   {
     return false;
   }
 }
 
}
?>