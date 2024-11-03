<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- links -->
    <link rel="icon" type="png" href="img/icon.png" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="css/weather.css" />
    <!-- Title -->
    <title>Weather App</title>
  </head>

  <body>
    <div class="pc">
        
      <!-- nav section -->
      <nav>
        <ul>
          <li>
            <a class="active" href="weather.php"
              ><i class="fa-solid fa-location-arrow"></i
            ></a>
          </li>
          <li>
            <a href="search.php"
              ><i class="fa-solid fa-magnifying-glass"></i
            ></a>
          </li>
          <li>
            <a href="world.php"><i class="fa-solid fa-earth-americas"></i></a>
          </li>
        </ul>
      </nav>
      <!-- main section -->
      <div id="screen">
        <!-- city name -->
        <div class="city-name">
          <i class="fa-solid fa-map-pin"></i>
          <h1 id="city-name">Lagos</h1>
        </div>
        <!-- weather icon -->
        <div class="weather-icon-css">
          <img class="weather-icon" src="img/sun.png" />
        </div>
        <!-- weather details -->
        <div class="weather-description">
          <div class="show-metric" id="metric">0°</div>
          <div class="weather-details">
            <div class="weather-main" id="weather-main">Sunnen</div>
            <div class="h-f">
              <div class="show-humidity">H: <span id="humidity">60</span></div>
              ||
              <div class="show-humidity">
                F: <span id="feels-like">60</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Today-forecast -->
        <div class="forcasts-box">
          <div class="today-forecast">
            <h4>TODAY</h4>
            <div class="weather-icon-today">
              <img class="weather-icons" src="img/sun.png" />
            </div>
            <div class="temp-today">
              <span id="temp-min-today">50°</span><span>/ </span
              ><span id="temp-max-today">55°</span>
            </div>
            <div class="weather-main-today" id="weather-main">Sunnen</div>
          </div>

          <!-- 5day Forecast -->
          <div class="forecast">
            <h5>6-DAYS FORECAST</h5>
            <div id="forecast-box"></div>
            
          </div>
          
        </div>
        
      </div>
      
    </div>

    <!-- script -->
    <script src="js/main.js"></script>
  </body>
</html>
