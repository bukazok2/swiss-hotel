## Installation & updates

composer install<br />

<br />
Please review the .env file to ensure that the database has been configured correctly.

php spark db:create swiss<br />
php spark migrate:refresh<br />
php spark serve<br />

## Dev enviroment

npm install<br />
npm run dev<br />
npx tailwindcss -i ./public/css/input.css -o ./public/css/styles.css --watch<br />


## After Installation

http://localhost:[port]/Fetch<br />
http://localhost:[port]/UpdateCache<br />

I need a cron job to call two URLs every 20 minutes. Initially, it's acceptable to manually invoke the url's for the first <br />execution. Additionally, the "UpdateCache" URL may necessitate an increase in the maximum execution time. It can be beneficial if <br />the two URLs could be combined for simplicity. But for the better oversight I left them seperated.<br />

## Server Requirements

composer<br />
php 8<br />

## Dev comments
To enhance the page's performance, consider implementing the following optimizations:<br />

1.During the Fetch period, updating the cache might be preferred over deleting and recreating it.<br />
2.In the UpdateCache period, focus on checking only new images instead of rechecking all images, as the image check, particularly <br />with curl, consumes a significant amount of time.
3.Introduce a view table to replace left joins, improving efficiency.<br />
4.Implement an SQLITE3 database with the :memory: storage option to hold data in memory rather than on disk, contributing to faster access.<br />

When displaying only the cheapest deals, there are 546 hotels to showcase. The query loads in approximately 200 milliseconds, and the page renders in around 0.0371 seconds.<br />
