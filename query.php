<?php
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------
// This is the query that executes while any text is typing in the input field
//  Input params:
//      S_POST['search'] - text typed in the input field
//      S_POST['limit'] - optional, number of first results to return
//  Output params:
//      JSON encoded associated array with the results of executing your query
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------
$query_rez = [];
if(isset($_POST['search']) && $_POST['search']) {
    $limit = (isset($_POST['limit']) && $_POST['limit'] > 0) ? $_POST['limit'] : 0;
    
    // Here you can specify you query processing
    
    // It could be:
    //      SQL searching from your database like: SELECT name FROM my_table WHERE name like '%' + $_POST['search'] + '%' + ($limit > 0 ? ' limit ' + $limit : '')
    //  or
    //      an associated array you can get any other way you need

    // This is the sample array
    //      remove it and specify $query_rez = [...] as you need

    $names = ['Liam', 'Noah', 'Oliver', 'William', 'Elijah', 'James', 'Benjamin', 'Lucas', 'Mason', 'Ethan', 'Alexander',
        'Henry', 'Jacob', 'Michael', 'Daniel', 'Logan', 'Jackson', 'Sebastian', 'Jack', 'Aiden', 'Owen', 'Samuel', 'Matthew',
        'Joseph', 'Levi', 'Mateo', 'David', 'John', 'Wyatt', 'Carter', 'Julian', 'Luke', 'Grayson', 'Isaac', 'Jayden', 'Theodore',
        'Gabriel', 'Anthony', 'Dylan', 'Leo', 'Lincoln', 'Jaxon', 'Asher', 'Christopher', 'Josiah', 'Andrew', 'Thomas', 'Joshua',
        'Ezra', 'Hudson', 'Charles', 'Caleb', 'Isaiah', 'Ryan', 'Nathan', 'Adrian', 'Christian', 'Maverick', 'Colton', 'Elias',
        'Aaron', 'Eli', 'Landon', 'Jonathan', 'Nolan', 'Hunter', 'Cameron', 'Connor', 'Santiago', 'Jeremiah', 'Ezekiel', 'Angel',
        'Roman', 'Easton', 'Miles', 'Robert', 'Jameson', 'Nicholas', 'Greyson', 'Cooper', 'Ian', 'Carson', 'Axel', 'Jaxson', 'Dominic',
        'Leonardo', 'Luca', 'Austin', 'Jordan', 'Adam', 'Xavier', 'Jose', 'Jace', 'Everett', 'Declan', 'Evan', 'Kayden', 'Parker',
        'Wesley', 'Kai', 'Brayden', 'Bryson', 'Weston', 'Jason', 'Emmett', 'Sawyer', 'Silas', 'Bennett', 'Brooks', 'Micah',
        'Damian', 'Harrison', 'Waylon', 'Ayden', 'Vincent', 'Ryder', 'Kingston', 'Rowan', 'George', 'Luis', 'Chase', 'Cole',
        'Nathaniel', 'Zachary', 'Ashton', 'Braxton', 'Gavin', 'Tyler', 'Diego', 'Bentley', 'Amir', 'Beau', 'Gael', 'Carlos',
        'Ryker', 'Jasper', 'Max', 'Juan', 'Ivan', 'Brandon', 'Jonah', 'Giovanni', 'Kaiden', 'Myles', 'Calvin', 'Lorenzo', 'Maxwell',
        'Jayce', 'Kevin', 'Legend', 'Ben'];

    $search = $_POST['search'];

    $matches = array_filter($names, function($var) use ($search) { return preg_match("/$search/i", $var); });

    if($limit && $limit > count($matches)) {
        $matches = array_slice($matches, 0, $limit, true);
    }

    $query_rez = [];
    foreach($matches as $key => $value) 
        $query_rez[][$value] = $value;
}
echo json_encode($query_rez);
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------
?>
