# Product Management Website

A full-stack product management website built with PHP, MySQL, HTML, CSS, and JavaScript.

## Features

### Authentication System
- User registration and login
- Password hashing with `password_hash()`
- PHP sessions for authentication
- Client-side and server-side form validation
- Role-based redirection after login

### User Roles
- **Admin**: Full access to product management
- **Normal User**: View-only access to products

### Admin Features
- Add new products with image upload
- Edit existing products
- Delete products
- View product dashboard with statistics
- Protected admin routes

### User Features
- Browse all products
- View detailed product information
- Search products by name or description
- Filter products by category
- View product images, prices, and descriptions

## Project Structure

```
/project
├── /admin
│   ├── dashboard.php      # Admin dashboard
│   ├── add_product.php    # Add new products
│   └── edit_product.php   # Edit existing products
├── /auth
│   ├── login.php          # User login
│   ├── register.php       # User registration
│   └── logout.php         # User logout
├── /config
│   └── db.php             # Database configuration
├── /assets
│   ├── /css
│   │   └── style.css      # Main stylesheet
│   ├── /js
│   │   └── validation.js  # Client-side validation
│   └── /images            # Uploaded product images
├── index.php              # Main product listing page
├── product.php            # Individual product details
├── database.sql           # Database schema
└── README.md              # This file
```

## Installation and Setup

### Prerequisites
- XAMPP or WAMP server
- PHP 7.4 or higher
- MySQL 5.7 or higher

### Steps

1. **Clone or Download the Project**
   - Place the `product_management` folder in your XAMPP `htdocs` directory (e.g., `C:\xampp\htdocs\`)

2. **Start XAMPP**
   - Start Apache and MySQL services

3. **Create Database**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `product_management`
   - Import the `database.sql` file from the project root

4. **Configure Database Connection**
   - The database configuration is already set up in `config/db.php`
   - Default settings:
     - Host: localhost
     - Database: product_management
     - Username: root
     - Password: (empty)

5. **Create Images Directory**
   - Create the `assets/images` directory if it doesn't exist
   - Make sure it's writable by the web server

6. **Access the Website**
   - Open your browser and go to: http://localhost/product_management/

## Admin Account

**Create one and change the role from mySQL**

## Security Features

- PDO prepared statements to prevent SQL injection
- Password hashing with `password_hash()`
- Session-based authentication
- Role-based access control
- Input sanitization and validation
- Protected admin routes

## Technologies Used

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, JavaScript
- **Styling**: Custom CSS with Flexbox/Grid
- **Database Access**: PDO (PHP Data Objects)

## Browser Support

- Chrome (recommended)
- Firefox
- Safari
- Edge

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check if MySQL service is running
   - Verify database credentials in `config/db.php`
   - Ensure database `product_management` exists

2. **Image Upload Issues**
   - Check if `assets/images` directory exists and is writable
   - Verify file permissions (755 recommended)
   - Check PHP upload limits in `php.ini`

3. **Session Issues**
   - Ensure cookies are enabled in browser
   - Check if `session.save_path` is writable

4. **Permission Errors**
   - Make sure XAMPP is run as administrator
   - Check file/folder permissions

## Development

### Adding New Features
- Follow the existing code structure
- Use prepared statements for database queries
- Validate both client-side and server-side
- Maintain consistent styling

### Code Style
- Use meaningful variable names
- Add comments for complex logic
- Follow PHP PSR standards where possible
- Use consistent indentation (4 spaces)

## License

This project is for educational purposes. Feel free to modify and use as needed.

## Support

For issues or questions, please contact me [here](mohamedalitkhsaoui@gmail.com).
