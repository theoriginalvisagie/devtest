<?php
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);
	/**
	
	 * QUESTION 3
	 *
	 * For each month that had sales show a list of customers ordered by who spent the most to who spent least.
	 * If the totals are the same then sort by customer.
	 * If a customer has multiple products then order those products alphabetical.
	 * Months with no sales should not show up.
	 * Show the name of the customer, what products they bought and the total they spent.
	 * Only show orders with the "Payment received" and "Dispatched" status.
	 * If there are no results, then it should just say "There are no results available."
	 *
	 * Please make sure your code runs as effectively as it can.
	 *
	 * See test3.html for desired result.
	 */

	/**
	 * Class for all php functions
	 */
    require_once("config.php");
	require_once(MOD_DIR."/Data/Data_class.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Test3</title>

	<link href = "<?php echo URLROOT?>/admin/style/style.css" rel="stylesheet">
</head>
<body>
<h1>Top Customers per Month</h1>

<?php
	$dataObj = new Data();

	$data = $dataObj->getSQLData();
	$tableHeadings = $dataObj->getTableHeadings();
?>

<?php foreach($data as $year => $yearData): ?>
    <?php foreach($yearData as $month => $monthData): ?>
        <h2><?php echo $month . " " . $year; ?></h2>
        <table>
            <thead>
                <tr>
                    <?php foreach($tableHeadings as $heading): ?>
						<?php if ($heading == "total"): ?>
                        	<th align="right"><?php echo ucwords(str_replace("_", " ", $heading)); ?></th>
						<?php else: ?>
							<th align="left"><?php echo ucwords(str_replace("_", " ", $heading)); ?></th>
						<?php endif; ?>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($monthData as $user => $userData): ?>
                    <?php $productsBought = $userData['products_bought']; ?>
                    <?php $totalProducts = count($productsBought); ?>
                    <?php $rowIndex = 0; ?>
                    <?php foreach($productsBought as $product => $price): ?>
                        <?php if ($rowIndex === 0): ?>
                            <tr>
                                <td rowspan="<?php echo $totalProducts; ?>" class="w200" align="left"><?php echo $user; ?></td>
                                <td class="w400" align="left"><?php echo $product; ?></td>
                                <td rowspan="<?php echo $totalProducts; ?>"  class="w200 bottomValign" align="right"><?php echo "R ".number_format($userData['total'],2); ?></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td><?php echo $product; ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php $rowIndex++; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
<?php endforeach; ?>

</body>
</html>