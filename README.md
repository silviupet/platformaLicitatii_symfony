# platformaLicitatii
1. creare proiect: cd calea unde e proiectul; 

 create -project symfony/website-skeleton nume_site
2. pt Doctrine 

composer require symfony/orm-pack

composer require symfony/maker-bundle --dev 

3. configurare conexiune db in .env rand 27 .
conventia este ca numele db sa fie la fel ca si proiectul

4. definim obiectele cu care lucram SRC/Entity (entity - new PHP class,name spaace App\entity si definim proprietatiile)
5.Mapare la DB Use Doctrine\ORM\Maping as ORM
6. creare DB in workbench sau phpmyadmin

7. creare Entity
php bin/console make:Entity

se urmeaza pasii

pentru User mai ok este cu

php bin/console make:user (creaza entitatea user si userrepository si configurare packages/security.yaml

apoi 

Autentificare
php bin/console make:auth

a nu se uita a se modifica in config/packages/security.yaml 
access_control:
-{path: ^login$, roles: IS_AUTENTICATED_ANONIMOUSLY}

8. creare Form

php bin/console make:form 

se urm pasii

9. creare db si migrare 

php bin/console make:migration

php bin/console doctrine:migrations:migrate

dupa ce am facut db tr sa punem utilizatori in db  cu un controller

10. creare repository pt fiecare entitate

php bin/console make:entity --regenerate

11. creare controller

php bin/console make:controller

sau un crud controller cu tote metodele  cu forms si cu templateuri

php bin/console make:crud 

12. creare view

13. rulare 

php bin/console server:run