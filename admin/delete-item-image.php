<?php

require './includes/init.php';

Auth::adminRequireLogin();

$db = new Database();
$conn = $db->getConn();

if(isset($_GET['id'])) {

    $item = Item::getById($conn,$_GET['id']);

    if(!$item) {

        die("Item not found");

    }

} else {

    die("id not supplied, Item not found");
}


if($_SERVER["REQUEST_METHOD"] == "POST") {


    $previous_image = $item->image_name;

    if($item->setImageFile($conn,null)) {

        if($previous_image) {

            unlink("../uploads/$previous_image");

        }


        Url::redirect("/project/item.php?id={$item->id}");
    }


}

?>
<?php require './includes/header.php'; ?>
<div class="container">
    
    <h2>Delete item image</h2>
    
    <?php if($item->image_name): ?>
        <img src="../uploads/<?= $item->image_name;?>" alt="Image">
        
        <?php endif; ?>
        
        <form method="post">
            
            <p>Are you sure?</p>
            
            <button class="btn btn-primary">Delete</button>
            <a href="edit-item-image.php?id=<?=$item->id; ?>">Cancel</a>
        </form>
        
</div>
<?php require './includes/footer.php';