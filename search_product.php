<?php
// set page headers
$page_title = "Search Product";
include_once "header.php";

echo "<div class='right-button-margin'>";
echo "<a href='loginproduct.php' class='btn btn-success pull-left'> Products List</a>";
echo "</div>";

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// set number of records per page
$records_per_page = 10;

// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// get database connection
include_once 'config/database.php';
include_once 'objects/category.php';

$database = new Database();
$db = $database->getConnection();
// if the form was submitted
if ($_POST) {

    // instantiate product object
    include_once 'objects/product.php';
    $product = new Product($db);


    // set product property values
    $product->name = $_POST['name'];
    $product->madeyearfrom = $_POST['madeyearfrom'];
    $product->madeyearto = $_POST['madeyearto'];
    $product->pricefrom = $_POST['pricefrom'];
    $product->priceto = $_POST['priceto'];
    $product->kmfrom = $_POST['kmfrom'];
    $product->kmto = $_POST['kmto'];
    $product->category_id = $_POST['category_id'];

    // query products
    $stmt = $product->search($page, $from_record_num, $records_per_page);
    $num = $stmt->rowCount();
    
    // display the products if there are any
if ($num > 0) {
    $category = new Category($db);

    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
    echo "<th>Make</th>";
    echo "<th>Price</th>";
    echo "<th>Madeyear</th>";
    echo "<th>KM</th>";
    echo "<th>Category</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        echo "<tr>";
        echo "<td>{$name}</td>";
        echo "<td>{$price}</td>";
        echo "<td>{$madeyear}</td>";
        echo "<td>{$km}</td>";
        echo "<td>";
        $category->id = $category_id;
        $category->readName();
        echo $category->name;
        echo "</td>";

        echo "<td>";
        // edit and delete button is here
        echo "<a href='update_product.php?id={$id}' class='btn btn-success left-margin'>Edit</a>";
        echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>Delete</a>";
        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";

    // paging buttons here
    include_once 'paging_product.php';

    // paging buttons will be here
} else {// tell the user there are no products
    echo "<div>No products found.</div>";
}
}
?>

<div class="bs-example">
    <form action='search_product.php' method='post'>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="make">MAKE:</label>
                    <select class="form-control" id="name" name="name">
                        <option>Select brand..</option>
                        <option value="Ford">Ford</option>
                        <option value="Honda">Honda</option>
                        <option value="Hyundai">Hyundai</option>
                        <option value="Kia">Kia</option>
                        <option value="Audi">Audi</option>
                        <option value="MBW" >MBW</option>
                        <option value="Toyota" >Toyota</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="madeyear">Made Year:</label>
                    <select class="form-control" id="madeyearfrom" name="madeyearfrom">
                        <option>Select year...</option>
                        <option value="2004">2004</option>
                        <option value="2005">2005</option>
                        <option value="2006">2006</option>
                        <option value="2007">2007</option>
                        <option value="2008">2008</option>
                        <option value="2009">2009</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                    </select>
                     ~ 
                    <select class="form-control" id="madeyearto" name="madeyearto">
                        <option>Select year...</option>
                        <option value="2004">2004</option>
                        <option value="2005">2005</option>
                        <option value="2006">2006</option>
                        <option value="2007">2007</option>
                        <option value="2008">2008</option>
                        <option value="2009">2009</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                    </select>
                </div>
                <div class="form-group"> 
                    <label for="price">Price :</label>
                    <input type="text" class="form-control" id="pricefrom" name="pricefrom"> ~
                    <input type="text" class="form-control" id="priceto" name="priceto">
                </div>
                <div class="form-group"> 
                    <label for="km">KM :</label>
                    <input type="text" class="form-control" id="kmfrom" name="kmfrom"> ~
                    <input type="text" class="form-control" id="kmto" name="kmto">
                </div>

                <div class="kind">
                    <label for="sel1">Kind:</label>
                    <?php
                    // read the product categories from the database
                    include_once 'objects/category.php';
                    $category = new Category($db);
                    $stmt = $category->read();
                    // put them in a select drop-down
                    echo "<select class='form-control' name='category_id'>";
                    echo "<option>Select category...</option>";
                    while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_category);
                        echo "<option value='{$id}'>{$name}</option>";
                    }
                    echo "</select>";
                    ?>
                </div>
                <div class="form-group"> 
                    <button type="submit" class="btn btn-primary"> Search </button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
include_once "footer.php";
?>