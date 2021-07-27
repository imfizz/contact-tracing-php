<?php 

// connection in database SQLSRV
$server_name = "mssql-37762-0.cloudclusters.net,37762";
$server_details = array("Database"=>"ContactTracing", "UID"=>"contact123", "PWD"=>"Tracing123");

$con = sqlsrv_connect($server_name, $server_details); // need 2 arguments
// connection
if(!$con){
    echo "Error";
    die(print_r(sqlsrv_errors(), true));
}

?>