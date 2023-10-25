# Blog Project

This project is a blogging platform built with PHP, following the MVC (Model-View-Controller) architecture. It provides a simple and intuitive interface for managing blog posts and categories.

## Features

- CRUD operations for managing blog posts.
- Category management for blog posts.
- API endpoints for adding, deleting, and viewing posts.
- Mockup data generation through migrations and seeding.

## Technologies

- PHP
- MySQL
- Composer with PSR-4 autoloading
- .htaccess for routing
- PDO Library for database interaction

## Database Structure

The database consists of three tables:

- `post_categories`: Stores categories for blog posts.
- `posts`: Stores blog posts.
- `post_category_relations`: Manages the relationship between posts and categories.

## Setup

1. Clone the repository.
2. Navigate to the project directory.
3. Run `composer install` to install dependencies.
4. Configure your database connection in the DBConnection class.
5. Run the migrations and seed the database with mockup data, open folder db.
6. Start your local server and navigate to the project URL in your web browser.

## API Endpoints

- `GET /api/v1/post_index`: Retrieve a list of all blog posts.
- `POST /api/v1/post_create`: Add a new blog post.
- `GET /api/v1/post_show/{id}`: View a blog post.
- `DELETE /api/v1/post_delete/{id}`: Delete a blog post.

## Access Control

This project uses the `Access-Control-Allow-Methods` header to manage allowed HTTP methods for API endpoints.

## Contributing

Feel free to fork the project, create a feature branch, and open a Pull Request.

## License

Free