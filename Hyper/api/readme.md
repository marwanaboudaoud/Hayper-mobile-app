# Installation guide for Hyper-API - Windows and Mac

Installation of Docker is required

## Installation

Clone the repository and run the build script

```bash
sh build.sh
```

This builds the whole project. This can take a while.

**Caution! you need to have docker(desktop) running for this to succeed**

**For Windows install or use Git Bash to run shell scripts!**

**Caution! command line and Powershell wont recognize sh commands**

## Running the container

```bash
sh run-containers.sh
```

**If you have problems installing the containers due to some previously installed containers this project is using?  
Try to turn those off or delete them.**

---

**For Windows install or use Git Bash to run shell scripts!**

**Command line and Powershell wont recognize sh commands**

**For normal docker commands Windows users can use Powershell**

## Installing dependencies

```bash
cd api
composer install
```

## Connect to database

**Caution this docker mysql container is running on port 3306. If you have an local server running on this port, the container cannot run or the connection cannot be made. Please turn the local instance of mysql off or use another port.**

-   Rename and copy the example .env file to a normal .env file
-   Return to Powershell for windows or Terminal on Mac and connect to the php container

**Caution! Use this command on the root directory of the project**

```bash
docker exec -it php /bin/bash

## Php interactive shell.
## bash-5.0#

php artisan key:generate
```

-   The env. file has been updated.
-   Open a mysql client and manage server connections. Listen to 127.0.0.1 and port 3306.
-   Use root as the mysql password
-   In the env. file change the DB_HOST to db
-   Return to the php interactive shell

```bash
php artisan migrate

php artisan db:seed
```

# Connect to the api

-   localhost:8080/api/documentation
