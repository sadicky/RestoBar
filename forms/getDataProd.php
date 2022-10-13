<?php 
// Database connection info 
$dbDetails = array( 
    'host' => 'localhost:8080', 
    'user' => 'root', 
    'pass' => '', 
    'db'   => 'db_magasin' 
); 
 
// DB table to use 
$table = 'products'; 
 
// Table's primary key 
$primaryKey = 'prod_id'; 
 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
    array( 'db' => 'category_id', 'dt' => 0 ), 
    array( 'db' => 'prod_name',  'dt' => 1 ), 
    array( 'db' => 'prod_code',      'dt' => 2 ), 
    array( 'db' => 'is_stock',     'dt' => 3 ), 
    array( 'db' => 'is_promo',    'dt' => 4 ),
    array( 'db' => 'prod_equiv',    'dt' => 5 )
); 
 
$searchFilter = array(); 
if(!empty($_GET['search_keywords'])){ 
    $searchFilter['search'] = array( 
        'prod_name' => $_GET['search_keywords'], 
        'prod_code' => $_GET['search_keywords'], 
        'prod_equiv' => $_GET['search_keywords']
    ); 
} 
if(!empty($_GET['filter_option'])){ 
    $searchFilter['filter'] = array( 
        'category_id' => $_GET['filter_option'] 
    ); 
} 
 
// Include SQL query processing class 
require '../ssp.class.php'; 
 
// Output data as json format 
echo json_encode( 
    SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns, $searchFilter ) 
);