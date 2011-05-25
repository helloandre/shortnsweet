shortnsweet v2.0
============

### About
shortnsweet is a simple script setup to allow you to host your very own url shortening service. It also allows you to upload images and supports uploading from the iOS Twitter app. It used to be called URL Shortener (i know, how original)

### NOTE
Apparently twitter broke the ability to use custom image shorteners with their iOS client. If they ever decide to renable it again, this should still work...

### You need 3 things to be able to use this script:
 
 * Apache with mod_rewrite enabled or similar server/rewriting setup.
 * php
 * mysql
	 
### Installation
 * create the appropriate tables/privileges in mysql.
 * Set the variables at the top of `config.php`
 * Run the installation script by visiting <yoursite>/install.php.

### Analytics
 * If you want to include any kind of google analytics, or your own statistics that require loading javascript, see the comments in `index.php` for instructions
 * There is _no tracking_ built in to shortnsweet.


