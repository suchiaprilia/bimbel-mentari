import json
import re

log_path = r'C:\Users\USER\.gemini\antigravity\brain\250cc547-4dc9-4234-aca2-fe271aaaf989\.system_generated\logs\overview.txt'

with open(log_path, 'r', encoding='utf-8') as f:
    log_content = f.read()

# We need to find view_file tool calls and their corresponding TOOL_RESPONSE
# Using regex to find the blocks
matches = re.findall(r'{"step_index":\d+,"source":"MODEL".*?"tool_calls":\[(.*?)\].*?{"step_index":\d+,"source":"SYSTEM_EXPLICIT","type":"TOOL_RESPONSE".*?"content":"(.*?)"}', log_content, re.DOTALL)

for call_json, response_str in matches:
    if '"name":"view_file"' in call_json:
        try:
            # call_json might be multiple tool calls
            calls = json.loads('[' + call_json + ']')
            for call in calls:
                if call['name'] == 'view_file':
                    path = call['args'].get('AbsolutePath', '')
                    if 'siswa_user' in path:
                        print(f"Found view for {path}")
                        # response_str is JSON encoded string, need to unescape
                        # actually it's just the content of the "content" field in JSON
                        try:
                            # It's a string literal in JSON
                            output = json.loads('"' + response_str + '"')
                            # The output has line numbers added by view_file
                            # Format: <line_number>: <original_line>
                            lines = output.split('\n')
                            original_content = []
                            for line in lines:
                                if re.match(r'^\d+: ', line):
                                    original_content.append(line.split(': ', 1)[1])
                            
                            if original_content:
                                # Save it
                                filename = path.replace('"', '').replace('\\\\', '\\').split('\\')[-1]
                                with open(f'restored_{filename}', 'w', encoding='utf-8') as out:
                                    out.write('\n'.join(original_content))
                                print(f"Restored {filename}")
                        except Exception as e:
                            print(f"Error parsing response: {e}")
        except Exception as e:
            pass

print("Done")
