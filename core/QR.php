<?php

namespace app\core;

use Exception;
use QRcode;

require_once('phpqrcode/qrlib.php');

class QR {

  public static function generateQRFromJSON($json_data, $filename = null, $size = 10, $errorCorrectionLevel = 'L') {

      try {

      $qr_folder = 'qr/';
      if (!file_exists($qr_folder)) {
          mkdir($qr_folder, 0777, true); // Create the qr folder if it doesn't exist
      }
      $file_path = $qr_folder . ($filename ?: uniqid('qr_', true)) . '.png';
      QRcode::png($json_data, $file_path, $errorCorrectionLevel, $size);
      return $file_path;

        } catch (Exception $e) {
          Logger::logError('QR.php', 'generateQRFromJSON', $e->getMessage());
        }
  }

    public function generateQRForPersonal(false|string $json_encode, string $qr_name, int $int, string $string)
    {
        try {

        $qr_folder = 'qr/personal/';
        if (!file_exists($qr_folder)) {
            mkdir($qr_folder, 0777, true); // Create the qr folder if it doesn't exist
        }
        $file_path = $qr_folder . ($qr_name ?: uniqid('qr_', true)) . '.png';
        QRcode::png($json_encode, $file_path, $string, $int);
        Logger::logDebug('QR generated for ' . $qr_name);
        return $file_path;

        } catch (Exception $e) {
          Logger::logError('QR.php', 'generateQRForPersonal', $e->getMessage());
        }
    }

}

?>
