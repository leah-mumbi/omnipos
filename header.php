<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>omnipos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            height: 100vh;
            display: grid;
            grid-template-areas:
                'header header header header header header header header header header'
                'menu main main main main main main main main main';
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        header {
            grid-area: header;
            height: 10vh;
            background: linear-gradient(90deg, #0056b3, #003d80, #0056b3);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        aside {
            grid-area: menu;
            font-size: 14px; /* Resize font */
            background: linear-gradient(90deg, #0056b3, #003d80);
            padding: 10px;
        }

        main {
            grid-area: main;
            height: 90vh;
        }

        .nav-item-link {
            color: #f4f4f4; /* Change link color */
            text-decoration: none; /* Remove underline */
            display: block; /* Make links fill the width */
            padding: 10px; /* Add padding for clickable area */
            border-radius: 4px; /* Rounded corners */
            transition: background-color 0.3s;
        }

        .nav-item-link:hover {
            background-color: #004080;
            text-decoration: none; /* Keep no underline on hover */
        }
    </style>
</head>
<body class="grid-container">
    <header>Omnipos</header>
    <aside>
        <nav>
            <a class="nav-item-link" href="index.php">Dashboard</a>
            <a class="nav-item-link" href="orders.php">Orders</a>
            <a class="nav-item-link" href="categories.php">Categories</a>
            <a class="nav-item-link" href="products.php">Products</a>
            <a class="nav-item-link" href="inventory_reports.php">Inventory Reports</a>
            <a class="nav-item-link" href="sales_reports.php">Sales Reports</a>
            <a class="nav-item-link" href="user_management.php">User Management</a>
            <a class="nav-item-link" href="profile.php">Profile</a>
            <a class="nav-item-link" href="logout.php">Log Out</a>
        </nav>
    </aside>
