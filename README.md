
---

# Movie API Documentation

Welcome to the documentation for the Movie API! This API allows users to manage movies, including authentication, listing, filtering, creation, updating, and deletion of movies. 

## Authentication Endpoints

### 1. Login
- **URL**: `/api/auth/login`
- **Method**: `POST`
- **Description**: Allows users to log in and obtain authentication tokens.
- **Request Body**:
    - `email` (string, required): The email address of the user.
    - `password` (string, required): The password of the user.
- **Response**:
    - `token` (string): JWT token for authentication.

### 2. Register
- **URL**: `/api/auth/register`
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
- **URL**: `/api/auth/logout`
- **Method**: `POST`
- **Description**: Allows users to log out and invalidate their authentication tokens.
- **Request Headers**:
    - `Authorization` (string, required): JWT token obtained during login.
- **Response**:
    - `message` (string): Confirmation message for successful logout.

## Movie Endpoint

### 1. Star War Movies List
- **URL**: `/api/star-war`
- **Method**: `GET`
- **Description**: Retrieves a list of Star Wars movies.
- **Authorization**: Required, JWT token obtained during login.

### 2. Get Movie Details
- **URL**: `/api/movie/{id}`
- **Method**: `GET`
- **Description**: Retrieves details of a specific movie by its ID.
- **Authorization**: Required, JWT token obtained during login.
- **URL Parameters**:
    - `id` (integer, required): The ID of the movie to retrieve.

### 3. Store Movie
- **URL**: `/api/movie-store`
- **Method**: `POST`
- **Description**: Stores a new movie.
- **Authorization**: Required, JWT token obtained during login.
- **Request Body**:
    - `title` (string, required): The title of the movie.
    - `overview` (string, required): A brief overview or summary of the movie.
    - `release_date` (date, required): The release date of the movie.
    - `popularity` (float, required): The popularity rating of the movie.
    - `vote_average` (float, required): The average vote rating of the movie.
    - `vote_count` (integer, required): The total count of votes for the movie.
    - `original_language` (string, required): The original language of the movie.
    - `poster_path` (string, required): The path to the poster image of the movie.
    - `backdrop_path` (string, required): The path to the backdrop image of the movie.
    - `adult` (boolean, required): Indicates whether the movie is for adults only.
    - `video` (boolean, required): Indicates whether the movie has video content.
- **Response**:
    - `message` (string): Confirmation message for successful movie storage.
    - `data` (object): Details of the newly stored movie.

### 4. Update Movie
- **URL**: `/api/movie-update/{id}`
- **Method**: `PUT`
- **Description**: Updates an existing movie by its ID.
- **Authorization**: Required, JWT token obtained during login.
- **URL Parameters**:
    - `id` (integer, required): The ID of the movie to update.
- **Request Body**:
    - Any combination of fields mentioned in the "Store Movie" API section to update the corresponding fields of the movie.
- **Response**:
    - `message` (string): Confirmation message for successful movie update.
    - `data` (object): Details of the updated movie.

### 5. Delete Movie
- **URL**: `/api/movie-delete/{id}`
- **Method**: `DELETE`
- **Description**: Deletes a movie by its ID.
- **Authorization**: Required, JWT token obtained during login.
- **URL Parameters**:
    - `id` (integer, required): The ID of the movie to delete.
- **Response**:
    - `message` (string): Confirmation message for successful movie deletion.

### 6. Filter Movies
- **URL**: `/api/movie-filter`
- **Method**: `GET`
- **Description**: Filters movies by title.
- **Authorization**: Required, JWT token obtained during login.
- **Query Parameters**:
    - `title` (string, optional): The title of the movie to filter by.
- **Response**:
    - `message` (string): Confirmation message.
    - `data` (array): List of movies matching the filter criteria.

---
