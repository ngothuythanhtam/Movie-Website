# Movie Website

The Movie Website was built by Ngo Thuy Thanh Tam and Nguyen Thuy Hoai Thuong. 
 + Ngo Thuy Thanh Tam is in charge of code and user interface design.
 + Nguyen Thuy Hoai Thuong is in charge of the admin side.

This is a basic movie website developed using HTML, CSS, PHP, JavaScript, and MySQL for database management. The project demonstrates how to create a dynamic and interactive movie web application.

## Features
- Display a list of movies with details such as title, description, and genre.
- Login functionality.
- Search functionality to find movies by name.
- Filter movies by genre.
- Integration with MySQL to store and manage movie and user data.

## Prerequisites
- **Web Server**: Apache, Nginx, or any web server that supports PHP.
- **Database**: MySQL installed and configured.
- **Browser**: Modern browser to view the website.
- **PHP**: Version 7.4 or later.

## Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-repository/movie-website.git
   cd movie-website
   ```

2. **Set Up the MySQL Database**
   - Import the `movie_website.sql` file located in the `sql/` directory into your MySQL database.

3. **Update Database Configuration**
   - Open the `admin_page/assets/php/connect.php` and `user_page/connect.php` file and update the database credentials:
     ```bash
     $host = "localhost";
     $username = "your_username";
     $password = "your_password";
     $database = "your_database";
     ```

4. **Set Up the Web Server**
   - Place the project files in your web server's root directory (e.g., `htdocs/` for XAMPP).

5. **Run the Website**
   - Open your browser and navigate to:
     ```
     http://localhost/movie-website/<user_page/admin_page>/<filename.php>
     ```

## Troubleshooting

- **Error: `$ is not defined`**  
  This error occurs if jQuery is not properly loaded. Ensure that the `vendor/jquery/jquery.min.js` file is available and included in your HTML file.

- **Error: "Cannot read properties of undefined (reading 'fn')"**  
  This error is related to Owl Carousel. Ensure that both `owl.carousel.min.js` and its CSS files are properly included.

- **404 Errors for Assets**
  Check that all paths to CSS, JS, and image files are correct and that the files exist in the specified directories.

## Future Enhancements
- Add user roles (e.g., admin, viewer) to manage content more effectively.
- Enable movie ratings and reviews.
- Implement API integration for fetching real-time movie data.

## Video Demo  
Watch the demo of the Movie Website here:  
[Movie Website Demo](https://www.youtube.com/watch?v=aYgYm7l4hq8)  

---
Happy Coding!
