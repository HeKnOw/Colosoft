<?php
/**
 * Created by PhpStorm.
 * User: HeKnOw
 * Date: 7/29/15
 * Time: 7:21 PM
 */
//name fo database
$database = '"thehite1_restaurant"';
//name of table
$table = '';
//name of field
$field = '';
$key=$_GET['key'];
$array = array();
//connect to database
$con=mysql_connect("localhost","thehite1_Alex","lacosecha8613891289");
//select database
$db=mysql_select_db($database,$con);
$query=mysql_query("select * from ". $table . " where " . $field . "LIKE '%{$key}%'");
while($row=mysql_fetch_assoc($query))
{
    $array[] = $row[$field];
}
echo json_encode($array);
?>
