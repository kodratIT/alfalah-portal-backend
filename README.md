# AlFalah Backend

This is the backend API and admin panel for the AlFalah website, built with Laravel and Filament. It provides a robust admin interface for managing content such as news (Berita), using Filament as the admin panel framework.

## Features

- **Admin Panel**: Powered by Filament for easy CRUD operations on resources like Berita (News).
- **Berita Management**: Create, read, update, and delete news articles with fields for title, category, date, author, thumbnail, content, and auto-generated slug for SEO-friendly URLs.
- **File Uploads**: Support for image uploads (thumbnails) stored in public storage.
- **Database**: MySQL-compatible, with migrations for schema management.
- **Authentication**: Built-in Laravel authentication for admin users.
- **Slug Generation**: Automatic slug creation from title, with uniqueness handling.

## Requirements

- PHP >= 8.1
- Composer
- Node.js and NPM (for asset compilation)
- MySQL 5.7+ or MariaDB 10.2+
- Laravel 10.x
- Filament 3.x

## Installation

1. **Clone the Repository**:
   ```
   git clone <repository-url>
   cd backend
   ```

2. **Install Dependencies**:
   ```
   composer install
   npm install
   ```

3. **Environment Setup**:
   Copy the example environment file and configure your database and other settings:
   ```
   cp .env.example .env
   ```
   Edit `.env`:
   - Set `DB_CONNECTION=mysql`
   - Set `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
   - Generate application key: `php artisan key:generate`

4. **Directory Permissions**:
   Ensure writable directories:
   ```
   chmod -R 775 storage bootstrap/cache
   ```

5. **Database Setup**:
   Run migrations to create tables:
   ```
   php artisan migrate
   ```

6. **Asset Compilation**:
   Compile frontend assets:
   ```
   npm run build
   ```
   Or for development: `npm run dev`

7. **Create Admin User**:
   Use Filament's user creation or Laravel's artisan command:
   ```
   php artisan make:filament-user
   ```
   Follow the prompts to create an admin user.

8. **Run the Application**:
   Start the development server:
   ```
   php artisan serve
   ```
   Access the admin panel at `http://localhost:8000/admin`.

## Usage

- **Admin Panel**: Log in at `/admin` to manage resources like Berita.
- **API Endpoints**: Standard Laravel routes are available; extend as needed for frontend integration.
- **File Storage**: Uploaded files (e.g., thumbnails) are stored in `public/storage/berita`. Run `php artisan storage:link` to create the symbolic link.

### Managing Berita

- **Create News**: In the admin panel, go to "Konten" > "Berita" > "Create". Fill in title, category (Akademik, Kegiatan, Prestasi), date, author, thumbnail, and content. Slug is auto-generated from title.
- **Edit**: Slugs are unique and can be edited manually if needed.
- **View Table**: The table shows thumbnail, title, slug, category, author, date, and creation time.

## Project Structure

```
backend/
├── app/
│   ├── Filament/          # Filament resources (e.g., BeritaResource)
│   ├── Models/            # Eloquent models (e.g., Berita)
│   └── Http/              # Controllers, middleware
├── database/
│   ├── migrations/        # Database migrations (e.g., add_slug_to_beritas_table)
│   └── seeders/           # Database seeders
├── public/                # Public assets, storage link
├── resources/             # Views, lang files
├── routes/                # Route definitions (web.php, api.php)
├── storage/               # Logs, sessions, uploaded files
├── vendor/                # Composer dependencies (ignored in Git)
├── .env                   # Environment config (ignored in Git)
├── .gitignore             # Git ignore rules
├── composer.json          # PHP dependencies
└── package.json           # NPM dependencies
```

## Development

- **Run Tests**: (If tests are added)
  ```
  php artisan test
  ```
- **Queue Jobs**: For background tasks:
  ```
  php artisan queue:work
  ```
- **Hot Reload**: Use `npm run dev` for asset changes.

## Contributing

1. Fork the repository.
2. Create a feature branch: `git checkout -b feature/AmazingFeature`.
3. Commit changes: `git commit -m 'Add some AmazingFeature'`.
4. Push to the branch: `git push origin feature/AmazingFeature`.
5. Open a Pull Request.

## Security

- Do not commit `.env` files.
- Use strong database credentials.
- Keep dependencies updated: `composer update` and `npm update`.

## License

This project is open-source and available under the MIT License.

## Support

For issues, open a GitHub issue or contact the maintainer.
