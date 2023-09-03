
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">VehicleDekho</a>
    <form class="d-flex" role="search">
      <?php 
      
      
        
    
      if (isset($_SESSION['user_id']) || isset($_SESSION['agencyId'])  ) { 
     $username = $_SESSION['user_name']; ?>
       
       <span> Logged in as  <?php echo $username ?> </span>
       
     <?php echo  '<button  class="btn btn-outline-success" type="submit"><a style="text-decoration:None" href="gooutside.php"  >Log out</a></button>';
      }
     else {
        
    echo   '<button  class="btn btn-outline-success" type="submit"><a style="text-decoration:None" href="goinside.php"  >Log in</a></button>';
  }

     ?>
     
    </form>
  </div>
</nav>
<style>

span{
  margin:10px;
}

</style>