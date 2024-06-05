@echo off
echo Starting Laravel Development Server and NPM Development Server...

:: Change to the directory where the batch file is located
cd /d %~dp0

:: Start PHP artisan serve in a new command window
start cmd /k "php artisan serve"

:: Wait for 5 seconds to ensure the Laravel server starts before running npm
timeout /t 5 /nobreak

:: Start npm run dev in a new command window
start cmd /k "npm run dev"

echo Servers are running.
pause
