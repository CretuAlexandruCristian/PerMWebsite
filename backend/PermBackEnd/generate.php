<?php
include_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "\\PerM\\vendor\\autoload.php");
require __DIR__ . "/config/Database.php";
require __DIR__ . "/models/ProductModel.php";

if (isset($_POST['pdf'])) {
    $pdf = new FPDF();

    $database = new Database();
    $db = $database->connect();
    $productModel = new ProductModel($db);
    $rows = array();

    $result = $productModel->getSoldLast30Days();
    $row = $result->fetch(PDO::FETCH_ASSOC);
    extract($row);
    $post_item = array(
        'Orders' => $Orders,
        'Revenue' => $Revenue
    );
    $orders = $post_item['Orders'];
    $revenue = $post_item['Revenue'];

    $pdf->AddPage();
    $pdf->SetFont("Arial", "B", 15);

    $pdf->Text(10, 8, "Number of orders in the last 30 days");

    $pdf->Cell(60, 10, "Total number of orders", 1, 0);
    $pdf->Cell(60, 10, $orders, 1, 1);
    $pdf->Cell(60, 10, "Total Revenue", 1, 0);
    $pdf->Cell(60, 10, $revenue, 1, 1);

    $pdf->Ln(20);

    $result2 = $productModel->getMostSold();
    while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
        extract($row2);
        $post_item2 = array(
            'family' => $family,
            'sold' => $mostSold,
            'price' => $totalPrice
        );
        $rows[] = $post_item2;
    }
    $pdf->Cell(40, 10, "Category", 1, 0);
    $pdf->Cell(40, 10, "Sold", 1, 0);
    $pdf->Cell(40, 10, "Price", 1, 1);
    $pdf->Text(10, 48, "Categories and sold perfumes");

    foreach ($rows as $row4) {
        $pdf->Cell(40, 10, $row4['family'], 1, 0);
        $pdf->Cell(40, 10, $row4['sold'], 1, 0);
        $pdf->Cell(40, 10, $row4['price'], 1, 1);
    }
    $pdf->Ln(20);

    $result3 = $productModel->getStocks();
    while ($row3 = $result3->fetch(PDO::FETCH_ASSOC)) {
        extract($row3);
        $post_item3 = array(
            'brand' => $brand,
            'perfume_name' => $perfume_name,
            'stock' => $stock
        );
        $rows3[] = $post_item3;
    }
    $pdf->Cell(60, 10, "Brand", 1, 0);
    $pdf->Cell(60, 10, "Perfume Name", 1, 0);
    $pdf->Cell(60, 10, "Stock", 1, 1);
    $pdf->Text(10, 118, "Perfume stocks");

    foreach ($rows3 as $row5) {
        $pdf->Cell(60, 10, $row5['brand'], 1, 0);
        $pdf->Cell(60, 10, $row5['perfume_name'], 1, 0);
        $pdf->Cell(60, 10, $row5['stock'], 1, 1);
    }
    $pdf->Output();
}



