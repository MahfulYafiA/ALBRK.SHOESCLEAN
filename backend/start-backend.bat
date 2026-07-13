@echo off
setlocal
cd /d "%~dp0"
set "APP_ROOT=%~dp0.."
set "TEMP=%APP_ROOT%\storage\framework\tmp"
set "TMP=%APP_ROOT%\storage\framework\tmp"
php artisan serve
