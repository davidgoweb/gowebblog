#!/bin/bash

# WordPress Theme Release Script
# This script helps create a release commit with the proper message format

# Check if version is provided
if [ -z "$1" ]; then
    echo "Usage: ./release.sh <version> [message]"
    echo "Example: ./release.sh 1.2.3 'Fixed navigation bug and improved performance'"
    exit 1
fi

VERSION=$1
MESSAGE=${2:-"Release version $VERSION"}

# Build the theme
echo "Building theme..."
cd Gowebblog_Theme
npm run build

# Update version in style.css
echo "Updating version in style.css..."
sed -i.bak "s/Version: .*/Version: $VERSION/" style.css
rm style.css.bak

# Update version in package.json
echo "Updating version in package.json..."
npm version $VERSION --no-git-tag-version

# Go back to root directory
cd ..

# Commit changes
echo "Committing changes..."
git add Gowebblog_Theme/style.css
git add Gowebblog_Theme/package.json
git add Gowebblog_Theme/assets/css/main.css
git commit -m "release version $VERSION: $MESSAGE"

echo "Release commit created! Push with: git push origin main"
echo "After pushing, the GitHub Actions workflow will automatically create the release."