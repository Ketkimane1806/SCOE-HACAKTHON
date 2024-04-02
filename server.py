import http.server
import socketserver
import urllib.parse
import json
import pandas as pd

# Load the dataset
df = pd.read_csv("HospitalsInIndia.csv")

def search_hospital(city_or_state):
    # Check if the input is a city name or state name
    if city_or_state in df['City'].unique():
        result = df[df['City'] == city_or_state]
    elif city_or_state in df['State'].unique():
        result = df[df['State'] == city_or_state]
    else:
        return []

    # Format the results
    hospitals = []
    for index, row in result.iterrows():
        hospitals.append({
            'Hospital': row['Hospital'],
            'LocalAddress': row['LocalAddress'],
            'Pincode': row['Pincode']
        })
    return hospitals

class MyRequestHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        parsed_url = urllib.parse.urlparse(self.path)
        query_params = urllib.parse.parse_qs(parsed_url.query)
        if parsed_url.path == '/search':
            city_or_state = query_params.get('query', [''])[0]
            hospitals = search_hospital(city_or_state)
            self.send_response(200)
            self.send_header('Content-type', 'application/json')
            self.end_headers()
            self.wfile.write(json.dumps(hospitals).encode())
        else:
            # Serve the HTML file for any other path
            html_file_path = parsed_url.path.strip("/") or "index.html"
            try:
                with open(html_file_path, 'rb') as file:
                    self.send_response(200)
                    self.send_header('Content-type', 'text/html')
                    self.end_headers()
                    self.wfile.write(file.read())
            except FileNotFoundError:
                self.send_error(404, "File not found")

def run_server():
    PORT = 8000
    with socketserver.TCPServer(("", PORT), MyRequestHandler) as httpd:
        print("Server started on port", PORT)
        httpd.serve_forever()

if __name__ == "__main__":
    run_server()
