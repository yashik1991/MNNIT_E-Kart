<!doctype html>
<?php

session_start();

$con = mysqli_connect("localhost","root","","webster");//database name
//print_r($_POST);
if(isset($_POST['insertproduct']))
{
    global $con;
    
    $product_title=$_POST['product_title'];
    $product_cat=$_POST['product_cat'];
    $product_brand=$_POST['product_brand'];
    $product_desc=$_POST['product_desc'];
    $product_price=$_POST['product_price'];
    
    $product_image=$_FILES['product_image']['name'];
    $product_image_tmp=$_FILES['product_image']['tmp_name'];
    
    move_uploaded_file($product_image_tmp,"images/$product_image");

    $insert_product="insert into products (pro_title,pro_cat,pro_brand,pro_price,pro_img,pro_desc,pro_likes,pro_rate) values('$product_title','$product_cat','$product_brand','$product_price','$product_image','$product_desc','0','4.0')";
    echo"hello";
    $insert_pro = mysqli_query($con,$insert_product);
    
    //echo $insert_product;
    
    if($insert_pro){
        echo "<script>alert('product has been inserted')</script>";
        echo "<script>window.open('insert_product.php','_self')</script>";
        
    }}
?>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>insert product</title>


 <!-- Bootstrap CSS --> 
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    
    <script type="text/javascript" language="javascript">
     $(".btn.danger").button("toggle").addClass("fat") 
    </script>
    <style>
        
        
        body{
            
            text-align: center;
            align-items: center;
            align-content: center;
        }
        .table{
            text-align: center;
            font-family: cursive;
            float: right;
        }
    
        .tabl{
            align-items: center;
            text-align: center;
            font-size: 20px;
        }
        .tabl:hover{
        color:blueviolet;
                  }
        select{
            float: left;
            border-radius: 5px 5px 5px 5px;
        }
    
    </style>
    

    
    
</head>

<body> 
       <div class="container">
       <form action="insert_product.php" enctype="multipart/form-data" role="form" method="post">
        <table  class="table table-hover">
        <caption>Hover Table Layout</caption>
<thead>
<tr>
<th>icon</th>
<th>type</th>
<th>entity</th>
</tr>
</thead>
<tbody>
<tr class="tabl">
<td><span class="fa fa-quora"></span></td>
<td>product title</td>
<td><input class="form-control" name="product_title" type="text" placeholder="title"></td>
</tr>
<tr class="tabl">
<td><span class="fa fa-quora"></span></td>
<td>product categories</td>
<td>
<select name="product_cat">
    <option>select a category</option>
    <?php
    
    
    $get_cats="select * from categories";
    $run_cats=mysqli_query($con,$get_cats);
    
    while($row_cats=mysqli_fetch_array($run_cats))
    {
        $cat_id=$row_cats['cat_id'];
        
        $cat_title=$row_cats['cat_title'];
        
        echo "<option value='$cat_id'>$cat_title</option>";
     
    }
    
    ?>
    
   
    </select></td>
</tr>
<tr class="tabl">
<td><span class="fa fa-quora"></span></td>
<td>product brand</td>
<td><select name="product_brand">
  <option>select brand</option>
  <?php
    
   $get_brands="select * from brands";
    $run_brands=mysqli_query($con,$get_brands);
    
    while($row_brands=mysqli_fetch_array($run_brands))
    {
        $brand_id=$row_brands['brand_id'];
        
        $brand_title=$row_brands['brand_title'];
        
        echo "<option value='$brand_id'>$brand_title</option>" ;
     
    }
    ?>
    </select></td>
</tr>
<tr class="tabl">
<td><span class="fa fa-quora"></span></td>
<td>product images</td>
<td><input class="form-control" type="file" name="product_image" placeholder="insert image"></td>
</tr>
<tr class="tabl">
<td><span class="fa fa-quora"></span></td>
<td>product price</td>
<td><input class="form-control" type="text" name="product_price" placeholder="price"></td>
</tr>
<tr class="tabl">
<td><span class="fa fa-quora"></span></td>
<td>product description</td>
    <td><textarea class="form-control" type="text" name="product_desc" placeholder="description"></textarea></td>
</tr>

<tr class="tabl"> <td colspan="3"><button type="submit" class="btn btn-block btn-primary" name="insertproduct" value="submit" >submit</button>
   </td>  </tr>
</tbody>
</table>
       
   </form> 
       
 
    </div>    
               
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</body>
</html>