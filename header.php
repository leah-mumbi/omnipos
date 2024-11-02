<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>omnipos</title>
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
                    <li><h2>New order</h2><li>
                    <li>All orders<li>
                </ul>
            </li>
            <li>
                <h1>Inventory</h1>
                <ul>
                    <li>
                        <h2>Categories</h2>
                        <ul>
                            <li>New Category<li>
                            <li>All categories<li>
                            <li>Delete Category<li>
                        </ul>
                    <li>
                    <li>All orders<li>
                </ul>
            </li>
            <li>Reports</li>
            <li>User Management</li>
            <li>Profile</li>
            <li>Log out</li>
        </ul>
    </aside>
