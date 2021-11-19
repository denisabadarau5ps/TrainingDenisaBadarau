<?php

//class that deals with CRUD operations
class ProductRepository
{
    //get all the products from products table
    public function getAllProducts()
    {
        require_once 'common.php';
        $conn = connect();
        $sql = "SELECT * FROM products";
        $data = $conn->query($sql)->fetchAll();
        $products = [];

        foreach ($data as $item) {
            $id = $item['id'];
            $title = $item['title'];
            $description = $item['description'];
            $price = $item['price'];

            $product = new Product($id, $title, $description, $price);
            array_push($products, $product);
        }
        return $products;
    }

    //get all products that are not in cart
    public function getAllProductsNotInCart($cart)
    {
        require_once 'common.php';
        $conn = connect();
        $cart = implode(",", $cart);
        $sql = "SELECT * FROM products WHERE id NOT IN($cart)";
        $data = $conn->query($sql)->fetchAll();
        $products = [];

        foreach ($data as $item) {
            $id = $item['id'];
            $title = $item['title'];
            $description = $item['description'];
            $price = $item['price'];

            $product = new Product($id, $title, $description, $price);
            array_push($products, $product);
        }
        return $products;
    }

    //get all products from cart
    public function getAllProductsFromCart($cart)
    {
        require_once 'common.php';
        $conn = connect();
        $sql = "SELECT * FROM products WHERE id IN($cart)";
        $data = $conn->query($sql)->fetchAll();
        $cart = [];

        foreach ($data as $item) {
            $id = $item['id'];
            $title = $item['title'];
            $description = $item['description'];
            $price = $item['price'];

            $product = new Product($id, $title, $description, $price);
            array_push($cart, $product);
        }
        return $cart;
    }

    //get the id from last product added in products table
    public function getIdFromLastProductAdded()
    {
        require_once 'common.php';
        $conn = connect();
        $sql="SELECT id FROM products ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);
        $row=$result->fetch_assoc();
        return  $row['id'];
    }

    //add new product in table
    public function addProduct($title, $description, $price)
    {
        require_once 'common.php';
        $conn = connect();
        $sql = "INSERT INTO products (title, description, price) VALUES(?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $price);
        $stmt->execute();

        //add an image for product
        $newImageTitle=$this->getIdFromLastProductAdded();
        addImage($newImageTitle);
    }

    //edit a product
    public function editProduct($id, $new_title, $new_description, $new_price)
    {
        require_once 'common.php';
        $conn = connect();
        $sql = "UPDATE products SET title=?, description=?, price=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $new_title);
        $stmt->bindParam(2, $new_description);
        $stmt->bindParam(3, $new_price);
        $stmt->bindParam(4, $id);
        $stmt->execute();

        //update the image
        addImage($id);
    }

    //delete a product
    public function deleteProduct($id)
    {
        require_once 'common.php';
        $conn = connect();
        $sql = "DELETE FROM products WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }

    //get a product by id
    public function getProductById($id)
    {
        require_once 'common.php';
        $conn = connect();
        $sql = "SELECT * FROM products WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $data = $stmt->fetch();

        $title = $data['title'];
        $description = $data['description'];
        $price = $data['price'];
        $product = new Product($id, $title, $description, $price);
        return $product;
    }
}

