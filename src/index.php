<?php
include("./config/database.php");
$completelist = array();
$incompletelist = array();
$sql = "SELECT status FROM tasks";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //echo $row['status'];
        if ($row['status'] == 'complete') {
            $completelist[] = $row['status'];
        } else {
            $incompletelist[] = $row['status'];
        }
    }
}
//var_dump($completelist);
$myArray = array(
    array("label" => "completed", "y" => (count($completelist) / (count($completelist) + count($incompletelist))) * 100),
    array("label" => "incomplete", "y" => (count($incompletelist) / (count($completelist) + count($incompletelist))) * 100),
)
?>
<!DOCTYPE HTML>
<html>

<head>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js">
    </script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js">
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // User dynamic data from PHP 
            var passedArray = <?php echo json_encode($myArray); ?>;

            var chart = new CanvasJS.Chart("chartID", {
                title: {
                    text: "Tasks list"
                },
                data: [{
                    type: "pie",
                    animationEnabled: true,
                    indexLabelFontSize: 18,
                    fillOpacity: .7,
                    toolTipContent: "<i>{label}</i>: <b>{y}</b>",
                    radius: "80%",
                    startAngle: 75,
                    indexLabel: "{label} - {y}",
                    yValueFormatString: "##\"%\"",
                    dataPoints: passedArray
                }] // End data 

            }); // End chart	 
            chart.render();

            // End button click 
        }); // End document ready 
    </script>
</head>

<body style="background-Color:#000000">
    <div id="chartID" style="height:400px; max-width:400px; margin:0px auto;"></div>
</body>

</html>