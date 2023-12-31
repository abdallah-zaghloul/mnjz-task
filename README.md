<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<h1>Project Title</h1>

<h2>Live Demo</h2>
<strong>Please watch this video 👇</strong>

[![Live Demo](https://img.youtube.com/vi/npRcg5_fPrw/0.jpg)](https://youtu.be/npRcg5_fPrw)

<h2>Project Infra Structure</h2>
<ul>
<li> The Project is a Decoupled Modular Monolithic App :
    HMVC Modules (you can turn on/off each module and republish/reuse it at another project):
<p>
<a target="_blank" href="https://drive.google.com/uc?export=view&id=1MDMrOSK9iAtsJq14os09uDVRsMbFd9M_">
<img src="https://drive.google.com/uc?export=view&id=1MDMrOSK9iAtsJq14os09uDVRsMbFd9M_">
</a>

<a target="_blank" href="https://drive.google.com/uc?export=view&id=1ipSpAv9TUY8XwXdJwyipu2uMy0C27xXM">
<img src="https://drive.google.com/uc?export=view&id=1ipSpAv9TUY8XwXdJwyipu2uMy0C27xXM">
</a>
</p>

<li> Module Structure (Repository Design Pattern)
<p>
<a target="_blank" href="https://drive.google.com/uc?export=view&id=1snsMfaRDm6hW-uOmEus4e6ZVi35rBlqO">
<img src="https://drive.google.com/uc?export=view&id=1_CTRCCiZ0X4nG06_xTv48y6MH5vBb1gx">
</a>
</p>

<li> Separated/Attached Tests
<p>
<a target="_blank" href="https://drive.google.com/uc?export=view&id=11hd7ACMLYU9WcTXBD5Eo_7mOBdM20I6M">
<img src="https://drive.google.com/uc?export=view&id=11hd7ACMLYU9WcTXBD5Eo_7mOBdM20I6M">
</a>
</p>
</ul>


<h2>Solution Implementation</h2>
<pre>
- Choose livewire for realtime ajax request : 
make it pretty simple for users to add/remove
products from their cart

- Call my module zaghloul-soft/user-module for reuse-ability
of user module authentication with HMVC Repository
based structure

- ERD :
User hasMany CartItems
CartItem Belongs to Product
User HasMany Products Through CartItems

- Flow :
*Route (/home) => HomeController => Home View(Load Components)

Components :
*CartComponent => CartService => CartItemRepository
*ProductsComponent => ProductsService => ProductRepository

- Each Click Dispatch Event To its ComponentService which
interact with view (Single Responsibility + Observer DP)

# No need for cart entity:
the info it added is cartId only
so you should work directly with
cartItems acc to task requirements.

#Bonus Points Can be added : 
- disable (+/-) button after product added to cart
</pre>

<h3>How To Run The Project Locally</h3>
<pre>
Requirements (all can be installed automatically using docker desktop):
---------------
- PHP 8.2
- Run Docker Desktop
- PostgreSQL
- SQL lite PHP Extension
<hr>
Run the following at the project root dir Terminal
---------------
<ul>
<li>Download Vendor folder
composer install

<li>Make Sail alias
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'

<li>Generate .env file from .env.decrypted:
php artisan env:decrypt --key=base64:oZg5Q1/sGhNgD8X8PxtlQT9CJxT/t9qW4TsDcDIA6nU=

<li>Laravel Sail install
php artisan sail:install

<li>Run Your local server up:
sail up -d

<li>Run Your local server down:
sail down

<li>To Run Unit/Feature Tests but configure your test with xdebug
sail php artisan test --testsuite={Modules or ModuleName}
</ul>

if you have an issue you can see <a href="https://laravel.com/docs/10.x/sail">Laravel Sail</a>
</pre>

