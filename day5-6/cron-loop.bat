@echo off
:loop
echo Running cron.php at %date% %time%
php C:\xampp\htdocs\training\day5\cron.php
timeout /t 43200 >nul
goto loop

