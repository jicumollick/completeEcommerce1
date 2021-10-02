
<?php

require('top.inc.php');

$categories='';
$categories_id='';
$name = '';
$price = '';
$mrp='';
$qty = '';
$image = '';
$short_desc = '';
$description = '';
$meta_title = '';
$meta_description = '';
$meta_keyword = '';



$msg="";
$image_required = 'required';
   if(isset($_GET['id']) && $_GET['id']!=''){
      $image_required='';
      $id = mysqli_real_escape_string($con,$_GET['id']);
      $sql = "select * from product where id='$id'";
      $res=mysqli_query($con,$sql);

      $row = mysqli_fetch_assoc($res);
     

      $categories_id = $row['categories_id'];
      $name = $row['name'];
      $mrp = $row['mrp'];
      $price = $row['price'];
      $qty = $row['qty'];
      $short_desc = $row['short_desc'];
      $description= $row['description'];
      $meta_title = $row['meta_title'];
      $meta_description = $row['meta_description'];
      $meta_keyword = $row['meta_keyword'];
      


   }


if(isset($_POST['submit'])){
   $categories_id = mysqli_real_escape_string($con,$_POST['categories_id']);
   $name = mysqli_real_escape_string($con,$_POST['name']);
   $mrp = mysqli_real_escape_string($con,$_POST['mrp']);
   $price = mysqli_real_escape_string($con,$_POST['price']);
   $qty = mysqli_real_escape_string($con,$_POST['qty']);
   $short_desc = mysqli_real_escape_string($con,$_POST['short_desc']);
   $description = mysqli_real_escape_string($con,$_POST['description']);
   $meta_title = mysqli_real_escape_string($con,$_POST['meta_title']);
   $meta_description = mysqli_real_escape_string($con,$_POST['meta_description']);
   $meta_keyword = mysqli_real_escape_string($con,$_POST['meta_keyword']);
  


   $sql2 = "select * from product where name='$name'";
   $res2= mysqli_query($con,$sql2);

   $check = mysqli_num_rows($res2);

   if($check >0){

      $msg= "product already exists";

   }else {



   if(isset($_GET['id']) && $_GET['id']!=''){

      if($_FILES['image']['name']!=''){
         $image = rand(111111,999999).'_'.$_FILES['image']['name'];
         move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);

      $update_sql= "update product set categories_id='$categories_id', name='$name', mrp='$mrp', price='$price',qty='$qty', short_desc='$short_desc', meta_title='$meta_title', meta_description='$meta_description', meta_keyword='$meta_keyword', image='$image'  where id='$id'";


      }else{
      $update_sql= "update product set categories_id='$categories_id', name='$name', mrp='$mrp', price='$price',qty='$qty', short_desc='$short_desc', meta_title='$meta_title', meta_description='$meta_description', meta_keyword='$meta_keyword'  where id='$id'";

      }
   mysqli_query($con,$update_sql);

   }else {

      $image = rand(111111,999999).'_'.$_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);

      $sql5= "insert into product(categories_id,name,mrp,price,qty,short_desc,description,meta_title,meta_description,meta_keyword,status,image) values('$categories_id','$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','$meta_description','$meta_keyword',1,'$image')";
   mysqli_query($con,$sql5);

   }
  
   header('location:product.php');
   die();
}
}

?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                           <div class="form-group">
                              <label for="categories" class=" form-control-label">Categories</label>
                            <select name="categories_id" class="form-control">
                                <option value="">Select Category</option>
                                <?php

                                $sql3 = "select id,categories from categories order by categories asc";
                                $res = mysqli_query($con,$sql3);

                                while($row=mysqli_fetch_assoc($res)){

                                 if($row['id'] == $categories_id ){
                                    echo " <option selected value=".$row['id'].">".$row['categories']."</option>";


                                 }else {

                                    echo " <option value=".$row['id'].">".$row['categories']."</option>";


                                 }


                                }

                                ?>
                            </select>
                            </div>
                            <div class="form-group">
                              <label for="categories" class=" form-control-label">Product Name</label>
                              <input type="text"  name="name" placeholder="Enter your product name" value="<?php echo $name; ?>" class="form-control" required>
                           </div>
                           <div class="form-group">
                              <label for="categories" class=" form-control-label">MRP</label>
                              <input type="text"  name="mrp" placeholder="Enter your product mrp" value="<?php echo $mrp; ?>" class="form-control" required>
                           </div>
                           <div class="form-group">
                              <label for="categories" class=" form-control-label">Price</label>
                              <input type="text"  name="price" placeholder="Enter your product price" value="<?php echo $price; ?>" class="form-control" required>
                           </div>
                           <div class="form-group">
                              <label for="categories" class=" form-control-label">Qty</label>
                              <input type="text"  name="qty" placeholder="Enter your QTY" value="<?php echo $qty; ?>" class="form-control" required>
                           </div>
                           <div class="form-group">
                              <label for="categories" class=" form-control-label">Image</label>
                              <input type="file"  name="image"  class="form-control" <?php echo $image_required; ?> >
                           </div>
                           <div class="form-group">
                              <label for="categories" class=" form-control-label">Short Description</label>
                              <textarea  type="text"  name="short_desc" placeholder="Enter your product short description" value="" class="form-control" required><?php echo $short_desc; ?></textarea>
                           </div>
                           <div class="form-group">
                              <label for="categories" class=" form-control-label">Description</label>
                              <textarea  type="text"  name="description" placeholder="Enter your product description" value="" class="form-control" required><?php echo $description; ?></textarea>
                           </div>
                           <div class="form-group">
                              <label for="categories" class="form-control-label">Meta Title</label>
                              <input type="text"  name="meta_title" placeholder="Enter your product meta title" value="<?php echo $meta_title; ?>" class="form-control" >
                           </div>
                           <div class="form-group">
                              <label for="categories" class=" form-control-label">Meta Description</label>
                              <input type="text"  name="meta_description" placeholder="Enter your product meta description" value="<?php echo $meta_description; ?>" class="form-control">
                           </div>
                           <div class="form-group">
                              <label for="categories" class=" form-control-label">Meta Keyword</label>
                              <input type="text"  name="meta_keyword" placeholder="Enter your product meta keyword" value="<?php echo $meta_keyword; ?>" class="form-control">
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