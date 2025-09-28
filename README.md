# 🏥 Hospitals in Gaza – Database Project

This is a database management project built with **PHP, MySQL, and HTML/CSS** to store, manage, and search hospitals and primary healthcare centers (PHCs) in Gaza.  
It was developed as part of a university project to practice **database design, SQL queries, web development, and GIS-based route optimization**.

---

## 📌 Features
- **User Location Tracking**  
  The system determines the user's location either through manual input (latitude/longitude) or GPS tracking.

- **Healthcare Facility Identification**  
  Based on the user’s location, the system identifies the **nearest hospital** or **Primary Health Care (PHC) center** from the database.

- **Route Optimization**  
  The system provides the **shortest route** to the selected healthcare facility, integrating with mapping services (Leaflet / Google Maps API).

- **Database-Driven Search**  
  Hospital information (name, address, services, capacity, coordinates) is stored in a MySQL database and can be queried efficiently.

- **Interactive Map Visualization**  
  Hospitals are displayed on an interactive map for better visualization.

- **User-Friendly Interface**  
  Simple, responsive, and easy-to-use interface built with **HTML, CSS, and JavaScript**.

---

## 🗂️ Project Structure

my_php_project/
│── index.php
│── find_hospitals.php
│── style.css
│── config.php
│── database/
│    └── hospitals.sql
│── screenshots/
│    ├── homepage.png
│    ├── search.png
│    ├── map.png
│    └── data.png
│── README.md


---

## ⚙️ Installation & Setup

1. **Clone this repository**  
   ```bash
   git clone https://github.com/YourUsername/hospitals-in-gaza-db.git
2.Import the database

  Open phpMyAdmin.

  Create a new database (e.g., hospitals_gaza).

  Import the file: database/hospitals.sql.

3.Configure connection

  Open config.php (or similar).

  Update with your database credentials:

  $host = "localhost";
  $user = "root";
  $pass = "";
  $dbname = "hospitals_gaza";


4.Run the project

Place the project folder in htdocs/ (if using XAMPP/WAMP).

Start Apache and MySQL in XAMPP/WAMP.

Open in browser:

http://localhost/hospitals-in-gaza-db/

📸 Screenshots

## 📸 Screenshots

| Homepage | Search Results | Data | Map |
|----------|----------------|------|-----|
| ![Homepage](screenshots/homepage.png) | ![Search Results](screenshots/search.png) | ![Data](screenshots/data.png) | ![Map](screenshots/map.png) |


	
🛠️ Technologies Used

PHP – backend scripting

MySQL – relational database

HTML, CSS, JS – frontend

Leaflet / Google Maps API – interactive map and routing

📌 Author

👩‍💻 Developed by yessmine Chaabouni
📧 Contact: chaabouniyessmine3@gmail.com

📜 License

This project is open-source under the MIT License.
Feel free to use, modify, and share with attribution.
