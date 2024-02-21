# goCosmicAI_PHP-task

This project implements a user registration system using PHP and MySQL to store user information and Mailgun for sending confirmation emails. It includes a simple registration page that collects user details such as name, phone number, and email address. Upon successful registration, a confirmation email is sent to the provided email address using the Mailgun API. The project also includes logic to handle situations where the number of registrations exceeds a certain threshold within a particular hour, ensuring compliance with Mailgun's email sending limitations.

## Features

1. **Registration Page**
   - Provides a user-friendly interface to collect user information.
   - Validates user input for required fields and proper formats.

2. **Database Integration**
   - Utilizes MySQL database to store user registration information securely.

3. **Email Notification with Mailgun**
   - Sends a confirmation email to the user's provided email address upon successful registration using the Mailgun API.
   - Uses Mailgun's email delivery service to ensure reliable email delivery.

4. **Handling High Volume Registration**
   - Monitors the number of registrations within each hour.
   - Implements logic to queue emails and send them gradually if the number of registrations exceeds a predefined threshold within a specific hour.

## Technologies Used

- HTML
- CSS
- PHP
- MySQL
- Mailgun API

## Implementation Details

### 1. Registration Page
- **HTML Form**: Utilizes HTML to create the registration form.
- **CSS Styling**: Enhances the visual appearance and layout of the registration page.

### 2. Database Integration
- **MySQL Database**: Stores user registration information securely.
- **PHP Database Connection**: Establishes a connection to the MySQL database to insert user data.

### 3. Email Notification with Mailgun
- **Mailgun API Integration**: Utilizes Mailgun's API to send confirmation emails to users.
- **Secure API Key Handling**: Ensures secure handling of Mailgun API key.

### 4. Handling High Volume Registration
- **Monitoring Registrations**: Tracks the number of registrations within each hour.
- **Logic Implementation**: Implements logic to queue emails and send them gradually if the number of registrations exceeds a predefined threshold within a specific hour.
- **Error Handling**: Provides appropriate feedback to users if email sending fails due to high volume registration.

## Usage

1. **Clone Repository**: Clone this repository to your local machine.
2. **Configure PHP Environment**: Ensure PHP, MySQL, and Mailgun API are properly configured on your system.
3. **Database Setup**: Create a MySQL database and import the provided schema (`database.sql`) to set up the required tables.
4. **Update Configuration**: Update the database connection details and Mailgun API credentials in the configuration file (`config.php`).
5. **Start Local Server**: Run `php -S localhost:8000` to start a local development server.
6. **Access Registration Page**: Open a web browser and navigate to `http://localhost:8000/registration.php`.
7. **Fill Registration Form**: Provide necessary information in the registration form.
8. **Submit Form**: Click the submit button to register.
9. **Check Email**: Check your email inbox for the confirmation email.

## Note

- This project serves as a demonstration and may require further enhancements for production use.
- Ensure your PHP environment, MySQL database, and Mailgun API are properly configured.
- Additional security measures, such as input validation and protection against SQL injection attacks, should be implemented for production-ready applications.

Feel free to contribute to the project by suggesting improvements or implementing additional features! Your contributions are highly appreciated.