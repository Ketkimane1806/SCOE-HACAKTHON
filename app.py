from flask import Flask, render_template, request
import pandas as pd

app = Flask(__name__)

# Load dataset
data = pd.read_csv('Home Remedies.csv')

# Function to find matching remedy for given symptom
def find_remedy(symptom):
    matching_row = data[data['Health Issue'].str.contains(symptom, case=False)]
    if not matching_row.empty:
        return matching_row['Home Remedy'].iloc[0]
    else:
        return "No matching remedy found for the given symptom."

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/result', methods=['POST'])
def result():
    if request.method == 'POST':
        symptom = request.form['symptom']
        remedy = find_remedy(symptom)
        return render_template('result.html', symptom=symptom, remedy=remedy)

if __name__ == '__main__':
    app.run(debug=True)
