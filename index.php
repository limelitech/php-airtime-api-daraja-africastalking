<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Airtime</title>
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link href="" rel="stylesheet" />
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" ">
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"
    ></script>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap");

      body {
        background-color: #eaedf4;
        font-family: "Rubik", sans-serif;
      }

      .card {
        width: 310px;
        border: none;
        border-radius: 15px;
      }

      .justify-content-around div {
        border: none;
        border-radius: 20px;
        background: #f3f4f6;
        padding: 5px 20px 5px;
        color: white;
      }

      .justify-content-around span {
        font-size: 12px;
      }

      .justify-content-around div:hover {
        background: #545ebd;
        color: grey;
        cursor: pointer;
      }

      .justify-content-around div:nth-child(1) {
        background: #545ebd;
        color: #fff;
      }

      span.mt-0 {
        color: #8d9297;
        font-size: 12px;
      }

      h6 {
        font-size: 15px;
      }
      .mpesa {
        background-color: green !important;
      }
      .airtel {
        background-color: red !important;
        color: white;
      }
      .telcom {
        background-color: skyblue !important;
      }

      img {
        border-radius: 15px;
      }
      .tabcontent {
        display: none;
        padding: 6px 12px;
        border-top: none;
      }
    </style>
  </head>
  <body oncontextmenu="return false" class="snippet-body">
    <div class="container d-flex justify-content-center">
      <div class="card mt-5 px-3 py-4">
        <div class="d-flex flex-row justify-content-around">
          <div class="mpesa tablinks" onclick="openCity(event, 'safaricom')"><span>Safaricom</span></div>
          <div class="airtel tablinks" onclick="openCity(event, 'airtel')"><span>Airtel</span></div>
          <div class="telcom tablinks" onclick="openCity(event, 'telcom')"><span>Telcom</span></div>
        </div>
        <div  id="safaricom" class="tabcontent">
        <div class="media mt-4 pl-2">
          <img src="./images/safaricom.png" class="mr-3" height="75" />
          <div class="media-body">
            <h6 class="mt-1">Enter Amount & Number</h6>
          </div>
        </div>
        <div class="media mt-3 pl-2">
                          <!--bs5 input-->
            <form class="row g-3" action="./airtime.php" method="POST">
            
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Amount</label>
                  <input type="text" class="form-control" name="amount" placeholder="Enter Amount">
                </div>
                <div class="col-12">
                  <label for="inputAddress2" class="form-label" >Phone Number</label>
                  <input type="text" class="form-control" name="phone"  placeholder="Enter Phone Number">
                </div>
             
                <div class="col-6">
                  <button type="submit" class="btn btn-success" name="submit" value="submit">Buy Now</button>
                </div>
                <div class="col-6">
                  <a class="btn btn-danger" href="http://limelitech.com/">Back</a>
                </div>
              </form>
              <!--bs5 input-->
          </div>
          </div>
        <div  id="airtel" class="tabcontent">
        <div class="media mt-4 pl-2">
          <img src="./images/airtel.png" class="mr-3" height="50" width="100" />
          <div class="media-body">
            <h6 class="mt-1">Enter Amount & Number</h6>
          </div>
        </div>
        <div class="media mt-3 pl-2">
                          <!--bs5 input-->
            <form class="row g-3" action="./stk_initiate.php" method="POST">
            
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Amount</label>
                  <input type="text" class="form-control" name="amount" placeholder="Enter Amount">
                </div>
                <div class="col-12">
                  <label for="inputAddress2" class="form-label" >Mpesa Phone Number</label>
                  <input type="text" class="form-control" name="phone"  placeholder="Enter your Mpesa Number">
                </div>
                <div class="col-12">
                  <label for="inputAddress2" class="form-label" >Airtel Phone Number</label>
                  <input type="text" class="form-control" name="phone"  placeholder="Enter your Airtel Number">
                </div>
             
                <div class="col-6">
                  <button type="submit" class="btn btn-success" name="submit" value="submit">Buy Now</button>
                </div>
                <div class="col-6">
                  <a class="btn btn-danger" href="http://limelitech.com/">Back</a>
                </div>
              </form>
              <!--bs5 input-->
          </div>
          </div>
        <div  id="telcom" class="tabcontent">
        <div class="media mt-4 pl-2">
          <img src="./images/telcom.png" class="mr-3" height="80" width="150" />
          <div class="media-body">
            <h6 class="mt-1">Enter Amount & Number</h6>
          </div>
        </div>
        <div class="media mt-3 pl-2">
                          <!--bs5 input-->
            <form class="row g-3" action="./stk_initiate.php" method="POST">
            
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Amount</label>
                  <input type="text" class="form-control" name="amount" placeholder="Enter Amount">
                </div>
                <div class="col-12">
                  <label for="inputAddress2" class="form-label" >Mpesa Phone Number</label>
                  <input type="text" class="form-control" name="phone"  placeholder="Enter your Mpesa Number">
                </div>
                <div class="col-12">
                  <label for="inputAddress2" class="form-label" >Telcom Phone Number</label>
                  <input type="text" class="form-control" name="phone"  placeholder="Enter your Telcom Number">
                </div>
             
                <div class="col-6">
                  <button type="submit" class="btn btn-success" name="submit" value="submit">Buy Now</button>
                </div>
                <div class="col-6">
                  <a class="btn btn-danger" href="http://limelitech.com/">Back</a>
                </div>
              </form>
              <!--bs5 input-->
          </div>
          </div>
        </div>
      </div>
    </div>
    <script
      type="text/javascript"
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
    ></script>
    <script type="text/javascript" src=""></script>
    <script type="text/javascript" src=""></script>
    <script type="text/Javascript"></script>
    <script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
  </body>
</html>
