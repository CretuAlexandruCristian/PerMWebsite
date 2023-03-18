<?php

class ProductModel
{
    //DB stuff
    private $conn;
    private $table = 'products';

    //Properties
    public $id;
    public $brand;
    public $gender;
    public $perfume_name;
    public $stock;
    public $price;
    public $top_notes;
    public $base_notes;
    public $heart_notes;
    public $launch_year;
    public $description;
    public $season;
    public $capacity;
    public $perfume_type;
    public $ingredients;
    public $family;
    public $subfamily;
    public $occasion;
    public $sold;
    public $image_name;
    public $image_name2;
    public $image_name3;

    //Constructor with DB

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get Products
    public function read()
    {
        //Create query
        $query = 'SELECT 
                *
                FROM
                ' . $this->table . ' 
                ORDER BY id ASC
                ';
        //Prepare statement
        $stmt = $this->conn->prepare($query);
        //Execute query
        $stmt->execute();
        return $stmt;
    }

    public function readBestSellings()
    {
        //Create query
        $query = 'SELECT 
                *
                FROM
                ' . $this->table . ' 
                ORDER BY sold DESC LIMIT 7
                ';
        //Prepare statement
        $stmt = $this->conn->prepare($query);
        //Execute query
        $stmt->execute();
        return $stmt;
    }

    function str_lreplace($search, $replace, $subject)
    {
        $pos = strrpos($subject, $search);

        if ($pos !== false) {
            $subject = substr_replace($subject, $replace, $pos, strlen($search));
        }

        return $subject;
    }

