## Signed Pdf

## Instalation steps
1. git clone git@github.com:programermaster/signed_pdf.git .
2. composer install
3. create database "pdf"
4. edit .env file and change connection params for connecting to db
5. php artisan migrate:fresh
6. php artisan storage:link
7. php artisan serve
8. open in browser tab http://127.0.0.1:8000
