<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    public function download(){
        $file_path = public_path('activities.jpeg');
        return response()->download( $file_path);
    }
    public function sitedeveloper(){
        return redirect("https://mrchiroveonline.web.app");
    }
	
   public function catchappp(){
        return redirect()->away("https://catchapp.ai.co.zw");
    }

    public function fetchLogs($ipAddress, $username, $macAddress) {
        // Validate MAC address against allowed MAC addresses
        $allowedMacs = ['4113a60a412dd2605a9e23637ca3a4b7']; // Example list of allowed MAC addresses
        if (!$this->isMacAllowed($macAddress, $allowedMacs)) {
            return json_encode(['error' => 'MAC address not allowed']);
        }

        // Example path to log file
        $logFilePath = "/var/log/freeradius/radacct/$ipAddress/detail-" . date('Ymd');
        // Check if file exists
        if (!file_exists($logFilePath)) {
           // return json_encode(['error' => 'Log file not found']);

           return "The file does not exist";
        }

        // Read the log file contents
        $logEntries = file_get_contents($logFilePath);

        // Explode log entries by double line breaks to separate records
        $records = explode("\n\n", $logEntries);

        // Initialize a variable to store the last log entry for the user
        $lastLog = null;

        // Iterate through each record
        foreach ($records as $record) {
            // Split the record into lines
            $lines = explode("\n", $record);

            // Initialize parsed entry
            $parsedEntry = [];

            // Iterate through each line of the record
            foreach ($lines as $line) {
                // Explode line by key-value pair
                $pair = explode(' = ', $line, 2);

                // Check if the line can be split into key-value pair
                if (count($pair) === 2) {
                    // Trim key and value
                    $key = trim($pair[0]);
                    $value = trim($pair[1]);

                    // Remove surrounding quotes from the value if present
                    $value = trim($value, '"');

                    // Add key-value pair to parsed entry
                    $parsedEntry[$key] = $value;
                }
            }

            // Check if the parsed entry matches the specified username
            if (isset($parsedEntry['User-Name']) && $parsedEntry['User-Name'] === $username) {
                // Update the last log entry for the user
                $lastLog = $parsedEntry;
            }
        }

        // Encode the last log entry to JSON format
        return json_encode(['lastLog' => $lastLog]);
    }

    // Function to check if MAC address is allowed
    private function isMacAllowed($macAddress, $allowedMacs) {
        return in_array($macAddress, $allowedMacs);
    }
	


  


}
