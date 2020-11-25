<!DOCTYPE html>
<html lang="en">
  <head>
  <title></title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">

  </head>
  
  <body>
      <header> 
          <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
              <a class="navbar-brand" id="navbartest" href="#">Gaming Store</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pc">PC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#ps3">PS3</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#ps4">PS4</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">XBOX Series X</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">XBOX Series S</a>
                    </li>  
                    </ul>
                </div>
                
                <div class="demo">
                    <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                        <img src="images/log.png" id="logpic" style="display: inline-block;">
                        <span style="display: inline-block;">LogIn/Register</span>
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                        <img src="images/cart.png" id="cartpic" style="display: inline-block;">
                        <span style="display: inline-block;">Cart</span>
                        </a>
                    </li> 
                    </ul>
                </div>
            </nav>

        </header>


    <div id="mycarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#mycarousel" data-slide-to="0" class="active"></li>
            <li data-target="#mycarousel" data-slide-to="1"></li>
            <li data-target="#mycarousel" data-slide-to="2"></li>
        </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="images/pc.jpg" class="d-block w-100" alt="pc">
        </div>
        <div class="carousel-item">
        <img src="images/ps4.jpg" class="d-block w-100" alt="ps">
        </div>
        <div class="carousel-item">
        <img src="images/csgo.jpg" class="d-block w-100" alt="xbox">
        </div>
    </div>
    <a class="carousel-control-prev" href="#mycarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#mycarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>


    <div class = "store">

            <div class="heading" id="pc">
                <p>PC Games</p>
            </div>


                <div class="games">
                <img src="images/cod.jpg" >
                <p class="name">Call Of Duty Black Ops Cold War</p>
                <p class="price">Rs 3999</p>
                <button type="submit" class="button_1" onClick="addItem('3999')">Add to cart</button>
                </div>


                <div class="games">
                <img src="images/fifa.jpg" >
                <p class="product">Fifa 21 Ultimate Edition</p>
                <p class="price">Rs 6499</p>
                <button type="submit" class="button_1" onClick="addItem('6499')">Add to cart</button>
                </div>

                <div class="games">
                <img src="images/cyberpunk.jpg" >
                <p class="product">Cyberpunk 2077</p>
                <p class="price">Rs 2999</p>
                <button type="submit" class="button_1" onClick="addItem('2999')">Add to cart</button>
                </div>


                <div class="games">
                <img src="images/doom.png" >
                <p class="product">Doom Eternal</p>
                <p class="price">Rs 3999</p>
                <button type="submit" class="button_1" onClick="addItem('3999')">Add to cart</button>
                </div>

    
            
            <div class="heading" id="ps3">
                <p>PS3 Games</p>
            </div>

        
                <div class="games">
                <img src="images/gta5.jpg" >
                <p class="name">Grand Theft Auto V</p>
                <p class="price">Rs 1700</p>
                <button type="submit" class="button_1" onClick="addItem('1700')">Add to cart</button>
                </div>


                <div class="games">
                <img src="images/kz.jpg" >
                <p class="product">Killzone 3</p>
                <p class="price">Rs 412</p>
                <button type="submit" class="button_1" onClick="addItem('412')">Add to cart</button>
                </div>

                <div class="games">
                <img src="images/inf.jpg" >
                <p class="product">Infamous</p>
                <p class="price">Rs 455</p>
                <button type="submit" class="button_1" onClick="addItem('455')">Add to cart</button>
                </div>


                <div class="games">
                <img src="images/god.jpeg" >
                <p class="product">God Of War:Ascension</p>
                <p class="price">Rs 1999</p>
                <button type="submit" class="button_1" onClick="addItem('1999')">Add to cart</button>
                </div>

            <div class="heading" id="ps4">
                <p>PS4 Games</p>
            </div>

       
                <div class="games">
                <img src="images/farcry6.jpg" >
                <p class="name">FARCRY6</p>
                <p class="price">Rs 3999</p>
                <button type="submit" class="button_1" onClick="addItem('3999')">Add to cart</button>
                </div>


                <div class="games">
                <img src="images/nba.jpg" >
                <p class="product">NBA2K21</p>
                <p class="price">Rs 1999</p>
                <button type="submit" class="button_1" onClick="addItem('1999')">Add to cart</button>
                </div>

                <div class="games">
                <img src="images/avengers.jpeg" >
                <p class="product">Marvel's Avengers </p>
                <p class="price">Rs 3999</p>
                <button type="submit" class="button_1" onClick="addItem('3999')">Add to cart</button>
                </div>


                <div class="games">
                <img src="images/mw.jpg" >
                <p class="product">Call Of Duty Modern Warfare</p>
                <p class="price">Rs 2200</p>
                <button type="submit" class="button_1" onClick="addItem('2200')">Add to cart</button>
                </div>

    </div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
  

</html>