<?php

$ArrayCollegeLLinks=array("Bansilal Ramnath Agarawal Charitable Trust's Vishwakarma Institute of Technology Bibwewadi"=>"colleges/vit.html");
$ArrayCollegeLLinks["Institute of Computer Technology Dhankavdi"]="colleges/pict.html";
$ArrayCollegeLLinks["Maharashtra Institute of Technology Kothrud"]="colleges/mit.html";
$ArrayCollegeLLinks["Sinhgad College of Engineering Vadgaon (BK)"]="colleges/sinhgad.html";
$ArrayCollegeLLinks["MAEER's M.I.T. College of Engineering Kothrud"]="colleges/mitcoe.html";
$ArrayCollegeLLinks["All India Shri Shivaji Memorial Society's Institute of Information Technology"]="colleges/aissms.html";
$ArrayCollegeLLinks["Bhartiya Vidya Bhavan's Sardar Patel Institute of Technology Andheri"]="colleges/sardar_patel.html";
$ArrayCollegeLLinks["Veermata Jijabai Technological Institute(VJTI), Matunga"]="colleges/VJTI.html";

    $iteration=0;
    $iteration=$_POST["name"];
   // echo $iteration;
    $course=$_POST['Course'];
   // echo $course;
    $rank=intval($_POST['Rank']);
   // echo $rank;
    $city=$_POST['City'];
   // echo $city;
    $caste='Branch.'.$_POST['Caste'];
    $category=$_POST['Caste'];

   // echo $caste;
    $round=$_POST['Round'];
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

$keys=array("Bansilal Ramnath Agarawal Charitable Trust's Vishwakarma Institute of Technology Bibwewadi","Institute of Computer Technology Dhankavdi",
    "Maharashtra Institute of Technology Kothrud","Sinhgad College of Engineering ,Vadgaon (BK)","MAEER's M.I.T. College of Engineering Kothrud"
,"All India Shri Shivaji Memorial Society's Institute of Information Technology","Bhartiya Vidya Bhavan's Sardar Patel Institute of Technology Andheri",
    "Veermata Jijabai Technological Institute(VJTI), Matunga");

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
    if ($i > $iteration) {
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
<script type="text/javascript">
    $(document).ready(function(){
        $("button").click(function(){
            $.post("getmore.php",
                {
                    name: <?php echo $iteration ?>,
                    Course: "<?php echo $course ?>",
                    Rank: <?php echo $rank ?>,
                    City: "<?php echo $city ?>",x
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

<button type="button" value="More..">More </button>
