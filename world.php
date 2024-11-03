<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- links -->
  <link rel="icon" type="png" href="img/icon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="css/world.css" />
  <!-- Title -->
  <title>Document</title>
</head>

<body>
  <div class="pc">
    <!-- nav section -->
    <nav>
      <ul>
        <li><a href="search.php"><i class="fa-solid fa-location-arrow"></i></a></li>
        <li><a href="search.php"><i class="fa-solid fa-magnifying-glass"></i></a></li>
        <li><a class="active" href="world.php"><i class="fa-solid fa-earth-americas"></i></a></li>
      </ul>
    </nav>
    <!-- main section -->
    <div class="section">
      <div class="date">April 7, 2024</div>
      <div class="button"><i class="fa-solid fa-circle-plus btn-icon"></i></div>
    </div>
    <!-- add section -->
    <div class="section-box">
      <div class="add-section">
        <div class="add-section-title">
          <h2>Add a new place</h2>
        </div>
        <!-- search -->
        <div class="search">
          <div class="search-icon"><i class="fa-solid fa-location-dot"></i></div>
          <input class="searchinput" type="text" placeholder="search...">
        </div>
        <!-- error message -->
        <div class="messages">
          <div class="error-message">City not found</div>
          <div class="normal-message">Search your city to add</div>
          <div class="added-message">Succefy added ✔</div>
        </div>
      </div>
    </div>
  </div>
</body>
<!-- javascript -->
<script src="js/world.js"></script>
</body>

</html>