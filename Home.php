<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NavJeevan</title>
 <link rel="icon" type="image/png" href="logo.png">
<link rel="stylesheet" href="home.css">
 <style>
        /* Basic styling */
     
        body {

            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color:white;
            color: black;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }
        .logo {
            width: 100px; /* Adjust as needed */
            height: auto;
        }
        .login-dropdown {
            position: relative;
        }
        .login-dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            top: 35px;
            right: 0;
        }
        .login-dropdown:hover .login-dropdown-content {
            display: block;
        }
        .login-dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .login-dropdown-content a:hover {
            background-color: #ddd;
        }

          .emergency-button {
            position: absolute;
            top: 68%;
            left: 80%;
            transform: translate(-50%, -50%);
            font-size: 40px;
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            z-index: 1000; /* Ensure the button is above other content */
        }
          #video-overlay {
            display: none;
            position: fixed;
          
            background-color: rgba(0, 0, 0, 0.8); /* Semi-transparent black background */
            z-index: 1000; /* Ensure the overlay is above other content */
        }

     
        .close-button {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #60fb41; /* Green color for the button */
            color: black;
            padding: 10px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
               .container {
            display: flex;
            flex-wrap: wrap;
               gap: 120px;
    padding: 60px;
    margin-left:300px;
        }
        
        .card-container {
            width: calc(33.33% - 20px); /* Adjust card width based on the gap */
        }

       /* Card styling */
.card {
    background-color: #d5f8c8;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px; /* Adjust spacing between cards */
}

.card img {
    width: 220px;
    height: 100px;
    object-fit: cover; /* Ensure the image covers the entire area */
    border-radius: 5px; /* Optional: Add border radius to the image */
    margin-bottom: 10px; /* Adjust spacing between image and text */
}

.card h3 {
    margin-top: 0;
}

.card p {
    margin-bottom: 5px;
}

          .filter-container {
        position: absolute;
        left: 0;
        top: 0;
        width: 20%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
        padding: 20px;
        box-sizing: border-box;
        margin-top: 800px;
    }

    /* Additional styling for the filter options */
    .filter-option {
        margin-bottom: 10px;
    }
    .card .button1,
.card .button2 {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
    </style>
</head>
<body>

<nav class="navbar">
    <!-- Logo at the top left corner -->
    <div>
        <img src="logo.png" alt="Logo" class="logo" style="width: 250px;">
    </div>
    
    <!-- Login button with dropdown at the top right corner -->
    <div class="login-dropdown">
        <button style="margin-right: 150px; font-size: 25px; background: #60fb41; padding: 10px 20px; color: white; text-decoration: none;border:none;">Login</button>
        <div class="login-dropdown-content">
            <a href="dlogin.php">Doctor Login</a>
            <a href="login.php">Patients Login</a>
            <a href="nlogin.php">Nurses Login</a>
        </div>   
    </div>
    <a href="wellness_finder.php" class="h" style="margin-right: 150px; font-size: 25px; background: #60fb41; padding: 10px 20px; color: white; text-decoration: none;">Find Hospitals Near Me</a>

</nav>
<img src="back.jpeg" style="width:1900px;height:500px;">
<button class="emergency-button" onclick="redirectToEmergencyPage()">Emergency</button></img>
<div id="video-overlay">
    <div id="video-container">
        <!-- Embedded video player -->
        <iframe width="1700px" height="1000px" src="v.mp4" frameborder="0" allowfullscreen autoplay muted></iframe>
        <button class="close-button" onclick="closeVideo()">Close</button>
    </div>
</div>
   <div class="container" id="doctor-container">
   
        <?php
        // Database connection details
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "doctors_database";

        // Create database connection
        $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch all doctor details from the database
        $sql = "SELECT * FROM doctors";
        $result = $conn->query($sql);

        // Display doctor details in cards
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <div class="card">
                     <img src="<?php echo $row['file']; ?>" alt="Profile Picture" style="width: 340px; height: 180px;">
                    <h3>Personal Information</h3>
                    <p>Name: <?php echo $row['first_name'] . " " . $row['last_name']; ?></p>
                    <h3>Professional Information</h3>
                    <p>Specialization: <?php echo $row['specialization']; ?></p>
                    <p>Experience: <?php echo $row['experience']; ?></p>
                    <h3>Location</h3>
                    <p>State: <?php echo $row['state']; ?></p>
                    <p>City: <?php echo $row['city']; ?></p>
                     <button id="bookAppointmentButton" class="button1">Book Appointment</button>
                </div>
        <?php
            }
        } else {
            echo "No doctors found!";
        }

        // Close database connection
        $conn->close();
        ?>
    </div>
 <div class="filter-container">
    <h3>Filter by Specialization</h3>
 <select id="specializationFilter" class="filter-option">
           <option value="Allergy & Immunology">Allergy & Immunology</option>
    <option value="Anesthesiology">Anesthesiology</option>
    <option value="Cardiology">Cardiology</option>
    <option value="Dermatology">Dermatology</option>
    <option value="Endocrinology">Endocrinology</option>
    <option value="Family Medicine">Family Medicine</option>
    <option value="Gastroenterology">Gastroenterology</option>
    <option value="Geriatrics">Geriatrics</option>
    <option value="Hematology">Hematology</option>
    <option value="Infectious Disease">Infectious Disease</option>
    <option value="Internal Medicine">Internal Medicine</option>
    <option value="Nephrology">Nephrology</option>
    <option value="Neurology">Neurology</option>
    <option value="Obstetrics & Gynecology">Obstetrics & Gynecology</option>
    <option value="Oncology">Oncology</option>
    <option value="Ophthalmology">Ophthalmology</option>
    <option value="Orthopedics">Orthopedics</option>
    <option value="Otolaryngology (ENT)">Otolaryngology (ENT)</option>
    <option value="Pain Medicine">Pain Medicine</option>
    <option value="Pediatrics">Pediatrics</option>
    <option value="Physical Medicine & Rehabilitation">Physical Medicine & Rehabilitation</option>
    <option value="Plastic Surgery">Plastic Surgery</option>
    <option value="Psychiatry">Psychiatry</option>
    <option value="Pulmonology">Pulmonology</option>
    <option value="Radiology">Radiology</option>
    <option value="Rheumatology">Rheumatology</option>
    <option value="Sleep Medicine">Sleep Medicine</option>
    <option value="Sports Medicine">Sports Medicine</option>
        <!-- Add more options as needed -->
    </select>
