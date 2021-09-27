## Installation Step

-   After cloning the repository, please run `composer install`
-   After installing composer dependencies, run `npm install` and `npm run dev`
-   Create `.env` file on the root directory, and copy the content of `.env.example` to .`env` file
-   Run `php artisan key: generate`
-   Run `php artisan migrate:fresh --seed`
-   Run `php artisan storage:link`

## Modifying Local Files and Update Heroku Application

-   After modifying local files, please stage the changes, commit them, and push to the remote repository by using `git push origin master` command
-   After pushing the changes to the remote repository, please run `git push heroku master` in order to push the changes from local repository to the Heroku remote repository

## Running Heroku Application for The First Time

-   Run `heroku run php artisan migrate:fresh --seed`
-   Run `heroku run php artisan storage:link`
