# About Dictionary!

Dictionary! allows you to look up terms and find definitions. Definitions can be added to the term if it is found. A
term can have multiple definitions so feel free to add as many as you like.

## Running Dictionary!

NOTE: All commands below assume that you are currently in application root before starting

### Requirements

You will need docker desktop installed to run the application

### Installation

Installation is easy! Just follow the steps below to get up and running.

```bash
 cd src
 ../bin/composer install
 docker compose up -d
```

Once the application has started, it should be accessible via http://localhost:8080

### Resetting the application
If you need to reset the application (clear Composer files and DB) use the following commands.

```bash
docker compose down
rm -rf .tmp
rm -rf src/vendor
```
