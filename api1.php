 
  
<?php
    //this is the basic way of getting a database handler from PDO, PHP's built in quasi-ORM
    $dbhandle = new PDO("sqlite:scrabble.sqlite") or die("Failed to open DB");
    if (!$dbhandle) die ($error); 
   
    //this is a sample query which gets some data, the order by part shuffles the results 
    //the limit 0, 10 takes the first 10 results.
    // you might want to consider taking more results, implementing "pagination", 
    // ordering by rank, etc.
    $temp="ABCD"; 
    $query = "SELECT rack, words FROM racks WHERE length=7 and weight <= 10 order by random() limit 0, 1";
    $query2 = "SELECT rack, words FROM racks WHERE length=7 and weight <= 10 order by random() limit 0, 1";
    $query3 = "SELECT rack, words FROM racks WHERE rack='$temp'";
     
    //this next line could actually be used to provide user_given input to the query to 
    //avoid SQL injection attacks 
    $statement = $dbhandle->prepare($query);
    $statement->execute();

    $s2= $dbhandle->prepare($query2);
    $s2->execute();
    $r1= $s2->fetchAll(PDO::FETCH_ASSOC);
   
    $s3= $dbhandle->prepare($query3);
    $s3->execute();
    $r2= $s3->fetchAll(PDO::FETCH_ASSOC);
     
    
    //The results of the query are typically many rows of data
    //there are several ways of getting the data out, iterating row by row,
    //I chose to get associative arrays inside of a big array
    //this will naturally create a pleasant array of JSON data when I echo in a couple lines
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    print_r("last rack");
    print_r($r2[0]["rack"]);
    print_r($r2); 
    print_r("second rack:");
    print_r($r1[0]["rack"]); 
    $r=$results[0]["rack"];
    print_r("first rack");
    print_r($r);
    $arr=$results[0]["words"]; 
    
    print_r("printing the string that has all the answers:");
    print_r($arr);
    print_r("exploding in progress"); 
    $final=explode("@@",$arr); 
    print_r("exploding is done");
    print_r($final);
     print_r("using subset function");
    
      
   
$racks = [];
for($i = 0; $i < pow(2, strlen($temp)); $i++){
	$ans = "";
	for($j = 0; $j < strlen($temp); $j++){
		//if the jth digit of i is 1 then include letter
		if (($i >> $j) % 2) {
		  $ans .= $temp[$j];
		}
	}
	if (strlen($ans) > 1){
  	    $racks[] = $ans;	
	}
}
$racks = array_unique($racks);
print_r($racks);
    //for ($i = 0; $i < strlen($temp); $i++) {
     //for ($j = $i+1; $j <= strlen($temp); $j++) {
   
    //$stringParts = str_split(substr($temp, $i, $j));
//      sort($stringParts);
//     $tempss=implode('',$stringParts);
//      echo "$tempss"; 
//      echo"\n";
//     }
//     }
    
//      function subString($str, $n)  
//      { 
//       $p=
      
//      // Pick starting point 
//      for($len = 2; $len <= $n; $len++)  
//      {  
          
//         // Pick ending point 
//          for ($i = 0; $i <= $n - $len; $i++)  
//          { 
             
//              // Print characters from current 
//              // starting point to current ending 
//              // point.  
//              $j = $i + $len - 1;          
//              for ($k = $i; $k <= $j; $k++) {
              
//               //$query = 'SELECT rack, words FROM racks WHERE rack ="$str[$k]"';
//               //$statement = $dbhandle->prepare($query);
//               //$statement->execute();
//               //$results = $statement->fetchAll(PDO::FETCH_ASSOC);
//               //print_r($results[0]["rack"]);
//               //print_r($results[0]["words"]);
              
//               print_r($str[$k]); 
              
//              }
              
//             echo "\n"; 
//          } 
//      } 
//  } 
  
// //     // Driver Code 
// //     $str = "abc"; 
//      subString($temp, strlen($temp)); 
 
   //this part is perhaps overkill but I wanted to set the HTTP headers and status code
    //making to this line means everything was great with this request
    header('HTTP/1.1 200 OK');
    //this lets the browser know to expect json
    header('Content-Type: application/json');
    //this creates json and gives it back to the browser
    echo json_encode($results);     
?> 
