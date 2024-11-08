<?php
include('includes/configtwo.php');
$data = array();

$query = "SELECT id, title, start_event, end_event FROM events ORDER BY id";
$statement = $dbhh->prepare($query);
$statement->execute();
$statement->store_result(); // Store the result set locally

// Bind result variables
$statement->bind_result($id, $title, $start, $end);

// Fetch rows
while ($statement->fetch()) {
    $data[] = array(
        'id'    => $id,
        'title' => $title,
        'start' => $start,
        'end'   => $end
    );
}

echo json_encode($data);

// Close the statement
$statement->close();
?>
