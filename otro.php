<?php
//$num= mt_rand();
$veces = $_POST['veces'];
function get_result(){
$valid_chars=array("1", "2", "3", "4", "5", "6", "7", "8", "9"
, "a", "b", "c", "d", "e", "f", "g", "h", "j", "k", "m", "n", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"
, "A", "B", "C", "D", "E", "F", "G", "H", "J", "K", "M", "N", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");

$result=array_rand($valid_chars, 20); //Cantidad de Caracteres
$result_str='';
foreach ($result as $value)
{
$result_str.=$valid_chars[$value];
}
return $result_str;
}
$results=array();

for ($i=0; $i<=2000; $i++)
{
array_push($results, get_result());
}

$results=array_unique($results);

$cont=0;
$results_str='';
foreach ($results as $value)
{
$cont++;
$results_str.=$value.'
';
$con = mysql_connect("localhost","root","123456");
mysql_select_db("itbb",$con);
$sel_query  = "SELECT *  FROM  licensing WHERE license ='{$value}'"; // queery to select value 
$ins_query = "INSERT INTO licensing(license) VALUES('{$value}')";    // query to insert value
$result5 =  mysql_query(sprintf($sel_query,$num),$con);
while( mysql_num_rows($result5) != 0 ) {                      // loops till an unique value is found 
    $num = get_result();
    $result5 = mysql_query(sprintf($sel_query,$num),$con);
}
mysql_query(sprintf($ins_query,$num),$con); // inserts value
if ($cont>=$veces)
{
break;
}
}

echo '<pre>';
echo $results_str;
echo '</pre>';
?>