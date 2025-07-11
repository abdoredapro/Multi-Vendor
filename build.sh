echo "Running build sh" 

echo "Pulling from github"

git pull origin 

echo "Installing packages"

composer install --prefer-dist --optimize-autoloader

echo "Running migrations"

php artisan migrate --force

echo "The app has been built and deployed!"