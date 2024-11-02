<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>omnipos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <style>
    *{
        margin:0;
        padding:0;
    }
    body{
    height: 100vh;
    display: grid;
    grid-template-areas:
        'menu header header header header header header header'
        'menu main main main main main main main'
        'menu main main main main main main main'
        'menu main main main main main main main'
        'menu main main main main main main main';
    background-color: #ffffff;
    }

    header{
        grid-area: header;
        height: 10vh;
        background-color: gray;
    }

    aside{
        grid-area: menu;
        background-color:green;
    }

    main{
        grid-area: main;
        height: 90vh;
        background-color: brown;
    }
    </style>

    </head>
    <body class="grid-container">
    <header>Header</header>
    <aside>
        <ul>
            <li>
                <h1>Orders</h1>
                <ul>
                    <li><h3>New order</h3><li>
                    <li><h3>All orders<h3><li>
                </ul>
            </li>
            <li>
                <h1>Inventory</h1>
                <ul>
                    <li>
                        <h3>Categories</h3>
                        <ul>
                            <li>New Category<li>
                            <li>All categories<li>
                            <li>Delete Category<li>
                        </ul>
                          
                    
                    <li> 
                        <h3>Products</h3>
                        <ul>
                            <li>New Product</li>
                            <li>All products</li>
                            <li>Delete Product</li>
                        </ul>
<li>
                </ul>
            </li>
            <li>
                <h1>Reports</h1>
                    
            </li>
            <li>User Management</li>
            <li>Profile</li>
            <li>Log out</li>
        </ul>
    </aside>
