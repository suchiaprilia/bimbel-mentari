<?php
$logFile = 'C:\\Users\\USER\\.gemini\\antigravity\\brain\\250cc547-4dc9-4234-aca2-fe271aaaf989\\.system_generated\\logs\\overview.txt';
$log = file_get_contents($logFile);

// Look for view_file responses
$pattern = '/\{"name":"view_file","args":\{"AbsolutePath":"([^"]+)".*?"output":"([^"]+)"/s';
if (preg_match_all('/\{"step_index":\d+,"source":"MODEL","type":"PLANNER_RESPONSE".*?"tool_calls":\[(.*?)\]\}\n\{"step_index":\d+,"source":"SYSTEM_EXPLICIT","type":"TOOL_RESPONSE".*?"content":"(.*?)"\}/s', $log, $matches)) {
    foreach ($matches[1] as $index => $toolCall) {
        $response = $matches[2][$index];
        if (strpos($toolCall, '"name":"view_file"') !== false) {
            $data = json_decode('[' . $toolCall . ']', true);
            foreach ($data as $call) {
                if ($call['name'] === 'view_file') {
                    $path = $call['args']['AbsolutePath'];
                    if (strpos($path, 'siswa_user') !== false) {
                        echo "Found view for: $path\n";
                        // The content is in the response, we need to unescape and clean it up
                        // Actually, the response is JSON encoded in the overview.txt
                    }
                }
            }
        }
    }
}
echo "Done\n";
