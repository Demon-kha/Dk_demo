<?php
     session_start();
     if($_SESSION['uid'])
     {
        echo "";
     }
     else{
        header('location: ../login.php');
     }
?>
<?php
include('header.php');
?>
<div class="admintitle" align="center">
    <h4><a href="logout.pp" style="float:right; margin-right:30px;color:#fff; font-size:20px;">logout</a></h4>
<h1>Welcome To Admin Dashboard</h1>
</div>
<div class="dashboard">
<table border="1" style=" width:50%;" align="center">
    <tr>
        <td>1.</td><td><a href="addstudent.php">Insert User Details</a></td>
    </tr>
    <tr>
        <td>2.</td><td><a href="updatestudent.php">Update User Details</a></td>
    </tr>
    <tr>
        <td>3.</td><td><a href="deletestudent.php">Delete User Details</a></td>

    </tr>
    <tr>
        <td>4.</td><td><a href="selectusr.php">Select User Details</a></td>
        
    </tr>
    <tr>
        <td>.5</td><td><a href="admin_add_regno.php">Add Registration Numbers</a></td>
        
    </tr>
    <tr>
        <td>.6</td><td><a href="admin_see_regno.php">See Registration Numbers</a></td>
        
    </tr>
</table>

</div>
    </body>
    </html>