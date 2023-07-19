<?php
    /**
	 * Database file and funcitons
	 * $con holds the connection
	 */
    require_once(LIB_DIR.'/db.php');

    class Data {
        function __construct(){}

        /**
         * Gets data from database
         * Fields selected
         * Product
         * Customer
         * Product Pricing
         * Order Date -> full date, Month and Year
         * 
         * @return array $results
         */
        function getSQLData(){
            
            $sql = "SELECT p.product, CONCAT(u.first_name,' ',u.last_name) as customer, p.price, o.order_date, MONTHNAME(o.order_date) as month, YEAR(o.order_date) as year FROM order_items oi 
                    LEFT JOIN products p ON p.id=oi.product_id 
                    LEFT JOIN categories c ON c.id=p.category_id 
                    LEFT JOIN orders o ON o.id=oi.order_id 
                    LEFT JOIN users u ON u.id=o.user_id 
                    LEFT JOIN statuses s ON s.id=o.order_status_id 
                    WHERE s.id IN (2,3)
                    ORDER BY YEAR(o.order_date), MONTH(o.order_date),u.id,p.id ASC";

            $results = exeSQL($sql);

            $results = $this->sortData($results);

            return $results;
        }

        /**
         * Builds an array called data consisting of all the data retrieved from the SQL statment.
         * 
         * Sorts the created data array according to total from highest to lowest for each month,
         * if the totals are the same it sorts according to customer name.
         * @return array $data
         */
        function sortData($results){
            $data = array();

            
            foreach($results as $result){
                $data[$result['year']][$result['month']][$result['customer']]['products_bought'][$result['product']] = $result['price'];

                $data[$result['year']][$result['month']][$result['customer']]['total'] += $result['price'];
            }

            foreach ($data as $year => $yearArray) {
                foreach ($yearArray as $month => $subArray) {
                    $totals = array_column($subArray, 'total');
                    $names = array_keys($subArray);
            
                    array_multisort($totals, SORT_DESC, $names, SORT_ASC, $data[$year][$month]);
                }
            }

            return $data;
        }

        /**
         * @return array of table headings
         */
        function getTableHeadings(){
            return array("customer","products_bought","total");
        }
    }
	
?>