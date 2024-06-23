<?php

/* Service container :-
- بنحفظ فيها قيم ثابته زى مثلا كل ريكويست عاوزين نعمل اتصال با الداتا بيز
او اللغه مثلا

Service Providers :-
عباره عن حاجات مثلا عاوزين ننفذها كل ريكويست

Facades:- 
عباره عن اوبجيت باسم معين بيقابل نفس الاوبجيكت الاصلى زى الroute 


او هوا عباره عن اختصار لاوبجيكت متخزن فى ال
service container


او هوا عباره عن اوبجيكت بيشير لاوبجيكت معين عشان نستخدم كل الميثود

example:- 
I have Router Object and there's method Called "get" 
we are using Route Class and access to get 



Database  :- 
tinyInteger : the big namber 127
smallInteger: 
MedmiumInteger:
INT:
BigInteger : 

string (Laravel) = VARCHAR(64000) = هنا تقدرر تحد د تخلى 20 بس مثلا
default 255
text  = 64000

- If you want to make status and you want add specific status
$table->enum('status', ['active', 'inactive', 'pending'])
and you may make default('inactive')

- foreignId('') : that's make unsignedBigInteger 
UNSIGNED : All value absolute NOT -

كل فورين كى لازم يكون زى البرايم كى يكون مثلا
UnsignedBigInteger


->constrained(tableName, )

category
-- subcategory

->restirctOnDelete() :- If you wanna delete parent and parent has children
you can't delete it .

->cascadeOnDelete() :- if you wanna delete parent all children will delete

->nullOnDelete() :- if you deleted parent all childrent will be still
and forien key will be null



to make verify email add implement MustVerifyEmail
To sure user are verified email add middleware 'verified'


make controller with function (index, create, etc)
- php artisan make:controller name  -r  [-r  = resource]



Route::resource('/category', Category::class) :- thats make 7 routes like

create - store - etc..

==============================================================
- php artisan make:component alert --view
- To make Component Class using : php artisan make:component alert
- We are using Component Class when we need Like Fetch Data From database
Look at app\view - config\nav - component


-- Route::is(dashboard.*) return true if request start dashboard 

- if you have table called like categories and this table
contain data and you want to add column you have to make

- php artisan make:migration add_softDelet_to_categories_table


// to replace path href="(assets/.+)"  var = $1
// to replace path href="(assets/.+?)"  ? to not select the next attr


Note ** SMTP protocol use it to send mail or message


** Notification 
- php artisan make:notification OrderCreatedNotification



To publish email notification 
- php artisan vendor:publish --tag=laravel-notification
- php artisan vendor:publish --tag=laravel-mail

to use database channel laravel made a command for this :-  
php artisan notification:table


- breeze make routes, controller, views
- fortify make routes, methods only

directive like : @auth ..etc.

==================================== API ===============================
Restfull API : mean the response must be JSON
- php artisan make:controller --api
- to send request to API you must send header

Controller API
php artisan make:controller ProductController --api 5 methods

--- Accept: application/json . This make response to json

to make different response in api 
-- php artisan make:resource ProductResource

To protect API use Sanctum or Passport

- 3rd APIs
-- cURL . PHP native
-- HTTPGuzzle . package
- HTTPClient

API VS webhook 
webhook : API server send request to us or to my server
API : I send request to API server

make custome header :-
x-api-key
==================================== End API ===============================


Authorization : permission

Laravel provide us two methods
1- with Gates in AuthServiceProvider


Try any store or update will be in model, make controller clean


- Any method you will put it in  two models put it on trait

Policy = Gate but Policy be in model
- php artisan make:policy RolePolicy --model=Role

Policy for all 
php artisan make:policy ModelPolicy 

@can() check with gates if you want to check with Policy you must
with update - show - delete pass $object ('', $role)
with create pass ('', 'App\Model\Role')


=================
Custom Exception
php artisan make:exception InvalidOrderException
====================== Jobs =========
Jobs use to make anything without request

Jobs and Queues : you want to make anything but will take a long time this will work and after
finish will return response like import ExcelFile with 1M record

Queues : If you have al lot of job but you didn't want run all the same time



- php artisan make:job DeleteExpiredOrders

to run schedule - php artisan schedule:run

to run it local all time : php artisan schedule:work
to run it on server : look at doc

- we will use database for queue => php artisan queue:table


to listen : php artisan queue:work
php artisan queue:linsten --queue=import

======================== After deployment this is commands must run =======
composer install --optimize-autload --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link

SFTP extenstion makes: any edit in your editor upload automatic on server
ctrl + shift p
===========================================================================

- attach() => working with many-to-many relationships
-- $user->roles()->attach($roleId);

- sync : 
-- You may also use the sync method to construct many-to-many associations. The sync method accepts an array of IDs to place on the intermediate table. Any IDs that are not in the given array will be removed from the intermediate table. So, after this operation is complete, only the IDs in the given array will exist in the intermediate table


// attach : will add items in pivot table but will repeat if exist
// detach : will delete items in pivot table but will repeat if exist
// syncWithoutDetaching : will delete items in pivot table but will repeat if exist

For convenience, attach and detach also accept arrays of IDs as input:


=================================

// primary key default auto-increment and Not Accepy Null or empty value
// unique can be Null 
==================
    // Observers : Events what happent in Model
    // Events
    // creating, created, updating, updated, Saving, Saved
    // Deleting, Deleted, restoring, restored, retrived [ Select ]

    // php artisan make:observer CartObserver --model=Cart
    // to use it in model
    // static::observe(CartObserver::class)


    
======
pluck() => 

== 
- php artisan make:provider CartServiceProvider

// whereYear => to check year only
// whereMonth => to check month only
// whereDay => to check day only
// whereTime => to check time only
========================
- Contracts Folder => to implements interface
- Services => to implement class with methods like make request, add user ...
- Factories => to add Factory Pattern





==== Solid Principles ======

In the world of software design and development, adhering to solid principles is crucial to ensure the maintainability, extensibility, and readability of your codebase. One such principle that plays a vital role in achieving these goals is the Interface Segregation Principle (ISP). In this article, we will delve into the concept of ISP and demonstrate its implementation using the Laravel framework, backed by a real-world example.

1- S (Singe Responsibility principle)
    Every Class reponsible for one thing

2- O (Open-Closed Principle)
    Should be open for Extension, but closed for modification

3- L (Liskov Substitution Principle)

4- Interface Segregation Principle

A client should not be forced to implement an interface that it doesn’t use. or No client should be forced to depend on methods it doesn’t use. or a client should never depend on anything more than the method it’s calling.

5- Dependency Inversion

=====  real time Proccess ==========
- When You Update any thing to db you make event to send the data to broadcast
service and broadcast service recive event with data
Then you make listen or take data from pusher to your website

=====================
- review API - twofactor - ob - queue - custom ERROR 
- Solid Principle - webhook
J

*/