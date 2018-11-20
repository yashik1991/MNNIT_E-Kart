<? php
$con =mysqli_connect("localhost","root","","webster") or die ("could not connet to mysqli");

session_start();

function total_items_cart()
{
    global $con;
if(isset($_SESSION['username']))
{
    $user=$_SESSION['username'];
    $count_cart="select * from cart where username='$user'";
    $run_count=mysqli_query($con,$count_cart);
    $count_item=mysqli_num_rows($run_count);
    echo $count_item;
    
}
}

// counting numbers of product from wishlist

function total_items_wishlist()
{
    global $con;
if(isset($_SESSION['username']))
{
    $user=$_SESSION['username'];
    $count_wish="select * from wishlist where username='$user'";
    $run_count=mysqli_query($con,$count_wish);
    $count_item=mysqli_num_rows($run_count);
    echo $count_item;
    
}
}


?>