</div>
 <div class="container" id="doctor-container">
    <!-- Doctor details will be dynamically added here -->
</div>
   
<script>
  function redirectToEmergencyPage() {
        // Redirect to the emergency page when the button is clicked
        window.location.href = "emergency.php"; // Replace "emergency.php" with the URL of your emergency page
    }


  var bookAppointmentButton = document.getElementById("bookAppointmentButton");

    // Add a click event listener to the button
    bookAppointmentButton.addEventListener("click", function() {
        // Redirect to the next page
        window.location.href = "virtualroom.php"; // Replace "appointment.php" with the URL of your appointment page
    });





document.getElementById("specializationFilter").addEventListener("change", function() {
    var specialization = this.value; // Get the selected specialization
    filterDoctorsBySpecialization(specialization); // Call function to filter doctors
});

function filterDoctorsBySpecialization(specialization) {
    // Send AJAX request to the server to get filtered data
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Update the container with the filtered data
            document.querySelector(".container").innerHTML = this.responseText;
        }
    };
    xhr.open("GET", "filter.php?specialization=" + specialization, true);
    xhr.send();
}


  function updateDoctorCards(doctors) {
    var container = document.getElementById("doctor-container");
    
    // Clear the existing content in the container
    container.innerHTML = '';

    // Loop through the filtered doctor details array
    doctors.forEach(function(doctor) {
        // Create a card element
        var card = document.createElement("div");
        card.classList.add("card");

        // Create an image element for the doctor's profile picture
        var img = document.createElement("img");
        img.src = doctor.file;
        img.alt = "Profile Picture";

        // Create heading elements for personal and professional information
        var personalInfoHeading = document.createElement("h3");
        personalInfoHeading.textContent = "Personal Information";
        var professionalInfoHeading = document.createElement("h3");
        professionalInfoHeading.textContent = "Professional Information";

        // Create paragraph elements for displaying doctor details
        var name = document.createElement("p");
        name.textContent = "Name: " + doctor.first_name + " " + doctor.last_name;
        var specialization = document.createElement("p");
        specialization.textContent = "Specialization: " + doctor.specialization;
        var experience = document.createElement("p");
        experience.textContent = "Experience: " + doctor.experience;
        var locationHeading = document.createElement("h3");
        locationHeading.textContent = "Location";
        var state = document.createElement("p");
        state.textContent = "State: " + doctor.state;
        var city = document.createElement("p");
        city.textContent = "City: " + doctor.city;

        // Append elements to the card
        card.appendChild(img);
        card.appendChild(personalInfoHeading);
        card.appendChild(name);
        card.appendChild(professionalInfoHeading);
        card.appendChild(specialization);
        card.appendChild(experience);
        card.appendChild(locationHeading);
        card.appendChild(state);
        card.appendChild(city);

        // Append the card to the container
        container.appendChild(card);
    });
}

</script>

</script>

</body>
</html>