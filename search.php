<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- links -->
  <link rel="icon" type="png" href="img/icon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="css/search.css" />
  <!-- Title -->
  <title>Document</title>
</head>

<body>
  <div class="pc">
    <!-- nav section -->
    <nav>
      <ul>
        <li><a href="weather.php"><i class="fa-solid fa-location-arrow"></i></a></li>
        <li><a class="active" href="search.php"><i class="fa-solid fa-magnifying-glass"></i></a></li>
        <li><a href="world.php"><i class="fa-solid fa-earth-americas"></i></a></li>
      </ul>
    </nav>
    <!-- main section -->
    <h3>Search For City</h3>
    <!-- search -->
    <div class="search">
      <div class="search-icon"><i class="fa-solid fa-location-dot"></i></div>
      <input class="searchinput" type="text" placeholder="search...">
    </div>
    <!-- message -->
    <div class="message">
      <p>You have the option to search by city, state, or country names.</p>
    </div>
    <!-- error message -->
    <div class="error-message">
      <p>One of the specified locations (city, state, or country) was not found. Please try again</p>
    </div>
    <!-- weather -->
    <div class="return">
      <div class="box">
        <div class="weather-box">
          <div class="name">
            <div class="city-name">Landon</div>
            <div class="weather-temp">20°</div>
          </div>
          <div class="weather-icon"><img class="weather-img" src="img/haze.png" alt=""></div>
        </div>
        <!-- 1 -->
        <div class="weather-desc">
          <div class="desc-box">
            <div class="desc-icon"><i class="fa-solid fa-wind"></i></div>
            <div class="desc-name">Wind</div>
            <div class="desc-info wind">15 m/s</div>
          </div>

          <div class="desc-box">
            <div class="desc-icon"><i class="fa-solid fa-temperature-full"></i></div>
            <div class="desc-name">Pressure</div>
            <div class="desc-info pressure">15 mbar</div>
          </div>

          <div class="desc-box">
            <div class="desc-icon"><i class="fa-solid fa-droplet"></i></div>
            <div class="desc-name">Humidity</div>
            <div class="desc-info humidity">50%</div>
          </div>
        </div>
        <!-- 2 -->
        <div class="weather-desc">
          <div class="desc-box">
            <div class="desc-icon"><i class="fa-solid fa-sun"></i></div>
            <div class="desc-name">Sun Rise</div>
            <div class="desc-info sunrise">12:00:00</div>
          </div>

          <div class="desc-box">
            <div class="desc-icon"><i class="fa-solid fa-cloud-sun"></i></div>
            <div class="desc-name">Sun Set</div>
            <div class="desc-info sunset">12:00:00</div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- main.js -->
  <script src="js/search.js"></script>
</body>

</html>
