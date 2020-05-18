<?php
  
/*/*
  * Following code will get single product details* Following code will g
 * A product is identified by product id (pid)
 */
  // array for JSON response
$response = array();

 
 	//var jqxhr = $.post("getByo.php", { lat:latlng.lat, lng:latlng.lng },
// check for post data
if (isset($_POST["lat"])) {
    $latC = $_POST["lat"];
     $lngC = $_POST["lng"];
     $cuisine = $_POST["cuisine"];
     $discount = $_POST["discount"];
 
 
 }
 
/*
 * Following code will list all the products
 */ 
  

  // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
     // connecting to db
    $db = new DB_CONNECT();
    $connect = $db->connectDB();
     
if($cuisine =="all")

$query = "SELECT * FROM  ByoAllData";

else
 
$query = "SELECT * FROM  ByoAllData where  `cuisine` = '".  $cuisine."'";

//echo $query;

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
            $response["marker"] = array(); 
                           
foreach($result as $row)
{
                         
                        
                 $distancekm =   distance($latC,$lngC,$row["lat"],$row["lng"],"K") ;      
                 
                 
                 if ($distancekm <2.5)
                 {
                 $marker = array();   
                 $marker["name"] = $row["name"];
                 $marker["URL"] = $row["URL"];
                 $marker["lat"] = $row["lat"];
                 $marker["lng"] = $row["lng"];
                 $marker["discount"] = $row["discount"];
                 
                 
                 $marker["dist"] =   strval( $distancekm );
                      
                 array_push($response["marker"], $marker);
                 }
                 
}

  // user node


                $response["result"] = "OK";

echo json_encode($response);


 
 function distance($lat1, $lon1, $lat2, $lon2, $unit) {
 
 $lat1 = doubleval($lat1);
 $lon1 = doubleval($lon1);
 $lat2 = doubleval($lat2);
 $lon2 = doubleval($lon2);
 
 
 
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
       $miles =  $miles * 1.609344;
    $miles = round($miles,2);
     $miles2 =$miles;
   
      return $miles2 ;
    } else if ($unit == "N") {
    
         $miles =  $miles * 0.8684;
         $miles= round($miles,2);
        $miles2 =$miles;
        
      return $miles2;
    } else {
    
    $miles = round($miles,2);
      $miles2 =$miles;
      return $miles2;
    }
  }
}  //end function distance          
  



//}
     
 
?>
 

