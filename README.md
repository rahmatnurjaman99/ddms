# API SERVICE (BACKEND)
API to get statistics information from youtube channels.

## Requirements
- PHP 8.0 or higher
- Node.js v23+
- Composer 2
- Docker (if applicable)
- using sqlite (default)
- redis

## Documentation

### Using Docker
1. Start Docker Container
```bash
docker compose up -d --build
```

2. Exec container to run migration and seeder
```bash
docker compose exec frankenphp bash
```

3. Inside container go to backend folder
```bash
cd backend
```

4. Copy `.env.example` to `.env` and modify `.env` as you need
```bash
cp .env.example .env
```

5. Install package with composer
```bash
docker compose run --rm -w /app/backend composer install
```

6. Run migration and seeder
```bash
php artisan migrate --seed
```

7. Modify or Add in `/etc/hosts` for Linux or Mac `C:\Windows\System32\Drivers\etc\hosts` for Windows
```php
127.0.0.1	localhost
127.0.0.1	local.backend.com
```

### Without Docker

**IMPORTANT**: Ensure PHP, Composer, NodeJs, redis and database service already installed.

1. go to `src/backend` folder
```bash
cd src/backend
```

2. Copy `.env.example` to `.env` and modify `.env` as you need
```bash
cp .env.example .env
```

3. Install package with composer
```bash
composer install
```

4. Run migration and seeder
```bash
php artisan migrate --seed
```

5. Serve app
```bash
php artisan serve
```


### Making request
1. Get Channel ID
```bash
curl https://local.backend.com/api/youtube/channel?channel_id=UC9BTS8pOURSUci0hl6RXXKg -k
```

2. Get Latest Video from Channel ID
```bash
curl https://local.backend.com/api/youtube/channel/UC9BTS8pOURSUci0hl6RXXKg/latest-videos -k
```

3. Get Channel ID Statistics 
```bash
curl https://local.backend.com/api/youtube/channel/UC9BTS8pOURSUci0hl6RXXKg/statistics -k
```



# CHARTS (FRONTEND)
Show charts from dummy data `statistics.json`

## Requirements
- Node.js v23+
- Docker (if applicable)

### Using Docker and FrankenPHP web server

1. Modify or Add in `/etc/hosts` for Linux or Mac `C:\Windows\System32\Drivers\etc\hosts` for Windows
```php
127.0.0.1	localhost
127.0.0.1	local.frontend.com
```

2. Start Docker Container
```bash
docker compose up -d --build
```

3. Exec container to run migration and seeder
```bash
docker compose exec nodejs bash
```

4. Inside container go to frontend folder
```bash
cd frontend
```

5. Install packages
```bash
npm install
```

6. Build or run dev
```bash
npm run build
```

7. Go to your browser `https://local.frontend.com` (using build) or `http://localhost:5173` (run dev);


### Without Docker
1. Go to `src/frontend` folder
```bash
cd src/frontend
```

2. Install packages
```bash
npm install
```

3. Build or run dev
```bash
npm run dev
```

4. Go to your browser `https://your-host` (using build) or `http://localhost:5173` (run dev);