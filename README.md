shortnsweet v2.1
============

### About
shortnsweet is a simple script setup to allow you to host your very own url shortening and image uploading service. It used to be called URL Shortener (i know, how original).

shortnsweet takes gaurds against being used by spammers. See the Spam Protection section below for more information.

### You need 3 things to be able to use this script:
 
 * Apache with mod_rewrite enabled or similar server/rewriting setup.
 * php
 * mysql
	 
### Installation
 * visit <path_to_install>/install/
 * confirm all data is correct, if not, edit config.php
 * install

### Spam Protection
To gaurd agains mailcious sites being linked to with shortnsweet, integration with [Goole Safe Browsing API](http://code.google.com/apis/safebrowsing/) has been included. In `config.php` there is a variable `$gsb_key`. To set it, visit [this page](http://code.google.com/apis/safebrowsing/key_signup.html) to generate a key and use that as the value for `$gsb_key`.

shortnsweet also checks any links sent for a response code. Any links that return a non-200 (notice, not 2xx) code will be rejected.

### Analytics
 * If you want to include any kind of google analytics, or your own statistics that require loading javascript, see the comments in `index.php` for instructions
 * There is _no tracking_ built in to shortnsweet.


