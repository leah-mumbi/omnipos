<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omnipos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/main.css" />

    <style>
        h1 {
            margin-bottom: 20px;
        }

        .container {
            margin-top: 30px;
        }

        .alert {
            margin-top: 20px;
        }

        .navbar-nav .nav-link {
            margin-right: 15px;
            /* Add space between links */
        }

        .navbar-nav .nav-link:last-child {
            margin-right: 0;
            /* Remove margin from the last link */
        }
    </style>
</head>

<body class="container-fluid">
    <header>
        <?php
        session_start();
        ?>
        <nav class="navbar bg-dark text-light border-bottom border-body" data-bs-theme="dark">
            <div class="container-fluid">
                <?php if (!isset($_SESSION["login_user"])): ?>
                    <h1>Welcome to Omnipos</h1>
                <?php else: ?>


                    <a class="navbar-brand" href="#">Omnipos</a>
                    <div class="navbar-nav d-flex flex-row"> <!-- Flex row for navigation items -->
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        <a class="nav-link" href="#">Features</a>
                        <a class="nav-link" href="#">Pricing</a>
                        <a class="nav-link" href="#">Contact</a>
                        <a class="nav-link" href="logout.php">Logout</a>
                    </div>
                </div>
            </nav>

            <div class="text-center text-light mt-3">
                <h2>Welcome, <?php echo htmlspecialchars($_SESSION["login_user"]); ?>!</h2>
            </div>
        <?php endif; ?>
    </header>