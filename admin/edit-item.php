<?php 
require './includes/init.php';

Auth::adminRequireLogin();

$db = new Database();
$conn =  $db->getConn();

if(isset($_GET['id'])) {

    $item = Item::getById($conn, $_GET['id']);

    if(!$item) {
        die("item is not found");

    }
} else {
    die("id not supplied, item not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $item->item_name = $_POST['item'];
    $item->description = $_POST['description'];
    $item->price = $_POST['price'];
    $item->quantity = $_POST['quantity'];


    if($item->update($conn)){

        Url::redirect("/project/admin/item.php?id={$item->id}");
    }
}

?>
<?php require './includes/header.php'; ?>
<div class="container">
<h2>Edit item</h2>

<?php require 'item-form.php'; ?>

<?php require './includes/footer.php'; ?>



