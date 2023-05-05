<!--Name: Jato Ulrich Guiffo Kengne 
    Date: April 08, 2023 
    Section: CST 8285 section 303
    Assignment: 02 
    File: productDAO.php
    Assignment objective: Use HTML, CSS, JavaScript, PHP and 
    MySQL to buils a web aplication to perform CRUD operation
-->

<?php
require_once('abstractDAO.php');
require_once('./model/product.php');

class productDAO extends abstractDAO
{

    function __construct()
    {
        try {
            parent::__construct();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
    }

    public function getProduct($productId)
    {
        $query = 'SELECT * FROM products WHERE id = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $temp = $result->fetch_assoc();
            $product = new product($temp['id'], $temp['name'], $temp['category'], $temp['price'], $temp['image'], $temp['exp_date']);
            $result->free();
            return $product;
        }
        $result->free();
        return false;
    }


    public function getProducts()
    {
        //The query method returns a mysqli_result object
        $result = $this->mysqli->query('SELECT * FROM products');
        $products = array();

        if ($result->num_rows >= 1) {
            while ($row = $result->fetch_assoc()) {
                //Create a new employee object, and add it to the array.
                $product = new product($row['id'], $row['name'], $row['category'], $row['price'], $row['image'], $row['exp_date']);
                $products[] = $product;
            }
            $result->free();
            return $products;
        }
        $result->free();
        return false;
    }

    public function addProduct($product)
    {

        if (!$this->mysqli->connect_errno) {
            //The query uses the question mark (?) as a
            //placeholder for the parameters to be used
            //in the query.
            //The prepare method of the mysqli object returns
            //a mysqli_stmt object. It takes a parameterized 
            //query as a parameter.
            $query = 'INSERT INTO products (name, category, price, image,exp_date) VALUES (?,?,?,?,?)';
            $stmt = $this->mysqli->prepare($query);
            if ($stmt) {
                $name = $product->getName();
                $category = $product->getCategory();
                $price = $product->getPrice();
                $image = $product->getImage();
                $exp_date = $product->getDate();

                $stmt->bind_param(
                    'ssiss',
                    $name,
                    $category,
                    $price,
                    $image,
                    $exp_date
                );
                //Execute the statement
                $stmt->execute();

                if ($stmt->error) {
                    return $stmt->error;
                } else {
                    return $product->getName() . ' added successfully!';
                }
            } else {
                $error = $this->mysqli->errno . ' ' . $this->mysqli->error;
                echo $error;
                return $error;
            }

        } else {
            return 'Could not connect to Database.';
        }
    }
    public function updateProduct($product)
    {

        if (!$this->mysqli->connect_errno) {
            //The query uses the question mark (?) as a
            //placeholder for the parameters to be used
            //in the query.
            //The prepare method of the mysqli object returns
            //a mysqli_stmt object. It takes a parameterized 
            //query as a parameter.
            $query = "UPDATE products SET name=?, category=?, price=?, image=?, exp_date=? WHERE id=?";
            $stmt = $this->mysqli->prepare($query);
            if ($stmt) {
                $id = $product->getId();
                $name = $product->getName();
                $category = $product->getCategory();
                $price = $product->getPrice();
                $image = $product->getImage();
                $exp_date = $product->getDate();

                $stmt->bind_param(
                    'ssissi',
                    $name,
                    $category,
                    $price,
                    $image,
                    $exp_date,
                    $id
                );
                //Execute the statement
                $stmt->execute();

                if ($stmt->error) {
                    return $stmt->error;
                } else {
                    return $product->getName() . ' updated successfully!';
                }
            } else {
                $error = $this->mysqli->errno . ' ' . $this->mysqli->error;
                echo $error;
                return $error;
            }

        } else {
            return 'Could not connect to Database.';
        }
    }

    public function deleteProduct($productId)
    {
        if (!$this->mysqli->connect_errno) {
            // retrieve the image to remove from filesystem in case of successful deletion operation
            $image = "";
            $query = 'SELECT image FROM products WHERE id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $productId);
            $stmt->execute();
            $stmt->bind_result($image);
            $stmt->fetch();
            $stmt->close();

            // Delete the product based on product id
            $query = 'DELETE FROM products WHERE id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $productId);
            $stmt->execute();
            if ($stmt->error) {
                return false;
            } else {
                unlink("./imgs/" . $image);
                return true;
            }
        } else {
            return false;
        }
    }
}
?>