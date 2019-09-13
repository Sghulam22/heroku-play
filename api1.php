 
 
<?php
    //this is the basic way of getting a database handler from PDO, PHP's built in quasi-ORM
    $dbhandle = new PDO("sqlite:scrabble.sqlite") or die("Failed to open DB");
    if (!$dbhandle) die ($error);
 
    //this is a sample query which gets some data, the order by part shuffles the results
    //the limit 0, 10 takes the first 10 results.
    // you might want to consider taking more results, implementing "pagination", 
    // ordering by rank, etc.
    $query = "SELECT rack, words FROM racks WHERE length=7 and weight <= 10 order by random() limit 0, 1";
    
    //this next line could actually be used to provide user_given input to the query to 
    //avoid SQL injection attacks 
    $statement = $dbhandle->prepare($query);
    $statement->execute();
    
    //The results of the query are typically many rows of data
    //there are several ways of getting the data out, iterating row by row,
    //I chose to get associative arrays inside of a big array
    //this will naturally create a pleasant array of JSON data when I echo in a couple lines
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
   
    $r=$results[0]["rack"];
    print_r($r);
    $arr=$results[0]["words"];
    
    print_r("printing the string that has all the answers:");
    print_r($arr);
    print_r("exploding in progress");
    $final=explode("@@",$arr); 
    print_r("exploding is done");
    print_r($final);
    
//     function subString($str, $n)  
//     { 
      
//     // Pick starting point 
//     for($len = 1; $len <= $n; $len++)  
//     {  
          
        // Pick ending point 
//         for ($i = 0; $i <= $n - $len; $i++)  
//         { 
              
//             // Print characters from current 
//             // starting point to current ending 
//             // point.  
//             $j = $i + $len - 1;          
//             for ($k = $i; $k <= $j; $k++) 
//              $query = 'SELECT rack, words FROM racks WHERE rack ="$str[$k]"';
//              $statement = $dbhandle->prepare($query);
//              $statement->execute();
//              $results = $statement->fetchAll(PDO::FETCH_ASSOC);
//              print_r($results[0]["rack"]);
//              print_r($results[0]["words"]);
    
//              print_r($str[$k]); 
         
              
//             echo "\n"; 
//         } 
//     } 
// } 
  
//     // Driver Code 
//     $str = "abc"; 
//     subString($r, strlen($r)); 

   //this part is perhaps overkill but I wanted to set the HTTP headers and status code
    //making to this line means everything was great with this request
    header('HTTP/1.1 200 OK');
    //this lets the browser know to expect json
    header('Content-Type: application/json');
    //this creates json and gives it back to the browser
    echo json_encode($results);
?>
