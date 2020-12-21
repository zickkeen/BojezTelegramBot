@echo off

rem -------------------------------------------------------------
rem  Yii command line bootstrap script for Windows.
rem
rem  @author Qiang Xue <qiang.xue@gmail.com>
rem  @link http://www.yiiframework.com/
rem  @copyright Copyright (c) 2008 Yii Software LLC
rem  @license http://www.yiiframework.com/license/
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
