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
                <ul class="nav navbar-nav" id="nav-bar">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <li style="margin-left:600px">
                      <a href="#">Account settings</a>
                      <ul>
                        <li><a href="logout.php">Logout</a></li>
                        <li><a href="change_pass.php">Change Password</a></li>
                        <li><a href="delete.php">Delete Account</a></li>
                      </ul>         
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
    
    $course=$_SESSION['Course'];
    $rank=intval($_SESSION['Rank']);    
    $city=$_SESSION['City'];
    $caste='Branch.'.$_SESSION['Caste'];
    $round=$_SESSION['Round'];
    if ($round=='cap_round1')
        $display='CAP 1';
    else
        $display='CAP 2';
   
  
    $connection=new MongoClient();
    $db=$connection->college;
    $collection=$db->$round;
    //$collection1=$db->selectCollection('system.js');

    //$proccode='function getColleges() {
            
      //  return $collection1->find(array().toArray();}';

   //->limit(10);//->sort(array('college_name'=>1));
     //$collection->save(array('id'=>'getColleges','value'=>new MongoCode($proccode)));
     //$toexec='function(){return $collection1->find().toArray()}';
     
      //$cursor=$collection->find(array('Branch.branch_name'=>$course,'city'=>$city,$caste=>array('$gte'=>$rank)));

      $cursor=$db->execute('getColleges()');
      
     //print_r($cursor);
     //$cursor->skip($iteration);
    //var_dump($cursor);

    echo '<table class="table-style" id="t01">';
    echo '<tr>';
    echo '<th>COLLEGE NAME</th>';                   
    echo '<th> '.$display. '</th>';
    echo '</tr>';
  
    foreach ($cursor as $r) {
       //while(!$cursor->dead())
        for ($i=0;$i<100;$i++)
        {
            $s=$r[$i];
            echo sizeof($s);
       //      for ($j=0;sizeof($s['Branch']);$j++)
       //      {
       //           if($s['Branch'][$j]['branch_name']==$course && $s['Branch'][$j]['open']>$rank)
       //          {
    	  //      echo '<tr>';
    	  //      echo'<td>', $s['college_name'] ,'</td>';
       // // $s=$r['Branch'];
       //  // ($r['Branch'][$i]['branch_name'])
       //          echo'<td>' ,'&nbsp',($s['Branch'][$j]['open']),'</td>';
    	  //      echo '</tr>'; 
       //           }
       //      }
        }	
    }
    //$iteration+=10;
    echo '</table>';
 ?>
    <!--<button type="button" value="More..">More</button>
    <script type="text/javascript">
    $(document).ready(function(){
    $("button").click(function(){
        $.post("Result.php",
        {
          name: "10",
        },
            function(data,status){
                document.write(data);
            });
        });
    });
    </script>
    ?>-->
</body>
</html>
    