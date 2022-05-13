<?php

require './includes/init.php';

Auth::adminRequireLogin();

$db = new Database();
$conn = $db->getConn();

if(isset($_GET['id'])) {
    
    $item = Item::getById($conn, $_GET['id']);
    
    if(!$item) {
        die("item is not found");

    }
} else {
    die("id not supplied, item not found");
}



if($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_FILES);

    try {

    switch ($_FILES['file']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new Exception('No file uploaded');
            break;
        default:
            throw new Exception('An error occurred');
    }


    if($_FILES['file']['size'] > 10000000) {

        throw new Exception('file is too large');
    }

    $mime_types = ['image/gif', 'image/png', 'image/jpeg','image.jpg'];

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);

    
    if(! in_array($mime_type, $mime_types)) {
     
        throw new Exception('Invalid file type');

    }

    $pathinfo = pathinfo($_FILES['file']['name']);
     
    $base = $pathinfo['filename'];

        $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);

         mb_substr($base, 0, 200);

        $filename = $base . "." . $pathinfo['extension'];


        $destination = "../uploads/$filename";

        $num = 1;

        while (file_exists($destination)) {

            $filename = $base . "-$num." . $pathinfo['extension'];

            $destination = "../uploads/$filename";
            $num++;
        }

        
        if(move_uploaded_file( $_FILES['file']['tmp_name'], $destination)) {

        $previous_image = $item->image_name;

     if($item->setImageFile($conn, $filename)) {

        if ($previous_image) {

            unlink("../uploads/$previous_image");
        }

         

        Url::redirect("/project/admin/edit-item-image.php?id={$item->id}");
         }
    }



}catch ( Exception $e) {

    echo $e->getMessage();

}


} 


?>

<?php require './includes/header.php'; ?>
<div class="container" >

    <h2>Edit item image</h2>
    <?php if($item->image_name): ?>
         
        <div class="card" style="max-width:18rem;">

            
            <img class="card-img-top" src="../uploads/<?= $item->image_name?>" alt="NO IMAGE">
            <a class="card-link" href="delete-item-image.php?id=<?= $item->id ?>">Delete Image</a>
            
        </div>
        <?php endif; ?>
        
        
        
        <form method="post" enctype="multipart/form-data" >
        <div class="form-group">
            <label for="file">Image file</label>
            <input class="form-control-file" type="file" id="file" name="file">
        </div>
        <button class="btn btn-primary">Upload</button>
        
    </form>
    
</div>
<div id="hello">
    
</div>
    
<?php require './includes/footer.php'; ?>


