<?php
require_once '../../admin/dbcon/conn.php';

$query = "SELECT 
    SUBSTRING_INDEX(SUBSTRING_INDEX(productDetails, ', ', n.n), ' ', 1) as productName,
    SUM(CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(productDetails, ', ', n.n), ' ', -1), ',', 1) AS UNSIGNED)) as totalSold
FROM 
    orderpos
CROSS JOIN 
    (SELECT 1 as n UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) n
WHERE 
    n.n <= 1 + (LENGTH(productDetails) - LENGTH(REPLACE(productDetails, ',', '')))
GROUP BY 
    productName
ORDER BY 
    totalSold DESC
LIMIT 10";

$result = $conn->query($query);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = array(
        "label" => $row['productName'],
        "y" => intval($row['totalSold'])
    );
}

echo json_encode($data);

$conn->close();
?>