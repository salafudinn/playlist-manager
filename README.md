# Playlist Manager

![2025-12-06 22-08-41](https://github.com/user-attachments/assets/2129e898-9c60-492b-b4c3-575de09e60c8)

A simple PHP-based music playlist management application built with object-oriented programming principles. This project demonstrates core OOP concepts including encapsulation, class relationships, and MVC architecture pattern.

## Features

- Add songs with title, artist, and duration
- Remove songs from playlist
- Play songs with session-based tracking
- Persistent storage using JSON file format
- Clean separation of concerns with MVC structure

## Project Structure

The application follows a standard MVC pattern:
- **Models** (`src/`): Song and Playlist classes with business logic
- **Controllers** (`controllers/`): Request handling and data flow management
- **Views** (`views/`): User interface presentation
- **Data** (`data/`): JSON-based persistent storage

## Requirements

- PHP 7.4 or higher
- Web server (Apache, Nginx) or PHP built-in server

## Usage

Run the application using PHP's built-in server:

```bash
php -S localhost:8000 -t playlist-app
```

Access the application at `http://localhost:8000`

## Technical Implementation

The project demonstrates:
- Type declarations and strict typing
- Session management for playback state
- File-based data persistence
- POST-Redirect-GET pattern for form handling
- Clean class design with single responsibility principle
