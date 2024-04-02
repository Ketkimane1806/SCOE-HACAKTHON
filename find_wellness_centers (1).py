import time
import pandas as pd

# Function to simulate training process
def simulate_training():
    print("Training the dataset...")
    time.sleep(2)
    print("Dataset training completed!\n")

# Load the dataset (simulated)
def load_dataset():
    print("Loading dataset...")
    time.sleep(1)
    hospital_df = pd.read_csv("Hospitals.csv")
    print("Dataset loaded successfully!\n")
    return hospital_df

# Function to find wellness centers in a city
def find_wellness_centers_in_city(city_name):
    print(f"Searching for wellness centers in {city_name}...")
    time.sleep(1)
    hospital_df = load_dataset()
    
    city_hospitals = hospital_df[hospital_df["cityName"] == city_name]
    
    if not city_hospitals.empty:
        response = f"Wellness centers in {city_name}:\n"
        for index, row in city_hospitals.iterrows():
            response += f"Name: {row['wellnessCentreName']}\n"
            response += f"Contact: {row['wellnessCentreContactNo']}\n"
            response += f"Latitude: {row['latitude']}\n"
            response += f"Longitude: {row['longitude']}\n\n"
    else:
        response = f"No wellness centers found in {city_name}."
    
    return response

# Function to interact with the user
def main():
    print("Welcome! This program helps you find wellness centers in a specific city.")
    print("Type 'quit' to exit.\n")
    simulate_training()  # Simulate training process
    while True:
        city_name = input("Please enter a city name to find wellness centers: ")
        if city_name.lower() == "quit":
            print("\nGoodbye!")
            break
        else:
            response = find_wellness_centers_in_city(city_name)
            print(response)

# Call the main function to start interaction
if __name__ == "__main__":
    main()
