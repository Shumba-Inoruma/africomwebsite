<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use App\Models\Radcheck;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public $ipAddress = "41.221.158.246";
    public $username = "munyaradzi";
    
    public function download(){
        $file_path = public_path('activities.jpeg');
        return response()->download( $file_path);
    }
    public function sitedeveloper(){
        return redirect("https://mrchiroveonline.web.app");
    }
    public function fetchLogss() {
        // Example path to log file
        $logFilePath = "/var/log/freeradius/radacct/41.221.158.246/detail-" . date('Ymd');
    
        // Read the log file contents
        $logEntries = file_get_contents($logFilePath);
    
        // Explode log entries by double line breaks to separate records
        $records = explode("\n\n", $logEntries);
    
        // Initialize an array to store parsed log entries
        $logs = [];
    
        // Initialize index
        $index = 1;
    
        // Iterate through each record
        foreach ($records as $record) {
            // Split the record into lines
            $lines = explode("\n", $record);
    
            // Initialize parsed entry
            $parsedEntry = [
                'Index' => $index++,
            ];
    
            // Iterate through each line of the record
            foreach ($lines as $line) {
                // Explode line by key-value pair
                $pair = explode(' = ', $line, 2);
    
                // Check if the line can be split into key-value pair
                if (count($pair) === 2) {
                    // Trim key and value
                    $key = trim($pair[0]);
                    $value = trim($pair[1]);
    
                    // Add key-value pair to parsed entry
                    $parsedEntry[$key] = $value;
                }
            }
    
            // Append the parsed entry to the logs array
            $logs[] = $parsedEntry;
        }
    
        // Encode the logs array to JSON format
        return json_encode(['logs' => $logs]);
    }

  
    public function fetchLogs($ipAddress, $username) {
        // Example path to log file
        $logFilePath = "/var/log/freeradius/radacct/$ipAddress/detail-" . date('Ymd');
   
        // Check if file exists
        if (!file_exists($logFilePath)) {
            return json_encode(['error' => 'Log file not found']);
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

    public function addRadCheck(Request $request)
    {
        // Retrieve data from the request
        $username = $request->input('username');
        $attribute = $request->input('attribute');
        $op = $request->input('op');
        $value = $request->input('value');

        // Validate inputs if needed
        $existingUser = Radcheck::where('username', $username)->first();
        if ($existingUser) {
            return response()->json(['error' => 'Username already taken'], 400);
        }

        // Create a new Radcheck instance and save to the database
        $radcheck = new Radcheck();
        $radcheck->username = $username;
        $radcheck->attribute = 'Cleartext-Password ';
        $radcheck->op = ':=';
        $radcheck->value = $value;
        $radcheck->save();

        // Return success response
        return response()->json(['message' => 'Radcheck added successfully'], 201);
    }

    public function index()
    {
        $radchecks = Radcheck::all();
        return response()->json($radchecks);
    }


    public function show($username)
    {
        $radcheck = Radcheck::where('username', $username)->first();
        
        if($radcheck) {
            return response()->json($radcheck);
        } else {
            return response()->json(null, 404);
        }
    }
    public function update(Request $request, $username)
{
    /**
     * Validate the incoming request
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    $request->validate([
        'attribute' => 'required',
        'op' => 'required',
        'value' => 'required',
    ]);

    /**
     * Retrieve the Radcheck instance associated with the given username
     * 
     * @param  string  $username
     * @return \Illuminate\Database\Eloquent\Model|Radcheck
     */
    $radcheck = Radcheck::where('username', $username)->first();

    if ($radcheck) {
        /**
         * Update the existing Radcheck instance
         */
        $radcheck->username = $request->input('username');;
        $radcheck->attribute = 'Cleartext-Password';
        $radcheck->op = ':=';
        $radcheck->value = $request->input('value'); // assuming 'value' is the key in the request
        $radcheck->save();
        return response()->json($radcheck, 200);
    } else {
        /**
         * Return a JSON response indicating that the Radcheck was not found
         * 
         * @return \Illuminate\Http\JsonResponse
         */
        return response()->json(['message' => 'Radcheck not found']);
    }
}
   

    public function destroy($username)
    {

        $radcheck = Radcheck::where('username', $username)->first();
        if ($radcheck){
            $radcheck = Radcheck::where('username', $username)->firstOrFail();
            $radcheck->delete();
            return response()->json($radcheck, 200);
        }  
        else{
            return response()->json(['message' => 'Radcheck not found']);
        }
    }



    }

   
    
