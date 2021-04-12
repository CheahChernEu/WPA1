<!--
Author: LEE WAI HOE
Student ID: B1801134
-->
<?php
  require_once("function.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>View Application Status</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <link rel="stylesheet" type="text/css" href="ViewApplicationStatus.css">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light py-3 fixed-top bg">
                <div class="container">
                <a class="navbar-brand" href="homepage.php">CRS.ORG</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars text-light" aria-hidden="true"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto float-right text-right">
                    <li class="nav-item">
                        <a class="nav-link ml-5" href="manageVolunteerProfile.php">Manage Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-5" href="applyForTrip.php">Apply For Trip</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-5" href="viewApplicationStatus.php">View Application</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-5" href="homepage.php">Log Out</a>
                    </li>
                  </ul>
                </div>
                </div>
              </nav>
        </header>

        <div id="main-section">
          <section class="main">
              <div class="main-content container">
                  <h1>List of Applications</h1>
                  <div id = "searchfunction-main">
                    <form name = "search-form" action = "viewApplicationStatus.php" method = "POST" >
                      <div class="inputbox">
                          <label for="searchbox" style="font-size: 20px; font-weight: 400;">Search By ID or any Keyword of Trip Description</label>
                          <input type="text" placeholder="e.g. 2 or wild animals" id="searchbox" name="searchbox" autofocus>
                          <input type="submit" id="submit" name="search" value="Search">
                      </div>
                    </form>
                    <?php
                    $servername = "localhost";
                    $username   = "root";
                    $password   = "";
                    $dbname     = "crs";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT * FROM Application INNER JOIN crisistrip ON Application.cTID_fk = crisistrip.cTID WHERE Application.userID_fk = '".$_SESSION['userID']."'";

                    //The search function
                    if (isset($_POST['search'])){
                      $search_term = $_POST['searchbox'];
                      $sql = "SELECT * FROM Application INNER JOIN crisistrip ON Application.cTID_fk = crisistrip.cTID WHERE (Application.userID_fk = '".$_SESSION['userID']."') AND (crisistrip.cTID = '$search_term' OR crisistrip.description LIKE '%$search_term%')";
                    }
                    $sql_run = mysqli_query($conn, $sql);
                    ?>
                  </div>
                  <div id = "table-main">
                    <table class = "content-table table-bordered table-secondary table table-dark table-responsive">
                      <tr class = "header-row" style="background-color: orange; color: black;">
                        <th>CTID</th>
                        <th>Trip Date</th>
                        <th>Trip Description</th>
                        <th>Application ID</th>
                        <th>Application Date</th>
                        <th>Status</th>
                        <th>Remarks</th>
                      </tr>

                      <?php
                      $servername = "localhost";
                      $username   = "root";
                      $password   = "";
                      $dbname     = "CRS";

                      // Create connection
                      $conn = new mysqli($servername, $username, $password, $dbname);
                      if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                      }

                      if ($sql_run -> num_rows > 0){
                        while ($row = $sql_run -> fetch_assoc()){
                          echo "<tr class='content-row'>";
                          echo "<td>".$row['cTID']."</td>";
                          echo "<td>".$row['cTDate']."</td>";
                          echo "<td>".$row['description']."</td>";
                          echo "<td>".$row['applicationID']."</td>";
                          echo "<td>".$row['applicationDate']."</td>";
                          echo "<td>".$row['applicationStatus']."</td>";
                          echo "<td>".$row['remarks']."</td>";
                          echo "</tr>";
                        }
                      }
                      else{
                        echo "0 result";
                      }
                      ?>
                    </table>
                  </div>
              </div>
          </section>
        </div>

        <section id="contact">
            <footer class="py-5">
                <div class="container" py-5>
                    <div class="row">
                        <div class="col-md-5 col-sm-6">
                            <h2>CRS Sdn. Bhd.</h2>
                            <p>Wisma Help, Jalan Dungun, Bukit Damansara,<br>50490 Kuala Lumpur,<br>Wilayah Persekutuan Kuala Lumpur</p>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="footer-info">
                                <h2>Keep In Touch</h2>
                                <p><a href="#">016-1234567</a></p>
                                <p><a href="#">CRS@gmail.com</a></p>
                                <p><a href="#">Our Location</a></p>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-12">
                            <div class="footer-info">
                                <h2>About Us</h2>
                                <p>CRS is an NGO (Non-Government Organization) that aims to help people who are facing crises arising from natural disasters such as flood and earthquakes.</p>
                            </div>
                        </div>

                        <div class="col-md-12 col-12 text-center">
                            <div class="copyright-text">
                                <p>Copyright @ 2021 <a href="#">CRS Organization</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
          </section>

          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script>

            $(document).ready(function () {
              //=================================================================
              //click on table body
          		$('#table-main').on('click', 'tr', function() {
          		    //get row contents into an array
                  var tableData = $(this).children("td").map(function() {
                    return $(this).text();
                  }).get();
                  var td = "CTID: " + tableData[0] + "\nTrip Date: " + tableData[1] + "\nTrip Description: " + tableData[2] + "\nApplication ID: " + tableData[3] + "\nApplication Date: " + tableData[4] + "\nApplication Status: " + tableData[5] + "\nRemarks: " + tableData[6];
                  alert(td);
          		});
        		});
          </script>
    </body>
</html>
