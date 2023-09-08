# PHP Login Page with SQL Database Support

This is a simple PHP login page with SQL database support that allows users to sign in, sign up, access a dashboard, and upload images. Each user has their own session to maintain security and privacy.

## Features

1. **User Registration:** Users can sign up for an account by providing their username, email, and password. Form validation is implemented to ensure data accuracy.

2. **User Authentication:** Registered users can securely log in using their username and password. Form validation is also applied to the login form.

3. **Session Management:** User sessions are used to maintain login status and provide a personalized experience for each user.

4. **Dashboard:** Authenticated users can access a dashboard where they can view and manage their account information.

5. **Image Upload:** Users can upload images to their account. These images will be associated with their account and stored securely in the database.

## Requirements

- PHP (7.0 or higher)
- MySQL database
- Web server (e.g., Apache, Nginx)

## Installation

1. Clone this repository to your web server directory:

   ```bash
   git clone https://github.com/for-trancer/NOX.git
   ```

2. Create a MySQL database and import the provided SQL schema (`database.sql`) to create the necessary tables.

3. Update the database configuration in `config.php` with your database credentials:

   ```php
   define('DB_HOST', 'your_db_host');
   define('DB_USER', 'your_db_user');
   define('DB_PASSWORD', 'your_db_password');
   define('DB_NAME', 'your_db_name');
   ```

4. Ensure that your web server has read and write permissions to the image upload directory:

   ```bash
   chmod -R 755 uploads/
   ```

5. Configure your web server to serve the PHP files in the project directory.

## Usage

1. Access the login page in your web browser:

   ```
   http://localhost
   ```

2. New users can sign up for an account, while existing users can log in.

3. After logging in, users will be redirected to their dashboard where they can manage their account and upload images.

## Features

- Sanitize and validate user inputs to prevent SQL injection and other security vulnerabilities.
- Use password hashing and salting for secure password storage.

## License

This project is open-source and available under the [MIT License](LICENSE).

## Credits

This project was created by Arjun Ashok 

Please feel free to contribute to the project or report any issues you encounter.

Happy coding!
