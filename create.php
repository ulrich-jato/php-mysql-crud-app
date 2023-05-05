<!--Name: Jato Ulrich Guiffo Kengne 
    Date: April 08, 2023 
    Section: CST 8285 section 303
    Assignment: 02 
    File: upload.php
    Assignment objective: Use HTML, CSS, JavaScript, PHP and 
    MySQL to buils a web aplication to perform CRUD operation
-->
<?php
// Include employeeDAO file
require_once('./dao/productDAO.php');


// Define variables and initialize with empty values
$name = $category = $price = $image = $exp_date = "";
$name_err = $category_err = $sprice_err = $image_err = $exp_date_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Include upload.php for image validation
    require_once('upload.php');

    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    // Validate category
    $input_category = trim($_POST["category"]);
    if (empty($input_category)) {
        $category_err = "Please enter a category.";
    } elseif (!filter_var($input_category, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")))) {
        $category_err = "Please enter a valid category.";
    } else {
        $category = $input_category;
    }

    // Validate price
    $input_price = trim($_POST["price"]);
    if (empty($input_price)) {
        $price_err = "Please enter the price amount.";
    } elseif (!ctype_digit($input_price)) {
        $price_err = "Please enter a positive integer value.";
    } else {
        $price = $input_price;
    }

    // Validate expiration date
    $input_exp_date = trim($_POST["exp_date"]);
    if (empty($input_exp_date)) {
        $exp_date_err = "Please enter the product expiration date.";
    } else {
        // Check if the input date is greater than the current date
        $current_date = date("Y-m-d");
        if ($input_exp_date < $current_date) {
            $exp_date_err = "The expiration date should be greater than the current date.";
        } else {
            $exp_date = $input_exp_date;
        }
    }


    // Check input errors before inserting in database
    if (empty($name_err) && empty($category_err) && empty($price_err) && empty($image_err) && empty($exp_date_err)) {
        move_uploaded_file($tmp_name, $target_file);
        $productDAO = new productDAO();
        $product = new Product(0, $name, $category, $price, $image, $exp_date);
        $addResult = $productDAO->addProduct($product);
        header("refresh:2; url=index.php");
        echo '<br><h6 style="text-align:center">' . $addResult . '</h6>';
        // Close connection
        $productDAO->getMysqli()->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <?php include "header.php" ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-1">Create Record</h2>
                    <p>Please fill this form and submit to add product record to the database.</p>

                    <!--the following form action, will send the submitted form data to the page itself ($_SERVER["PHP_SELF"]), instead of jumping to a different page.-->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="name"
                                class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $name; ?>">
                            <span class="invalid-feedback">
                                <?php echo $name_err; ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <label>Product Category</label>
                            <input type="text" name="category"
                                class="form-control <?php echo (!empty($category_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $category; ?>">
                            <span class="invalid-feedback">
                                <?php echo $category_err; ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="text" name="price"
                                class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $price; ?>">
                            <span class="invalid-feedback">
                                <?php echo $price_err; ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <label>Expiration Date</label>
                            <input type="date" name="exp_date"
                                class="form-control <?php echo (!empty($exp_date_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $exp_date; ?>">
                            <span class="invalid-feedback">
                                <?php echo $exp_date_err; ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="file"
                                class="form-control-file <?php echo (!empty($image_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $image; ?>">
                            <span class="invalid-feedback">
                                <?php echo $image_err; ?>
                            </span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>


</body>

</html>