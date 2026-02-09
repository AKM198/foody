#!/bin/bash

# Run the HomeSectionSeeder to populate menu card content
echo "Running HomeSectionSeeder..."
php artisan db:seed --class=HomeSectionSeeder

echo "HomeSectionSeeder completed successfully!"
echo "Menu card content has been populated with proper titles and descriptions."