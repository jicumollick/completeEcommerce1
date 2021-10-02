
<?php

require('top.inc.php');

$categories='';

$msg="";
   if(isset($_GET['id']) && $_GET['id']!=''){
      $id = mysqli_real_escape_string($con,$_GET['id']);
      $sql = "select * from categories where id='$id'";
      $res=mysqli_query($con,$sql);

      $row = mysqli_fetch_assoc($res);

      $categories = $row['categories'];

   }


if(isset($_POST['submit'])){
   $categories = mysqli_real_escape_string($con,$_POST['categories']);

   $sql2 = "select * from categories where categories='$categories'";
   $res2= mysqli_query($con,$sql2);

   $check = mysqli_num_rows($res2);

   if($check >0){

      $msg= "category already exists";

   }else {



   if(isset($_GET['id']) && $_GET['id']!=''){
      $sql= "update categories set categories='$categories' where id='$id'";
   mysqli_query($con,$sql);

   }else {
      $sql= "insert into categories(categories,status) values('$categories','1')";
   mysqli_query($con,$sql);

   }

   
   
   header('location:categories.php');
   die();
}
}

   


?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                        <form action="" method="post">
                        <div class="card-body card-block">
                           <div class="form-group">
                              <label for="catefories" class=" form-control-label">Categories</label>
                              <input type="text" id="categories" name="categories" value="<?php echo $categories; ?>" class="form-control" required>
                           </div>
                          
                           <button type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                           <span id="payment-button-amount">Submit</span>
                           </button>
                           <div class="field_error">
               <?php

               echo $msg;

               ?>
               </div>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
          
<?php

require('footer.inc.php');

?>