<?php
include "header.php";
include "config.php";
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
}

// Ensure only users with role 1 can access this page
if (isset($_SESSION["role_user"]) && $_SESSION["role_user"] != 1) {
    header("location: index.php");
    exit();
}

// Fetch users from the database
$sql = "SELECT * FROM users";
$result = mysqli_query($db, $sql);
?>

<main class="bg-light">
    <div class="container-fluid py-4">
        <p>Welcome back, <strong><?php echo $_SESSION[
            "login_user"
        ]; ?>!</strong></p>

        <!-- Users Table Section -->
        <section class="row m-auto">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>All Users</h3>
                <a href="new_user.php" class="btn btn-success">New User</a>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0) {
                    $counter = 1; // Counter for row numbers
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<th scope='row'>{$counter}</th>";
                        echo "<td>{$row["first_name"]}</td>";
                        echo "<td>{$row["last_name"]}</td>";
                        echo "<td>{$row["email"]}</td>";
                        echo "<td>
                                    <button class='btn btn-sm btn-primary'>Edit</button>
                                    <button class='btn btn-sm btn-danger'>Delete</button>
                                    <button class='btn btn-sm btn-success'>Change Password</button>
                                  </td>";
                        echo "</tr>";
                        $counter++;
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found.</td></tr>";
                } ?>
                </tbody>
            </table>
        </section>
    </div>
</main>

<?php include "footer.php"; ?>