    public function filter($filter)
    {
        if (str_contains($filter, "search")) {
            $search = explode("=", $filter);
            $filter = str_replace("+", "%", $search[1], $count);
            if ($count == 0) {
                $filtersQuery = "'%$filter" . "%'";
            } else
                $filtersQuery = "'$filter" . "%'";
            $query = 'SELECT
                *
                FROM
                ' . $this->table . ' WHERE brand LIKE ' . $filtersQuery . ' OR perfume_name LIKE ' . $filtersQuery . '
                ORDER BY id ASC
                ';
        } else {
            $count1 = str_replace("&", " ", $filter, $count);
            if (str_contains($filter, '.')) {
                $filter = str_replace(".", " ", $filter);
            }
            $filtersQuery = "(";
            if ($count > 0) {
                $sum = 0;
                $firstFilter = explode("&", $filter);
                $firstFilterAndValue = explode("=", $firstFilter[0]);
                $firstFilterName = $firstFilterAndValue[0];

                while ($sum <= $count) {
                    $filters = explode("&", $filter);
                    $filterAndValue = explode("=", $filters[$sum]);
                    if ($sum + 1 <= $count)
                        $filterAndValueNext = explode("=", $filters[$sum + 1]);
                    $filterValue = "'$filterAndValue[1]'";
                    if ($firstFilterName != $filterAndValue[0]) {
                        $firstFilterName = $filterAndValue[0];

                        $filtersQuery = $filtersQuery . " AND ($filterAndValue[0] =" . "$filterValue OR ";
                    } else {
                        if ($sum == $count || $firstFilterName != $filterAndValueNext[0]) {
                            $filtersQuery = $filtersQuery . "$filterAndValue[0] =" . "$filterValue)";
                        } else
                            $filtersQuery = $filtersQuery . "$filterAndValue[0] =" . "$filterValue" . " OR ";
                    }
                    $sum += 1;
                }
                if ($filtersQuery[strlen($filtersQuery) - 3] == 'O')
                    $filtersQuery = $this->str_lreplace("OR", "", $filtersQuery);
                if ($filtersQuery[strlen($filtersQuery) - 1] != ')')
                    $filtersQuery = $filtersQuery . ')';
            } else {
                $filters = explode("&", $filter);
                $filterAndValue = explode("=", $filters[0]);
                $filtersQuery = $filterAndValue[0] . "='$filterAndValue[1]'";
            }

            //Create query
            $query = 'SELECT
                *
                FROM
                ' . $this->table . ' WHERE ' . $filtersQuery . '
                ORDER BY id ASC
                ';

        }

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read_single()
    {
        //Create query
        $query = 'SELECT 
                *
                FROM
                ' . $this->table . ' 
                WHERE id=:id
                ';
        //Prepare statement
        $stmt = $this->conn->prepare($query);

//        Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind data
        $stmt->bindParam(':id', $this->id);
        //Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //set properties
        $this->brand = $row['brand'];
        $this->gender = $row['gender'];
        $this->perfume_name = $row['perfume_name'];
        $this->stock = $row['stock'];
        $this->price = $row['price'];
        $this->top_notes = $row['top_notes'];
        $this->base_notes = $row['base_notes'];
        $this->heart_notes = $row['heart_notes'];
        $this->launch_year = $row['launch_year'];
        $this->description = $row['description'];
        $this->season = $row['season'];
        $this->capacity = $row['capacity'];
        $this->perfume_type = $row['perfume_type'];
        $this->ingredients = $row['ingredients'];
        $this->family = $row['family'];
        $this->subfamily = $row['subfamily'];
        $this->occasion = $row['occasion'];
        $this->sold = $row['sold'];
        $this->image_name = $row['image_name'];
        $this->image_name2 = $row['image_name2'];
        $this->image_name3 = $row['image_name3'];
    }

    //Create Product
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . '
        SET
            brand = :brand,
            gender = :gender,
            perfume_name = :perfume_name,
            stock = :stock,
            price = :price,
            top_notes = :top_notes,
            base_notes = :base_notes,
            heart_notes = :heart_notes,
            launch_year = :launch_year,
            description = :description,
            perfume_type = :perfume_type,
            ingredients = :ingredients,
            subfamily = :subfamily,
            family = :family,
            occasion = :occasion,
            sold = :sold,
            season = :season,
            capacity = :capacity,
            image_name = :image_name,
            image_name2 = :image_name2,
            image_name3 = :image_name3
        ';
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->brand = htmlspecialchars(strip_tags($this->brand));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->perfume_name = htmlspecialchars(strip_tags($this->perfume_name));
        $this->stock = htmlspecialchars(strip_tags($this->stock));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->top_notes = htmlspecialchars(strip_tags($this->top_notes));
        $this->base_notes = htmlspecialchars(strip_tags($this->base_notes));
        $this->heart_notes = htmlspecialchars(strip_tags($this->heart_notes));
        $this->launch_year = htmlspecialchars(strip_tags($this->launch_year));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->perfume_type = htmlspecialchars(strip_tags($this->perfume_type));
        $this->ingredients = htmlspecialchars(strip_tags($this->ingredients));
        $this->family = htmlspecialchars(strip_tags($this->family));
        $this->subfamily = htmlspecialchars(strip_tags($this->subfamily));
        $this->occasion = htmlspecialchars(strip_tags($this->occasion));
        $this->sold = htmlspecialchars(strip_tags($this->sold));
        $this->season = htmlspecialchars(strip_tags($this->season));
        $this->capacity = htmlspecialchars(strip_tags($this->capacity));
        $this->image_name = htmlspecialchars(strip_tags($this->image_name));
        $this->image_name2 = htmlspecialchars(strip_tags($this->image_name2));
        $this->image_name3 = htmlspecialchars(strip_tags($this->image_name3));

        //Bind data
        $stmt->bindParam(':brand', $this->brand);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':perfume_name', $this->perfume_name);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':top_notes', $this->top_notes);
        $stmt->bindParam(':base_notes', $this->base_notes);
        $stmt->bindParam(':launch_year', $this->launch_year);
        $stmt->bindParam(':heart_notes', $this->heart_notes);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':perfume_type', $this->perfume_type);
        $stmt->bindParam(':ingredients', $this->ingredients);
        $stmt->bindParam(':family', $this->family);
        $stmt->bindParam(':subfamily', $this->subfamily);
        $stmt->bindParam(':occasion', $this->occasion);
        $stmt->bindParam(':sold', $this->sold);
        $stmt->bindParam(':capacity', $this->capacity);
        $stmt->bindParam(':image_name', $this->image_name);
        $stmt->bindParam(':image_name2', $this->image_name2);
        $stmt->bindParam(':image_name3', $this->image_name3);

        //Execute query
        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s . \n", $stmt->error);
        return false;
    }

    // UPDATE PRODUCT

    public function update()
    {
        $query = 'UPDATE ' . $this->table . '
      SET
            brand = :brand,
            gender = :gender,
            perfume_name = :perfume_name,
            stock = :stock,
            price = :price,
            top_notes = :top_notes,
            base_notes = :base_notes,
            heart_notes = :heart_notes,
            launch_year = :launch_year,
            description = :description,
            season = :season,
            capacity = :capacity,
            image_name = :image_name,
            image_name2 = :image_name2,
            image_name3 = :image_name3
        ';

        // PREPARE
        $stmt = $this->conn->prepare($query);
        // CLEAN DATA
        //Clean data
        $this->brand = htmlspecialchars(strip_tags($this->brand));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->perfume_name = htmlspecialchars(strip_tags($this->perfume_name));
        $this->stock = htmlspecialchars(strip_tags($this->stock));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->top_notes = htmlspecialchars(strip_tags($this->top_notes));
        $this->base_notes = htmlspecialchars(strip_tags($this->base_notes));
        $this->heart_notes = htmlspecialchars(strip_tags($this->heart_notes));
        $this->launch_year = htmlspecialchars(strip_tags($this->launch_year));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->perfume_type = htmlspecialchars(strip_tags($this->perfume_type));
        $this->ingredients = htmlspecialchars(strip_tags($this->ingredients));
        $this->family = htmlspecialchars(strip_tags($this->family));
        $this->subfamily = htmlspecialchars(strip_tags($this->subfamily));
        $this->occasion = htmlspecialchars(strip_tags($this->occasion));
        $this->sold = htmlspecialchars(strip_tags($this->sold));
        $this->season = htmlspecialchars(strip_tags($this->season));
        $this->capacity = htmlspecialchars(strip_tags($this->capacity));
        $this->image_name = htmlspecialchars(strip_tags($this->image_name));
        $this->image_name2 = htmlspecialchars(strip_tags($this->image_name2));
        $this->image_name3 = htmlspecialchars(strip_tags($this->image_name3));

        //Bind data
        $stmt->bindParam(':brand', $this->brand);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':perfume_name', $this->perfume_name);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':top_notes', $this->top_notes);
        $stmt->bindParam(':base_notes', $this->base_notes);
        $stmt->bindParam(':launch_year', $this->launch_year);
        $stmt->bindParam(':heart_notes', $this->heart_notes);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':perfume_type', $this->perfume_type);
        $stmt->bindParam(':ingredients', $this->ingredients);
        $stmt->bindParam(':family', $this->family);
        $stmt->bindParam(':subfamily', $this->subfamily);
        $stmt->bindParam(':occasion', $this->occasion);
        $stmt->bindParam(':sold', $this->sold);
        $stmt->bindParam(':capacity', $this->capacity);
        $stmt->bindParam(':image_name', $this->image_name);
        $stmt->bindParam(':image_name2', $this->image_name2);
        $stmt->bindParam(':image_name3', $this->image_name3);

        // EXECUTE

        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s . \n", $stmt->error);
        return false;
    }


    //   DELETE PRODUCT

    public function delete()
    {

        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        // PREPARE
        $stmt = $this->conn->prepare($query);
        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s . \n", $stmt->error);
        return false;
    }

    public function getMostSold()
    {
        $stmt = $this->conn->prepare("SELECT family, SUM(sold) AS mostSold,  SUM(sold*price) AS totalPrice 
                                      FROM products 
                                      GROUP BY family;");
        $stmt->execute();
        return $stmt;
    }

    public function getStocks(){
        $stmt = $this->conn->prepare("SELECT brand, perfume_name, stock FROM products");
        $stmt->execute();
        return $stmt;
    }

    public function getSoldLast30Days(){
        $stmt = $this->conn->prepare("SELECT COUNT(id) AS Orders, SUM(price) as Revenue 
                                      FROM orders
                                      WHERE date_completed BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY)
                                            AND NOW()");
        $stmt->execute();
        return $stmt;
    }
}

   