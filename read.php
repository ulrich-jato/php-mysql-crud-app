<!--Name: Jato Ulrich Guiffo Kengne 
    Date: April 08, 2023 
    Section: CST 8285 section 303
    Assignment: 02 
    File: read.php
    Assignment objective: Use HTML, CSS, JavaScript, PHP and 
    MySQL to buils a web aplication to perform CRUD operation
-->
<?php
// Include employeeDAO file
require_once('./dao/productDAO.php');
$productDAO = new productDAO();

// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Get URL parameter
    $id = trim($_GET["id"]);
    $product = $productDAO->getProduct($id);

    if ($product) {
        // Retrieve individual field value
        $name = $product->getName();
        $category = $product->getCategory();
        $price = $product->getPrice();
        $image = $product->getImage();
        $exp_date = $product->getDate();
    } else {
        // URL doesn't contain valid id. Redirect to error page
        header("location: error.php");
        exit();
    }
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}

// Close connection
$productDAO->getMysqli()->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

</head>

<body>
    <?php include "header.php" ?>
    <h1 class="mt-1 mb-3 text-center">View Record</h1>
    <div class="wrapper-view-data">
        <div class="details">
            <div class="form-group mt-1 mb-3">
                <label>Product Name</label>
                <p><strong>
                        <?php echo $name; ?>
                    </strong></p>
            </div>
            <div class="form-group mt-1 mb-3">
                <label>Product Category</label>
                <p><strong>
                        <?php echo $category; ?>
                    </strong></p>
            </div>
            <div class="form-group mt-1 mb-3">
                <label>Product Price</label>
                <p><strong>
                        <?php echo $price; ?>
                    </strong></p>
            </div>
            <div class="form-group mt-1 mb-3">
                <label>Product Exp Date</label>
                <p><strong>
                        <?php echo $exp_date; ?>
                    </strong></p>
            </div>
        </div>

        <div class="form-group">
            <label class="label-image-view">Product Image</label>
            <?php echo '<img class="img-data-view" src="imgs/' . $image . '"/>'; ?>
        </div>
    </div>
    <div class="btn-container">
        <a href="index.php" class="btn btn-primary">Back</a>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>