
<!doctype html>

<body>
<?php require "connection.php";
require "include/Header.php";
?>

<?php require "include/navbar.php";?>
<title>New Application</title>
</head>
<body>
<?php

$studenttypessql = "SELECT grad_type_id, grad_type_description FROM graduate_type";

$studenttypessqlresult = mysqli_query($conn, $studenttypessql);

$collegetypessql = "SELECT college_id, college_description FROM college";

$collegetypessqlresult = mysqli_query($conn, $collegetypessql);

$degreetypesql = "SELECT degree_id, desired_description FROM desired_degree";

$degreetypesqlresult = mysqli_query($conn, $degreetypesql);

$desiredmajorsql = "SELECT desired_major_id, desired_major_description FROM desired_major";

$desiredmajorresult = mysqli_query($conn, $desiredmajorsql);

$seasonsql = "SELECT term_season_id, term_season_description FROM term_season";

$seasonresult = mysqli_query($conn, $seasonsql);

$yearsql = "SELECT term_year_id, term_year_actual FROM term_year";

$yearresult = mysqli_query($conn, $yearsql);


//echo $studenttypessqlresult;
//echo $studenttypessql;
//echo mysqli_query($conn, "show tables;");
//grabs table values stores in $studenttypessqlresult
?>

<h1>New Application</h1>
<p>Please answer the following:</p>

<form action= "Page2_Personal_Information.php" method= "POST">
    <!--<ol>-->
    <p style='margin-left:20px;'> What type of Student are you?

        <?php

        if (mysqli_num_rows($studenttypessqlresult) > 0) {
            echo "<select>";
            while($row = mysqli_fetch_row($studenttypessqlresult)) {
                echo "<option value='" . $row[0]."'>" . $row[1] . "</option>";
            }
            echo "</select>";
        } else {
            echo "0 results";
        }

        ?>
        </select>
        <br />
    <p style='margin-left:20px;'> To which college are you applying?

        <?php

        if (mysqli_num_rows($collegetypessqlresult) > 0) {
            echo "<select>";
            while($row = mysqli_fetch_row($collegetypessqlresult)) {
                echo "<option value='" . $row[0]."'>" . $row[1] . "</option>";
            }
            echo "</select>";
        } else {
            echo "0 results";
        }
        ?>
        </select><br />
    <p style='margin-left:20px;'>What type of degree are you applying for?
        <?php

        if (mysqli_num_rows($degreetypesqlresult) > 0) {
            echo "<select>";
            while($row = mysqli_fetch_row($degreetypesqlresult)) {
                echo "<option value='" . $row[0]."'>" . $row[1] . "</option>";
            }
            echo "</select>";
        } else {
            echo "0 results";
        }

        ?>
        </select><br />
    <p style='margin-left:20px;'>Which Major are you applying to?
        <?php

        if (mysqli_num_rows($desiredmajorresult) > 0) {
            echo "<select>";
            while($row = mysqli_fetch_row($desiredmajorresult)) {
                echo "<option value='" . $row[0]."'>" . $row[1] . "</option>";
            }
            echo "</select>";
        } else {
            echo "0 results";
        }

        ?>
        <br />
    <p style='margin-left:20px;'>Which term season are you applying to?
        <?php

        if (mysqli_num_rows($seasonresult) > 0) {
            echo "<select>";
            while($row = mysqli_fetch_row($seasonresult)) {
                echo "<option value='" . $row[0]."'>" . $row[1] . "</option>";
            }
            echo "</select>";
        } else {
            echo "0 results";
        }
        ?>
        <br />
    <p style='margin-left:20px;'>Which year are you applying for?
        <?php

        if (mysqli_num_rows($yearresult) > 0) {
            echo "<select>";
            while($row = mysqli_fetch_row($yearresult)) {
                echo "<option value='" . $row[0]."'>" . $row[1] . "</option>";
            }
            echo "</select>";
        } else {
            echo "0 results";
        }
        ?>
        </select><br /><br />
        <!--</ol>-->
    <p><input type=submit value="Submit">
        <input type = reset value="Clear"></p>
</form>
</body>
<?php
// Free result set
mysqli_free_result($studenttypessqlresult);
mysqli_free_result($collegetypessqlresult);
mysqli_free_result($degreetypesqlresult);
mysqli_free_result($desiredmajorresult);
mysqli_free_result($seasonresult);
mysqli_free_result($yearresult);
mysqli_close($conn);
?>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Main jumbotron for a primary marketing message or call to action -->



      <hr>

      <footer>
        <p>Team 3: M. Weaver, A. Grieco, B. Weekes</p>
      </footer>
    </div> <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>
    </body>
</html>