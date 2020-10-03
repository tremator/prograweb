<?php

$ceu = array( "Italy"=>"Rome", "Luxembourg"=>"Luxembourg", "Belgium"=> "Brussels", "Denmark"=>"Copenhagen", "Finland"=>"Helsinki", 
"France" => "Paris", "Slovakia"=>"Bratislava", "Slovenia"=>"Ljubljana", "Germany" => "Berlin", "Greece" => "Athens", "Ireland"=>"Dublin", 
"Netherlands"=>"Amsterdam", "Portugal"=>"Lisbon", "Spain"=>"Madrid", "Sweden"=>"Stockholm", "United Kingdom"=>"London", "Cyprus"=>"Nicosia", 
"Lithuania"=>"Vilnius", "Czech Republic"=>"Prague", "Estonia"=>"Tallin", "Hungary"=>"Budapest", "Latvia"=>"Riga", "Malta"=>"Valetta", 
"Austria" => "Vienna", "Poland"=>"Warsaw") ;

ksort($ceu);
foreach( $ceu as $key => $value){
    echo "The capital of $key is $value </br>";
};


$temperatures = [78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 75, 76, 73, 68, 62, 73, 72, 65, 74, 62, 62, 65, 64, 68, 73, 75, 79, 73];

rsort($temperatures);

$firstFive = [];
$biggestNumber = $temperatures[0] +1;
for($i = 0; $i < count($temperatures); $i++){
    if(count($firstFive) < 5){
        if($temperatures[$i] < $biggestNumber){
            $firstFive[] = $temperatures[$i];
            $biggestNumber = $temperatures[$i];
        }
    }
};

echo "</br>List of 5 highest temperatures: " ;
foreach($firstFive as $value){
    echo "$value, ";
};



sort($temperatures);
$lastFive = [];
$lowestNumber = 0;
for($i = 0; $i < count($temperatures); $i++){
    if(count($lastFive) < 5){
        if($temperatures[$i] > $lowestNumber){
            $lastFive[] = $temperatures[$i];
            $lowestNumber = $temperatures[$i];
        }
    }
};
echo "</br> List of 5 lowest temperatures: ";

foreach($lastFive as $value){
    echo "$value, ";
};
?>