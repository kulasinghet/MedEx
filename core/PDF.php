<?php

namespace app\core;
require_once '../vendor/autoload.php';

use Dompdf\Dompdf;

class PDF
{
    public static function generatePDF($html, $filename, $paper = 'A4', $orientation = 'portrait')
    {

        try {
         if (!file_exists('pdf')) {
            mkdir('pdf', 0777, true); // Create the pdf folder if it doesn't exist
         }
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);

        // save pdf file
        $dompdf->render();

        $output = $dompdf->output();
        $filepath = 'pdf/' . $filename . '.pdf';
        file_put_contents($filepath, $output);

        return $filepath;

        } catch (\Exception $e) {
            Logger::logError('PDF', $e->getMessage());
        }

    }

    public function formBodyToHTML($orderid, $order_date, $total_price, $medicineIds, $pharmacyName)
    {
        $image_path = 'qr/' . $orderid . '.png';
        $image_data = file_get_contents($image_path); // Read the image file contents
        $image_base64 = base64_encode($image_data); // Convert the image data to base64

// Use the $image_base64 string in your HTML or PDF generation code


        $html = '<style>
            body { font-family: "DejaVu Sans", sans-serif; }
            h1 { font-size: 24px; font-weight: bold; margin-bottom: 20px; }
            h3 { font-size: 18px; font-weight: bold; margin-top: 20px; margin-bottom: 10px; }
            table { border-collapse: collapse; margin-bottom: 20px; }
            th, td { border: 1px solid black; padding: 5px; }
            hr { border: 1px solid black; margin-bottom: 20px; margin-top: 20px; }
        </style>';
        $html .= '<h1>Order Details</h1>';
        $html .= '<hr>';
        $html .= '<h3>Pharmacy Name: ' . $pharmacyName . '</h3>';
        $html .= '<h3>Order ID: ' . $orderid . '</h3>';
        $html .= '<h3>Order Date: ' . $order_date . '</h3>';
        $html .= '<h3>Total Price: ' . $total_price . '</h3>';
        $html .= '<h3>Medicine Details</h3>';
        $html .= '<table style="width:100%">
            <tr>
                <th>Medicine ID</th>
                <th>Medicine Name</th>
                <th>Scientific Name</th>
                <th>Weight</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>';
        foreach ($medicineIds as $medicineId) {
            $html .= '<tr>
                <td>' . $medicineId['medId'] . '</td>
                <td>' . $medicineId['medName'] . '</td>
                <td>' . $medicineId['sciName'] . '</td>
                <td>' . $medicineId['weight'] . '</td>
                <td>' . $medicineId['quantity'] . '</td>
                <td>' . $medicineId['unitPrice'] . '</td>
            </tr>';
        }
        $html .= '</table>';
        $html .= '<h3>Scan the QR code to update the order status</h3>';
        $html .= '<h5>This QR code will be used by the delivery service to update the order status</h5>';
        $html .= '<img src="data:image/png;base64,' . $image_base64 . '" alt="QR Code" width="200" height="200">';
        $html .= '<br>';
        $html .= '<hr>';
        $html .= '<p>This is an automatically generated document. No signature is required.</p>';
        $html .= '<p>Thank you for using our service.</p>';
        $html .= '<p>MedEx Team</p>';

        return $html;
    }

    public function invoiceToHTML($orderid, $order_date, $total_price, $medicineIds, $pharmacyName)
    {
        $image_path = 'qr/' . $orderid . '.png';
        $image_data = file_get_contents($image_path); // Read the image file contents
        $image_base64 = base64_encode($image_data); // Convert the image data to base64

        Logger::logDebug('medicines: ' . $medicineIds);

        $html = '<style>
            body { font-family: "DejaVu Sans", sans-serif; }
            h1 { font-size: 24px; font-weight: bold; margin-bottom: 20px; }
            h3 { font-size: 18px; font-weight: bold; margin-top: 20px; margin-bottom: 10px; }
            table { border-collapse: collapse; margin-bottom: 20px; }
            th, td { border: 1px solid black; padding: 5px; }
            hr { border: 1px solid black; margin-bottom: 20px; margin-top: 20px; }
        </style>';
        $html .= '<h1>Bill Details</h1>';
        $html .= '<hr>';
        $html .= '<h3>Pharmacy Name: ' . $pharmacyName . '</h3>';
        $html .= '<h3>Invoice ID: ' . $orderid . '</h3>';
        $html .= '<h3>Bill Date: ' . $order_date . '</h3>';
        $html .= '<h3>Total Price: ' . $total_price . '</h3>';
        $html .= '<h3>Medicine Details</h3>';
        $html .= '<table style="width:100%">
            <tr>
                <th>Medicine ID</th>
                <th>Medicine Name</th>
                <th>Scientific Name</th>
                <th>Weight</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>';
        foreach ($medicineIds as $medicineId) {

            Logger::logDebug('medicines: ' . $medicineId['medId'] . ' ' . $medicineId['medName'] . ' ' . $medicineId['sciName'] . ' ' . $medicineId['weight'] . ' ' . $medicineId['quantity'] . ' ' . $medicineId['unitPrice']);

            $html .= '<tr>
                <td>' . $medicineId['medId'] . '</td>
                <td>' . $medicineId['medName'] . '</td>
                <td>' . $medicineId['sciName'] . '</td>
                <td>' . $medicineId['weight'] . '</td>
                <td>' . $medicineId['quantity'] . '</td>
                <td>' . $medicineId['unitPrice'] . '</td>
            </tr>';
        }
        $html .= '</table>';
        $html .= '<h3>Scan the QR code to get an E-Bill</h3>';
        $html .= '<h5>This QR code will be used by the customer to get an E-Bill</h5>';
        $html .= '<img src="data:image/png;base64,' . $image_base64 . '" alt="QR Code" width="200" height="200">';
        $html .= '<br>';
        $html .= '<hr>';
        $html .= '<p>This is an automatically generated document. No signature is required.</p>';
        $html .= '<p>Thank you for using our service.</p>';
        $html .= '<p>MedEx Team</p>';

        return $html;
    }


}
