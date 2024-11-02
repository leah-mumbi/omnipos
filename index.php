<?php
include "header.php";
include "config.php";
?>
<main class="bg-light">
    <div class="container">
        <h2>Dashboard</h2>
        <div class="row">
            <div class="col-md-4">
                <h5>Orders</h5>
                <ul class="list-group">
                    <li class="list-group-item"><a href="new_order.php">New Order</a></li>
                    <li class="list-group-item"><a href="all_orders.php">All Orders</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Inventory</h5>
                <ul class="list-group">
                    <li class="list-group-item"><a href="new_category.php">New Category</a></li>
                    <li class="list-group-item"><a href="all_categories.php">All Categories</a></li>
                    <li class="list-group-item"><a href="delete_category.php">Delete Category</a></li>
                    <li class="list-group-item"><a href="new_product.php">New Product</a></li>
                    <li class="list-group-item"><a href="all_products.php">All Products</a></li>
                    <li class="list-group-item"><a href="delete_product.php">Delete Product</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Reports</h5>
                <ul class="list-group">
                    <li class="list-group-item"><a href="inventory_report.php">Inventory (Tally of Products)</a></li>
                    <li class="list-group-item"><a href="sales_report.php">Sales (Profits/Losses)</a></li>
                    <li class="list-group-item"><a href="daily_sales.php">Daily</a></li>
                    <li class="list-group-item"><a href="weekly_sales.php">Weekly</a></li>
                    <li class="list-group-item"><a href="monthly_sales.php">Monthly</a></li>
                    <li class="list-group-item"><a href="daily_revenue.php">Revenue Daily</a></li>
                    <li class="list-group-item"><a href="weekly_revenue.php">Revenue Weekly</a></li>
                    <li class="list-group-item"><a href="monthly_revenue.php">Revenue Monthly</a></li>
                </ul>
            </div>
            <div class="col-md-4 mt-3">
                <h5>Users (Admin)</h5>
                <ul class="list-group">
                    <li class="list-group-item"><a href="new_user.php">New User</a></li>
                    <li class="list-group-item"><a href="all_users.php">All Users</a></li>
                    <li class="list-group-item"><a href="user_profile.php">User Profile</a></li>
                    <li class="list-group-item"><a href="delete_user.php">Delete User</a></li>
                    <li class="list-group-item"><a href="change_user_password.php">Change User Password</a></li>
                    <li class="list-group-item"><a href="user_profile_view.php">User Profile</a></li>
                    <li class="list-group-item"><a href="logout.php">Logout</a></li>
                    <li class="list-group-item"><a href="change_password.php">Change Password</a></li>
                </ul>
            </div>
        </div>
    </div>
</main>

<?php include "footer.php"; ?>
