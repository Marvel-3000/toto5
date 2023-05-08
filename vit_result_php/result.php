
<?php 
$ccMSE = (int)$_POST["subject1MSE"]; 
$ccESE = (int)$_POST["subject1ESE"]; 
$ccTotal = $ccMSE + $ccESE;
$cdMSE = (int)$_POST["subject2MSE"]; 
$cdESE = (int)$_POST["subject2ESE"]; 
$cdTotal = $cdMSE + $cdESE;
$daaMSE = (int)$_POST["subject3MSE"]; 
$daaESE = (int)$_POST["subject3ESE"]; 
$daaTotal = $daaMSE + $daaESE; 
$wtMSE = (int)$_POST["subject4MSE"]; 
$wtESE = (int)$_POST["subject4ESE"]; 
$wtTotal = $wtMSE + $wtESE; 
$totalMarks = $ccTotal + $cdTotal + $daaTotal + $wtTotal; 
$percentage = ($totalMarks / 400) * 100; $cgpa = round(($percentage / 10), 2); 
// MySQL Configuration 
$server = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "vit"; 
$mysql_connection = mysqli_connect( $server, $username, $password, $database ); 
if (!$mysql_connection) { echo '<div class="alert alert-danger" role="alert"> <h4 class="alert-heading">Failed to connect to database ... ' . mysqli_connect_error() . ' !!! </h4></div>'; die(); 
} 
$sql_query = "INSERT INTO results(CC, CD, DAA, WT, CGPA) VALUES($ccTotal, $cdTotal, $daaTotal, $wtTotal, $cgpa)";
if (!mysqli_query($mysql_connection, $sql_query))
 { 
    echo '<div class="alert alert-danger" role="alert"> <h4 class="alert-heading">Failed to insert data to database !!! </h4></div>'; 
    die(); 
    } 
    $sql_query = "SELECT * from results"; $result = mysqli_query($mysql_connection, $sql_query); mysqli_close($mysql_connection); 
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0- alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384- KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0- alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384- ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }

        h1 {
            margin-top: 10px;
            text-align: center;
            color: yellow;
            font-size: xx-large;
            background-color: lightgreen;
        }

        th {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        td {
            background-color: #e0e0e0;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <section class="text-center">
        <h1 style="color:yellow">Results</h1>
        <table>
            <tr>
                <th>Roll No.</th>
                <th>Cloud Computing</th>
                <th>Compiler Design</th>
                <th>Design and Analysis of Algorithms</th>
                <th>Web Technology</th>
                <th>CGPA</th>
            </tr> <!-- Fetch MySQL Table Data -->
            <?php if (mysqli_num_rows($result) > 0) { while ($rows = $result->fetch_assoc()) { ?>
            <tr>
                <td>
                    <?php echo $rows["RollNo"]; ?>
                </td>
                <td>
                    <?php echo $rows["CC"]; ?>
                </td>
                <td>
                    <?php echo $rows["CD"]; ?>
                </td>
                <td>
                    <?php echo $rows["DAA"]; ?>
                </td>
                <td>
                    <?php echo $rows["WT"]; ?>
                </td>
                <td>
                    <?php echo $rows["CGPA"]; ?>
                </td>
            </tr>
            <?php } } ?>
        </table>
    </section>
</body>

</html>



