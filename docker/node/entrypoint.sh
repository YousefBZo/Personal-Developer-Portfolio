#!/bin/sh

# Install dependencies
echo "Installing npm dependencies..."
npm install

# Build assets for production
echo "Building assets..."
npm run build

# Start the dev server
echo "Starting Vite dev server..."
exec npm run dev

