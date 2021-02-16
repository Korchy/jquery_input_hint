<?php
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------
// This is the query that executes while any text is typing in the input field
//  Input params:
//      S_POST['search'] - text typed in the input field
//      S_POST['limit'] - optional, number of first results to return
//  Output params:
//      JSON encoded associated array with the results of executing your query
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------
$query_rez = '';
if(isset($_POST['search']) && $_POST['search']) {
    $limit = (isset($_POST['limit']) && $_POST['limit'] > 0) ? $_POST['limit'] : 0;
    
    // Here you can specify you query processing
    
    // It could be:
    //      SQL searching from your database like: SELECT name FROM my_table WHERE name like '%' + $_POST['search'] + '%' + ($limit > 0 ? ' limit ' + $limit : '')
    //  or
    //      an associated array you can get any other way you need

    // This is the sample array
    //      remove it and specify $query_rez = [...] as you need

    $query_rez = [
        ['variant_01_a' => 'Ivanov', 'variant_01_b' => 'Ivan'],
        ['variant_02_a' => 'Ivanishevich', 'variant_02_b' => 'Peter'],
        ['variant_03_a' => 'Miiva', 'variant_03_b' => 'Daniella'],
        ['variant_04_a' => 'Nivalov', 'variant_04_b' => 'Nien'],
        ['variant_05_a' => 'Iva', 'variant_05_b' => 'Nguen'],
        ['variant_06_a' => 'Brival', 'variant_06_b' => 'Mikhail']
    ];

}
echo json_encode(array_slice($query_rez, 0, $limit, true));
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------
?>
