<?php
include "header.php";
include "config.php";
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
}

$sql = "SELECT * from products";
$result = mysqli_query($db, $sql);
?>

<main class="bg-light">
    <section class="row m-auto">
            <p>Welcome back, <strong><?php echo $_SESSION[
                "login_user"
            ]; ?>!</strong></p>

            <!-- Display success or error messages -->
            <?php if (!empty($_SESSION["success"])): ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION["success"];
                    unset($_SESSION["success"]);
                    ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($_SESSION["error"])): ?>
                <div class="alert alert-danger">
                    <?php
                    echo $_SESSION["error"];
                    unset($_SESSION["error"]);
                    ?>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>All Products</h3>
                <a href="new_product.php" class="btn btn-success">New Product</a>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                         <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0) {
                    $counter = 1; // Counter for row numbers
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<th scope='row'>{$counter}</th>";
                        echo "<td>{$row["name"]}</td>";
                        if($row["category"]){
                            $cat_sql = "SELECT name FROM categories WHERE id=" . intval($row['category']);
                            $cat_result = mysqli_query($db, $cat_sql);
                            if ($cat_result && mysqli_num_rows($cat_result) > 0) {
                                $category = mysqli_fetch_assoc($cat_result);
                                echo "<td>{$category["name"]}</td>";
                            } else {
                                echo "<td>N/A</td>";
                            }
                        }
                        
                        echo "<td>{$row["price"]}</td>";
                        echo "<td>{$row["quantity"]}</td>";
                        echo "<td>
                            <a class='btn btn-sm btn-primary' href='edit_product.php?id={$row["id"]}'>Edit</a>
                            <a class='btn btn-sm btn-danger' href='delete_product.php?id={$row["id"]}' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                            </td>";
                        echo "</tr>";
                        $counter++;
                    }
                } else {
                    echo "<tr><td colspan='5'>No product found.</td></tr>";
                } ?>
                </tbody>
            </table>
        </section>
</main>

<?php include "footer.php"; ?>

