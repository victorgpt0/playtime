<?php

class captain
{
    public function search($conn)
    {
        $connn=$conn->getConnection();
        if (isset($_GET['searchKeyword']) || isset($_GET['searchFilters'])) {
            $keyword2=$_SESSION['keyword']=isset($_GET['keyword']) ? $conn->escape_values($_GET['keyword']) : '';
            $keyword =isset($_GET['keyword']) ? '%' . $conn->escape_values($_GET['keyword']) . '%' : '%';
            $type = $_SESSION['type']= isset($_GET['type']) ? $conn->escape_values($_GET['type']) : '';
            $price2=$_SESSION['price']= isset($_GET['currency-field']) ? $conn->escape_values($_GET['currency-field']) : '';
            $price = isset($_GET['currency-field']) ? $conn->escape_values(preg_replace('/[^0-9.]/', '', $_GET['currency-field'])) : '';
            $date = isset($_GET['date']) ? $conn->escape_values($_GET['date']) : '';
            $time = isset($_GET['time']) ? $conn->escape_values($_GET['time']) : '';
            //print $keyword.' '.$type.''.$price.' '.$date.' '.$time;

            $sql = "SELECT * FROM tbl_facilities WHERE name LIKE ?";    

            $params = [$keyword];

            if ($type) {
                $sql .= " AND typeId = ?";
                $params[] = $type;
            }
            if ($price) {
                $sql .= " AND price_per_hour = ?";
                $params[] = $price;
            }
            // if ($date) {
            //     $sql .= " AND availability_date = ?";
            //     $params[] = $date;
            // }
            // if ($time) {
            //     $sql .= " AND availability_time = ?";
            //     $params[] = $time;
            // }

            //echo $sql;
            //print_r($params);
            $stmt = $connn->prepare($sql);
            $stmt->execute($params);

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            //print_r($results);
        }
        
    }
}
