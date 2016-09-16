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
<body style="color:white" class="body">
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
                        <a href="contactus.html">Contact</a>
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

    $ArrayCollegeLLinks=array("Bansilal Ramnath Agarawal Charitable Trust's Vishwakarma Institute of Technology Bibwewadi"=>"colleges/vit.html");
    $ArrayCollegeLLinks["Institute of Computer Technology Dhankavdi"]="colleges/pict.html";
    $ArrayCollegeLLinks["Maharashtra Institute of Technology Kothrud"]="colleges/mit.html";
    $ArrayCollegeLLinks["Sinhgad College of Engineering Vadgaon (BK)"]="colleges/sinhgad.html";
    $ArrayCollegeLLinks["MAEER's M.I.T. College of Engineering Kothrud"]="colleges/mitcoe.html";
    $ArrayCollegeLLinks["All India Shri Shivaji Memorial Society's Institute of Information Technology"]="colleges/aissms.html";
    $ArrayCollegeLLinks["Bhartiya Vidya Bhavan's Sardar Patel Institute of Technology Andheri"]="colleges/sardar_patel.html";
    $ArrayCollegeLLinks["Veermata Jijabai Technological Institute(VJTI), Matunga"]="colleges/VJTI.html";

    $keys=array("Bansilal Ramnath Agarawal Charitable Trust's Vishwakarma Institute of Technology Bibwewadi","Institute of Computer Technology Dhankavdi",
        "Maharashtra Institute of Technology Kothrud","Sinhgad College of Engineering ,Vadgaon (BK)","MAEER's M.I.T. College of Engineering Kothrud"
       ,"All India Shri Shivaji Memorial Society's Institute of Information Technology","Bhartiya Vidya Bhavan's Sardar Patel Institute of Technology Andheri",
        "Veermata Jijabai Technological Institute(VJTI), Matunga");


    $course=$_SESSION['Course'];
//    echo $course;
    $rank=intval($_SESSION['Rank']);
//    echo $rank;
    $city=$_SESSION['City'];
//    echo $city;
    $caste='Branch.'.$_SESSION['Caste'];

    $category=$_SESSION['Caste'];
//    echo $caste;
    $round=$_SESSION['Round'];
    if ($round=='cap_round1')
        $display='CAP 1';
    else
        $display='CAP 2';
   
  
    $connection=new MongoClient();
    $db=$connection->CollegeFinder;
    $collection=$db->$round;
    //$collection1=$db->selectCollection('system.js');

    //$proccode='function getColleges() {
            
      //  return $collection1->find(array().toArray();}';

   //->limit(10);//->sort(array('college_name'=>1));
     //$collection->save(array('id'=>'getColleges','value'=>new MongoCode($proccode)));
     //$toexec='function(){return $collection1->find().toArray()}';

      $cursor=$collection->find(array('Branch.branch_name'=>$course,'city'=>$city,$caste=>array('$gte'=>$rank)));
      //$cursor=$db->execute('getColleges()');

    //var_dump($cursor);
     //print_r($cursor);
    //$arrlength = count($cursor);

//     $cursor->skip($iteration);
//     $cursor->limit(10);
    //var_dump($cursor);
    echo '<table class="table-style" id="t01">';
    echo '<tr>';
    echo '<th>COLLEGE NAME</th>';                   
    echo '<th> '.$display. '</th>';
    echo '</tr>';
    $array;
    foreach ($cursor as $r) {
       for ($i=0;$i<sizeof($r['Branch']);$i++)
        //for ($i=0;$i<$arrlength;$i++)
        {
        if($r['Branch'][$i]['branch_name']==$course && $r['Branch'][$i][$category]>$rank)
        {
//    	echo '<tr>';
//    	echo'<td>', $r['college_name'] ,'</td>';
//       // $s=$r['Branch'];
//        // ($r['Branch'][$i]['branch_name'])
//        echo'<td>' ,'&nbsp',($r['Branch'][$i]['open']),'</td>';
//    	echo '</tr>';
          //  $array->append(($r['college_name']) =>($r['Branch'][$i]['open']));

            $array[($r['college_name'])]=($r['Branch'][$i][$category]);
        }
        }	
    }
//    echo sizeof($array);
//    $keys=array_keys($array);
//    echo $keys[0];

    asort($array);

    $i=0;
    foreach($array as $key => $value) {
        if ($i > $iteration)
        {
            echo '<tr>';
            if (in_array($key,$keys)) {
                echo '<td><a href=' . $ArrayCollegeLLinks[$key] . '>', $key, '</a></td>';
            }
            else{
                echo '<td>',$key,'</td>';
            }
            // $s=$r['Branch'];
            // ($r['Branch'][$i]['branch_name'])
            echo     '<td>', '&nbsp', $value , '</td>';
            echo '</tr>';

        }
        if ($i >$iteration+10)
            break;
        $i++;
    }
    $iteration+=10;
    echo '</table>';
 ?>
    <button type="button" value="More..">More</button>
    <script type="text/javascript" class="ass1">
    $(document).ready(function(){
    $("button").click(function(){
        $.post("getmore.php",
        {
            name: <?php echo $iteration ?>,
            Course: "<?php echo $course ?>",
            Rank: <?php echo $rank ?>,
            City: "<?php echo $city ?>",
            Caste: "<?php echo $category ?>",
            Round: "<?php echo $round ?>",
        },
            function(data,status){
                console.log(data);
                $('.table-style').remove();
                $("button").remove();
                $('.ass1').remove();
                $('.body').append(data);
            });
        });
    });
    </script>
</body>
</html>
    