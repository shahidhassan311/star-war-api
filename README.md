Here's the documentation for the provided APIs:

## Authentication Endpoints

### 1. Login
- **URL**: `/auth/login`
- **Method**: `POST`
- **Description**: Allows users to log in and obtain authentication tokens.
- **Request Body**:
    - `email` (string, required): The email address of the user.
    - `password` (string, required): The password of the user.
- **Response**:
    - `token` (string): JWT token for authentication.

### 2. Register
- **URL**: `/auth/register`
- **Method**: `POST`
- **Description**: Allows users to register and create a new account.
- **Request Body**:
    - `name` (string, required): The name of the user.
    - `email` (string, required): The email address of the user.
    - `password` (string, required): The password for the new account.
- **Response**:
    - `user` (object): Details of the newly registered user.
    - `token` (string): JWT token for authentication.

### 3. Logout
- **URL**: `/auth/logout`
- **Method**: `POST`
- **Description**: Allows users to log out and invalidate their authentication tokens.
- **Request Headers**:
    - `Authorization` (string, required): JWT token obtained during login.
- **Response**:
    - `message` (string): Confirmation message for successful logout.

## Movie Endpoint

### 1. Movie List
- **URL**: `/movie-list`
- **Method**: `GET`
- **Description**: Retrieves a list of movies.
- **Authorization**: Required, JWT token obtained during login.

