<?php
include "header.php";
include "config.php";
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
}

$sql = "SELECT * from categories";
$result = mysqli_query($db, $sql);
?>

<main class="bg-light">
    <div class="container-fluid py-4">
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

        <!-- Users Table Section -->
        <section class="row m-auto">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>All Categories</h3>
                <a href="new_category.php" class="btn btn-success">New Category</a>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
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
                        echo "<td>
                            <a class='btn btn-sm btn-primary' href='edit_category.php?user_id={$row["id"]}'>Edit</a>
                            <a class='btn btn-sm btn-danger' href='delete_category.php?user_id={$row["id"]}' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                            </td>";
                        echo "</tr>";
                        $counter++;
                    }
                } else {
                    echo "<tr><td colspan='5'>No categories found.</td></tr>";
                } ?>
                </tbody>
            </table>
        </section>
    </div>
</main>

<?php include "footer.php"; ?>
