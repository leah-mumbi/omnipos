<html>
<head>
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

<<<<<<< HEAD
header{
	grid-area: header;
    height: 10vh;
	background-color: gray;
}

aside{
	grid-area: menu;
	background-color:green;
}
=======
    <style>
        h1 {
            margin-bottom: 20px;
              text-transform: uppercase;
                word-spacing: 10px;
                text-align: center;
                width: 100%;
                
        }

        .container-fluid {
            margin-top: 30px; 
        
        }
>>>>>>> 540acc7 (changes)

main{
	grid-area: main;
	height: 90vh;
    background-color: brown;
}

<<<<<<< HEAD
</style>
=======
        .navbar-nav .nav-link {
            margin-right: 15px;
            /* Add space between links */
        }

        .navbar-nav .nav-link:last-child {
            margin-right: 0;
            /* Remove margin from the last link */
        }
        body{
              text-align: center;
        }
    </style>
>>>>>>> 540acc7 (changes)
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
