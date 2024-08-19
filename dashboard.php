<?php
    
    session_start();

    include 'includes/database.php';
    include 'includes/action.php';

    $sql = "SELECT * FROM Employee";
    $res = $databaseObject->connect()->query($sql);
    
?>
<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include "partials/_head.php"; ?>
<body id="body">
    <div class="container">
        <!-- top navbar -->
        <?php include "partials/_top_navbar.php"; ?>
        <main>
            <div class="main__container">
                <!-- dashboard title and greetings -->
                <div class="main__title">
                    <!-- <img src="images/hello.svg" alt=""> -->
                    
                </div>
                <!-- dashboard title ends here -->

                <!-- Cards for displaying CRUD insights -->
                <div class="main__cards">
                <div class="card birds-card">
                    <div class="card_inner">
                            <p class="text-primary-p">Birds</p>
                            <span class="font-bold text-title">
                                <?php echo $totalNumberOfBirds; ?>
                            </span>
                    </div>
                </div>

                <div class="card mortality-card">
                    <div class="card_inner death">
                        <p class="text-primary-p1">Mortality Rate</p>
                        <span class="font-bold text-title1">
                            <?php echo $mortalityRate . '%'; ?>
                        </span>
                    </div>
                </div>

                <div class="card eggs-card">
                    <div class="card_inner egg">
                        <p class="text-primary-p2">Egg Trays</p>
                        <span class="font-bold text-title2">
                            <?php echo $totalNumberOfEggs; ?>
                        </span>
                    </div>
                </div>

                <div class="card employees-card">
                    <div class="card_inner employees">
                        <p class="text-primary-p3">Employees</p>
                        <span class="font-bold text-title3">
                            <?php echo $totalNumberOfEmployees; ?>
                        </span>
                    </div>
                </div>
            </div>

                <!--Of cards for displaying CRUD insights -->
                <!-- Start of charts for displaying CRUD insights -->
                <div class="charts">
                    <div class="charts__left">
                        <div class="charts__left__title">
                            <div>
                                <h1>Payroll Visualtion</h1>
                                <p>Job titles and their respective salaries</p>
                            </div>
                            <i class="fa fa-money" aria-hidden="true"></i>
                        </div>
                        <div id="piechart_3d" style="width: 450px; height: 250px;"></div>
                    </div>

                    <div class="charts__right">
                        <div class="charts__right__title">
                            <div>
                                <h1>Stats</h1>
                                <p>Statistics of different categories</p>
                            </div>
                            <i class="fa fa-money" aria-hidden="true"></i>
                        </div>

                        <div class="charts__right__cards">
                            <div class="card1">
                            <h1>Total Wages</h1>
                            <p><?php echo 'KES '. $totalWages; ?></p>
                        </div>

                        <div class="card2">
                            <h1>Sales</h1>
                            <p><?php echo 'KES '. $sales; ?></p>
                        </div>

                        <div class="card3">
                            <h1>Feeds Left</h1>
                            <?php
                                if($remainingFeed > 0){ ?>
                                    <p><?php echo $remainingFeed . ' Kg'; ?></p>
                                <?php
                                }else{?>
                                    <p style="color: red;"><?php echo 'Please refill the feed stock!'; ?></p>
                                <?php
                                }
                                ?>
                        </div>

                        <div class="card4">
                            <h1>Trays Left</h1>
                            <?php
                                if($remainingEggs > 0){ ?>
                                    <p><?php echo $remainingEggs; ?></p>
                                <?php
                                }else{?>
                                    <p style="color: red;"><?php echo 'Nothing to sell!'; ?></p>
                                <?php
                                }
                                ?>
                        </div>
                    </div>
                </div>
                <!-- End of charts for displaying CRUD insights -->
            </div>
        </main>
        <!-- sidebar nav -->
        <?php $currentPage = 'dashboard'; include "partials/_side_bar.php"; ?>
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Employee', 'Salary'],
                <?php
                    while($row=$res->fetch_assoc()){
                        echo "['".$row['Job']."',".$row['Salary']."],";
                    }
                ?>   
            ]);
            var options = {
                is3D: true,
                colors: ['#a5aaad', '#BFD7EA', '#092327', '#0B3954'] 
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>
    <script src="script.js"></script>
</body>
</html>