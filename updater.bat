@echo off

rem -------------------------------------------------------------
rem  Windows Updater "longman php telegram bot".
rem
rem  @zickkeen <zickkeen@gmail.com>
rem  @link http://bojez.com/
rem  @copyright Copyright (c) 2020 Bojez Creative
rem  @license MIT License
rem -------------------------------------------------------------

@setlocal

set OBJ_PATH=%~dp0
rem to set PHP dir location, uncommenct below PHP_COMMAND
rem set PHP_COMMAND=""
rem set time period with second unit
set period=2
set loop=1000

if "%PHP_COMMAND%" == "" set PHP_COMMAND=php.exe

FOR /L %%A IN (1,1,%loop%) do (
	"%PHP_COMMAND%" "%OBJ_PATH%\getUpdatesCLI.php" %*
	echo.
	TIMEOUT /T %period% >NUL
)
@endlocal
