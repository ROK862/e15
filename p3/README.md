# Project 3
+ By: *Robbins Kariseb*
+ Production URL: <http://e15p3.appsuits.org>

## Feature summary
*For Project 3, I decided to implement a ordering system which enables it's users to do the following*

+ Visitors can register/log in
+ Users can add/update/delete listings.
+ Manage their listings, with additional functionalities such as hiding or showing their listings.
+ Manage their orders, check expected delivery dates and the order history over time.
+ Each user can order products posted by other users on the platform.
+ Each user has the ability to search through products.

  
## Database summary
*The database contains three tables in total, each managing a certain aspect of the application. The relationships between the tables are as follow:
- Items table follows a one to many relationship with the users table where one user can have many item listings.
- orders table has a one to one relationship with both users and items where one order can only have one user and one product. Also, there is an additional foreign key which tracks who owns the order. The owner, in this case, is the person who listed the product, which the order was placed against.*

+ My application has 3 tables in total (`users`, `items`, `orders`)
+ There's a one-to-many relationship between `users` and `items`
+ There's a one-to-one relationship between `orders`, `items` and `users`

## Outside resources
*For outside resources, i referenced the following:*
- Images:
-- Banner Image URL @thumbs.dreamstime.com: <https://thumbs.dreamstime.com/b/mega-sale-banner-purple-background-discount-up-to-off-sticker-flayer-shopping-tag-vector-illustration-143234975.jpg>

## Notes for instructor
*I made a very important change to the project regarding a PHP version. This is because i installed a package to support longBlob which forced me to upgrade to PHP version ^8.1.0. None the less, I was unable to complete the support for longBlobs because the entire environment broke. Composer notified me that there are deeply nested dependencies which are still requiring PHP version ^8.1.0, thus i needed to change the environment settings for the project proxy server. I implemented a change to the hes file which houses the proxy server configurations. Here is the updated line of code which help me fix the problem:

- Old code: `fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;`
- New code: `fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;`

After implementing this change, the server was able to run on PHP version 8.1.0 and all underlying dependencies.*

- It is important to note that the application doesn't support large image uploads.
- - The reason behind this, as explained above is that the database is using blob instead of long blobs. `p3.items.image`, `p3/database/migrations/2023_05_08_174028_create_items_table.php`.

## Tests
`undergraduate - opting out`