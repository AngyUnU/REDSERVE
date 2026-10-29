@echo off
REM Arranca REDSERV con el servidor de PHP de XAMPP (MySQL debe estar encendido en el panel de XAMPP)
echo Abriendo REDSERV en http://localhost:8000 ...
start "" http://localhost:8000/INTEGRADORA/index.html
"C:\xampp\php\php.exe" -S localhost:8000 -t "%~dp0."
