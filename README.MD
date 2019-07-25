QuackBook !
===========
What about QuackBook
--------------------

QuackBook is the "FIRST" Duck's Social-Network in the world ...

Enjoy !!

## Requirements
    1. Git
    2. Composer 
    3. Php (7.3 or highter)
    4. Mysql (5.4 or highter)

## get this project (in parent folder)
* ###### use HTTPS
    > $ git clone https://github.com/vozoul/sf.git <project_name_you_want>
    
* ###### use SSH
    > (Use an SSH key and passphrase from account.)
    > $ git clone git@github.com:vozoul/sf.git 

* ##### (Prefer a fork if you want to modify) 
    
## Install necessary bundles
   >$ cd <project_name_you_wanted>\
    $ composer install

#### From here you are in projectFolder 
* ## DataBase init
    >$ php bin/console doctrine:database:create \
    or\
    (shortcuts version)\
    $ php bin/console d:d:c
    
    
* ## DataBase migrate
    >$ php bin/console doctrine:migrations:migrate\
     or\
     (shortcuts version)\
    $ php bin/console d:m:m

#####  * For developers
#####  * You can use Fixtures to test our Application
    -$ php bin/console doctrine:fixtures:load
    (In shortcut after bin/console you do this: d:f:l) 
    
## LET'S PLAY AND ENJOY !!