#  QuackBook !
## What about QuackBook

QuackBook is the "FIRST" Duck's Social-Network in the world ...

Play and enjoy !!

## Requirements
    1. Git
    2. Composer 
    3. Php (7.3 or highter)
    4. Mysql

## get this project (in parent folder)
    -$ git clone https://github.com/vozoul/sf.git <project_name_you_want> 
    
## Install necessary bundles
    -$ cd <project_name_you_wanted>
    -$ composer install

#### From here you are in projectFolder 
## DataBase init
    -$ php bin/console doctrine:database:create
    or
    (shortcuts version)
    -$ php bin/console d:d:c
    
## DataBase migrate
    -$ php bin/console doctrine:migrations:migrate
     or
     (shortcuts version)
    -$ php bin/console d:m:m


#### for DEV environment
##### you can use Fixtures to test our Application
    -$ php bin/console doctrine:fixtures:load
    
    In shortcut after bin/console you do this: d:f:l 