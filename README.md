Objednávkový systém

Projekt není ještě hotový, momentálně na něm dodělávám administraci. 
Po registraci je nutno se zase přihlásit, poté tahám fakturační údaje pomocí xml z aresu.
Po potvrzení fakturačních udaju, přesměruje uživatele k objednávkovém systému, kde si může 
uživatel vytvořit, upravit a odstranit objednávku. Po potvrzení odešle potvrzovací email.


Je nutno zadat
php artisan migrate
php artisan passport:install
a do env zadat klíč a č. user_id.
php artisan db:seed
