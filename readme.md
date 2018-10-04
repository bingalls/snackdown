## SnackDown
Have you _wrestled_ with other movie upload web sites?
SnackDown opens a Cannes of Whoop, if you got the creds to install
PHP/Laravel.

Hungry for more Snack-talk? This is a working demo, to upload, view, 
and team-tag your video (metadata) on a web server 

### Get Ready to Rumble
Roll in style with Mac OSX & [Valet](https://laravel.com/docs/master/valet).
Linux or Vagrant can also keep you from cursing in the locker room.

* Php 7.2+      Can accommodate v7.0 with few changes
* Mysql 5.7.8+  Required for Tags. Mariadb 10.2 support for Json fields does not yet work
* [ffmpeg](https://ffmpeg.org/)
* [git clone snackdown](https://github.com/bingalls/snackdown)
* `cd snackdown/`
* `composer install`
* `npm install`  # or `yarn`
* `cp .env.example .env` # and edit
* create empty database using DB_* settings in .env
* `php artisan key:generate`
* `php artisan migrate`
* `php artisan db:seed`
* `npm run development`   # or yarn
* `php artisan storage:link`
* Check path to ffprobe in config/laravel-ffmpeg.php

### Expect a Clean Fight
Run these tests, if you ever notice trouble.
* `cd snackdown/`
* `composer validate`
* `composer phpunit`
* `composer coverage-text`
* `npm audit`
* `npm doctor`
* `yarn check`        # if available; just accept typical errors in vendor libs :(
* # Ensure _testURL_ in package.json is correct
* `npm run test`
* `phpcs --standard=PSR2 -n app`  # Better: edit PSR2, lineLength in ruleset.xml
* `php artisan sniff -n`
* `eslint resources/`
* `jshint resources/`
* `jscs resources/`      # jscs is being deprecated
* `sass-lint`
* `find resources/ -name *.scss | xargs stylelint` # zsh: `style-lint resources/**/*.scss`

### Get in and Fight
Login with *user@user.com* / *secret*
Accounts are in database/seeds/Auth/UserTableSeeder.php

Showtime!

### Talking Snacks
You want movies? You want popcorn? You gonna squirrrm!

Keep in mind that this demo proves a concept. For example, the 
backoffice dashboard is left as a skeleton for you to extend, thus 
impacting test coverage. Also as a demo, this does not cover enterprise
needs, such as pagination for many videos, & just basics for user auth
 & social media.
 Not all translations are up-to-date with English.

* Tested (Expect a Clean Fight, above)
* Mobile responsive. Good UX for a demo
* Simple database schema. Your model will likely vary
* Extensible, including ReST API
* Open source
* Modern tools: webpack, sass, laravel, vue
* Security. Good practices are used, but this one depends on your usage.
* Documented. Enough to cover your needs easily

### License
Copyright 2018 Bruce Ingalls with [MIT license](http://www.mit-license.org).
See also [boilerplate](http://laravel-boilerplate.com/), composer.json & 
package.json for additional contributions 
