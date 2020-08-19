## Posts statistics

### Build and Run

- Build and run containers
```
docker-compose up --build -d
```

- Enter web container and run migrations
```
docker exec -it web bash
composer install
```
