## Installation & updates

composer install
php spark db:create swiss
php spark migrate:refresh
php spark serve

## Dev enviroment

npm install
npm run dev
npx tailwindcss -i ./public/css/input.css -o ./public/css/styles.css --watch

## After Installation

http://localhost:[port]/Fetch
http://localhost:[port]/UpdateCache

I need a cron job to call two URLs every 20 minutes. Initially, it's acceptable to manually invoke the url's for the first execution. Additionally, the "UpdateCache" URL may necessitate an increase in the maximum execution time. It can be beneficial if the two URLs could be combined for simplicity. But for the better oversight I left them seperated.

## Server Requirements

composer
php 8

## Dev comments
To enhance the page's performance, consider implementing the following optimizations:

1.During the Fetch period, updating the cache might be preferred over deleting and recreating it.
2.In the UpdateCache period, focus on checking only new images instead of rechecking all images, as the image check, particularly with curl, consumes a significant amount of time.
3.Introduce a view table to replace left joins, improving efficiency.
4.Implement an SQLITE3 database with the :memory: storage option to hold data in memory rather than on disk, contributing to faster access.

When displaying only the cheapest deals, there are 546 hotels to showcase. The query loads in approximately 200 milliseconds, and the page renders in around 0.0371 seconds.
