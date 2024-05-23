<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use App\Models\Radcheck;
use App\Models\UserInfo;
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
        $whatsapp = $request->input('whatsapp');

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
        try {
            // Create a new user info record
            $userInfo = new UserInfo();
            $userInfo->username = $username;
            $userInfo->whatsapp = $whatsapp;
            $userInfo->save();
    
            // Return success response
            return response()->json(['message' => 'Radcheck added successfully'], 201);
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return response()->json(['error' => 'An error occurred while saving user info: ' . $e->getMessage()], 500);
        }
        // Return success response
        return response()->json(['message' => 'Radcheck added successfully'], 201);
    }

    public function index()
    {
        // Fetch all Radcheck records
        $radchecks = Radcheck::all();

        // Fetch all UserInfo records
        $userInfos = UserInfo::all();

        // Create a map of userInfos with username as key for quick lookup
        $userInfoMap = $userInfos->keyBy('username');

        // Combine data from both tables
        $combinedData = $radchecks->map(function ($radcheck) use ($userInfoMap) {
            if (isset($userInfoMap[$radcheck->username])) {
                return [
                    'id' => $radcheck->id,
                    'username' => $radcheck->username,
                    'attribute' => $radcheck->attribute,
                    'op' => $radcheck->op,
                    'value' => $radcheck->value,
                    'whatsapp' => $userInfoMap[$radcheck->username]->whatsapp,
                ];
            }
            return null;
        })->filter(); // Remove null values

        return response()->json($combinedData);
    }

    public function show($username)
    {
        // Find the Radcheck record by username
        $radcheck = Radcheck::where('username', $username)->first();
        
        if ($radcheck) {
            // Find the Userinfo record by username
            $userinfo = Userinfo::where('username', $username)->first();
            
            // Create the response object
            $response = [
                'radcheck' => $radcheck,
                'whatsapp' => $userinfo ? $userinfo->whatsapp : null
            ];
            
            return response()->json($response);
        } else {
            return response()->json(null, 404);
        }
    }
    
    public function update(Request $request, $username)
{
    
    $radcheck = Radcheck::where('username', $username)->first();

    if ($radcheck) {
        /**
         * Update the existing Radcheck instance
         */
        $radcheck->username = $username;
        $radcheck->attribute = 'Cleartext-Password';
        $radcheck->op = ':=';
        $radcheck->value = $request->input('value'); // assuming 'value' is the key in the request
        $radcheck->save();

        try {
            // Find the UserInfo object by username
            $userInfo = UserInfo::where('username', $username)->first();

            if (!$userInfo) {
                return response()->json(['error' => 'UserInfo not found'], 404);
            }

            // Update the UserInfo fields with the new data from the request
            $userInfo->whatsapp = $request->input('whatsapp', $userInfo->whatsapp);
            // Add other fields here as needed
            // $userInfo->another_field = $request->input('another_field', $userInfo->another_field);

            // Save the updated UserInfo object
            $userInfo->save();

            return response()->json(['message' => 'UserInfo updated successfully'], 200);
        } catch (\Exception $e) {
            // Return an error response if an exception occurs
            return response()->json(['error' => 'An error occurred while updating UserInfo: ' . $e->getMessage()], 500);
        }
        
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
            try {
                // Retrieve the UserInfo object(s) with the given username
                $userinfos = UserInfo::where('username', $username)->get();
                // Delete the UserInfo object(s)
                $userinfos->each->delete();
                return response()->json(['message' => "Userinfo(s) with username '$username' deleted successfully."]);
            } catch (\Exception $e) {
                // Return an error response if an exception occurs
                return response()->json(['error' => 'An error occurred while deleting userinfo(s).'], 500);
            }

            return response()->json($radcheck, 200);
        }  
        else{
            return response()->json(['message' => 'Radcheck not found']);
        }
    }



    }

   
    
