<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script-->

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style1.css">
    <script src="js/jquery.min.js"></script>
</head>
<body style="color:white">
<!-- Navigation -->
<?php
$iteration=0;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $iteration=$_POST["name"];
}
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">COLLEGE FINDER</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">ContactUs</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<br>
<br>
<br>
<br>
<br>
<?php
session_start();
print_r($_SESSION);
$course=$_SESSION['Course'];
$rank=intval($_SESSION['Rank']);
echo $rank;
$connection=new MongoClient();
$db=$connection->CollegeFinder;
$collection=$db->cap_round2;
$cursor=$collection->find(array('Branch.branch_name' =>$course,"Branch.open"=>array('$gte'=>$rank)))->limit(10);//->sort(array('college_name'=>1));
$cursor->skip($iteration);
//var_dump($cursor);
echo '<table class="table-style" id="t01">';
echo '<tr>';
echo '<th>COLLEGE NAME</th>';
echo '<th>CAP1</th>';
echo '</tr>';
foreach ($cursor as $r) {
    for ($i=0;$i<sizeof($r['Branch']);$i++)
    {
        if($r['Branch'][$i]['branch_name']==$course && $r['Branch'][$i]['open']>$rank)
        {
            echo '<tr>';
            echo'<td>', $r['college_name'] ,'</td>';
            //$s=$r['Branch'];
            echo'<td>',($r['Branch'][$i]['branch_name']) ,'&nbsp',($r['Branch'][$i]['open']),'</td>';
            echo '</tr>';
        }
    }
}
$iteration+=10;
echo '</table>';
?>
<button type="button" value="More..">More</button>
<script type="text/javascript">
    $(document).ready(function(){
        $("button").click(function(){
            $.post("Result.php",
                {
                    name: <?php echo $iteration; ?>,
                },
                function(data,status){
                    document.write(data);
                    //Window.reload(true);
                });

//            $.ajax({
//                    type: 'POST',
//                    url: "Result.php",
//                    data: {
//                        name: "10",
//                },
//                complete: function () {
//                    window.location.reload(true);
//            }
//        });
        });
    });

</script>

</body>
</html>
    