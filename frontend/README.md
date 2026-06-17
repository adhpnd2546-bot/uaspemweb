# TaniPantau Public Website

This is the public-facing, read-only frontend for the TaniPantau agriculture monitoring system. It is built natively using PHP, CSS, and Bootstrap 5 without relying on complex frameworks. It natively consumes the TaniPantau Laravel APIs seamlessly.

## Directory Structure
```
frontend/
├── assets/
│   └── css/
│       └── style.css       # Custom Agriculture Green Theme
├── includes/
│   ├── api.php             # Core cURL operations linking Laravel Backend
│   ├── header.php          # Reusable Navbar & CDNs (Bootstrap, Leaflet, Icons)
│   └── footer.php          # Reusable End Section & scripts
├── index.php               # Landing Page (Stats, Search, Insights, List)
├── detail.php              # Individual Land metrics & Map Plotting & Visit Logs
└── README.md               # Documentation
```

## How to Run the Environment

Since this system communicates with our backend API, you must serve both applications concurrently locally to fully function.

### Step 1: Start Laravel Backend
Open a terminal in the `/backend` directory and initiate artisan:
```bash
cd backend
php artisan serve
```
By default, this hosts your APIs locally on `http://127.0.0.1:8000`.

### Step 2: Start PHP Native Frontend
Open a separate terminal within the parent directory (or specifically `/frontend`) and initiate the PHP Built-In Server.
```bash
cd frontend
php -S localhost:8080
```
Then navigate your browser to `http://localhost:8080`.

## Configuration (API URL)
The API URL string dictates where the frontend attempts its cURL resolutions. It is natively hardcoded exactly for a `localhost` development environment. Should you deploy or change backend ports, locate `includes/api.php` and update the definition:
```php
define('API_BASE_URL', 'http://127.0.0.1:8000');
```

## Troubleshooting

### Issue: "Data tidak tersedia" / No statistics loading
- **Backend not running**: Ensure `php artisan serve` is actively running in the backend folder without errors.
- **Port mismatch**: Verify that Laravel is actually running on port `8000` and wasn't natively rerouted to `8001`. Update `API_BASE_URL` in `api.php` if true.

### Issue: "Lokasi lahan tidak tersedia" on `detail.php`
- **Missing Data**: The Laravel Backend returned `latitude` and `longitude` fields gracefully empty or null for that exact Land. Update coordinates via the Administrator Dashboard.

### Issue: Search or Pagination failure
- **Zero lands exist**: The API connection succeeded, but empty arrays were returned. You need to login to the Backend and insert `Petani` and `Lahan` data to visualize the grids.
