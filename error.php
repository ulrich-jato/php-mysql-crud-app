<!DOCTYPE html>
<html lang="en">
<!--Name: Jato Ulrich Guiffo Kengne 
    Date: April 08, 2023 
    Section: CST 8285 section 303
    Assignment: 02 
    File: error.php
    Assignment objective: Use HTML, CSS, JavaScript, PHP and 
    MySQL to buils a web aplication to perform CRUD operation
-->

<head>
    <meta charset="UTF-8">
    <title>Error</title>
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
                    <h2 class="mt-5 mb-3">Invalid Request</h2>
                    <div class="alert alert-danger">Sorry, you've made an invalid request. Please <a href="index.php"
                            class="alert-link">go back</a> and try again.</div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>