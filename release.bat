@echo off
REM WordPress Theme Release Script for Windows
REM This script helps create a release commit with the proper message format

REM Check if version is provided
if "%~1"=="" (
    echo Usage: release.bat ^<version^> [message]
    echo Example: release.bat 1.2.3 "Fixed navigation bug and improved performance"
    exit /b 1
)

set VERSION=%~1
set MESSAGE=%~2
if "%MESSAGE%"=="" set MESSAGE=Release version %VERSION%

echo Installing dependencies and building theme...
cd Gowebblog_Theme
call npm install
call npm run build

echo Updating version in style.css...
powershell -Command "(Get-Content style.css) -replace 'Version: .*', 'Version: %VERSION%' | Set-Content style.css -Encoding UTF8"

echo Updating version in package.json...
call npm version %VERSION% --no-git-tag-version

echo Rebuilding CSS with new version...
call npm run build

REM Go back to root directory
cd ..

echo Committing changes...
git add Gowebblog_Theme/style.css
git add Gowebblog_Theme/package.json
git add Gowebblog_Theme/assets/css/main.css
git commit -m "release version %VERSION%: %MESSAGE%"

echo Release commit created! Push with: git push origin main
echo After pushing, the GitHub Actions workflow will automatically create the release.