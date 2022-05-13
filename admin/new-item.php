<?php
require './includes/init.php';

Auth::adminRequireLogin();
$item = new Item();

$db = new Database();
$conn =  $db->getConn();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $item->item_name = $_POST['item'];
    $item->description = $_POST['description'];
    $item->price = $_POST['price'];
    $item->quantity = $_POST['quantity'];

    

    if($item->addItem($conn)) {

        
    Url::redirect("/project/admin/item.php?id={$item->id}");
    // Url::redirect("/project/success.php");


} else{
    
}

}



?>
<?php require './includes/header.php';?>
<div class="container">
    
    <h2> Add item</h2>


<?php 

require 'item-form.php';
require './includes/footer.php'; 
?>