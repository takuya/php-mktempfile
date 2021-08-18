# php-mktempfile
Make a Temp file in SysTemp with temp_name and auto removed.

## mktempfile function
This package provides a function `mktempfile()` to your composer project.
```injectablephp
<?php
require_once 'vendor/autoload.php';
$temp_file = mktempfile();
file_exists($temp_file);#=>true
```
## The TempDir will be auto remove

`$temp_file` will be ***auto removed*** by 'register_shutdown_function'.

## system temp directory

`mktempfile()` make file in  SystemTemp  by 'sys_get_temp_dir()'.

## Installing from GitHub.
```
composer config repositories.takuya/php-mktempfile vcs https://github.com/takuya/php-mktempfile
composer require takuya/php-rrmdir
```
## Installing with packagist.
```
composer require takuya/php-mktempfile
composer install
```

## test results.
![<CircleciTest>](https://circleci.com/gh/takuya/php-mktempfile.svg?style=svg)
## testing
```
composer install 
./vendor/bin/phpunit
```