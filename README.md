Installation du Project
=========

1.) installer les librerie et mise à jour l'application 

```
php composer install
```

2.) 
```
php bin/console doctrine:schema:drop --full-database --force 
```

3.) 

```
php bin/console doctrine:schema:update --force 
```

4.)

```
php bin/console doctrine:fixtures:load
```
puis appuyer sur `y` puis `Enter`.

5.)

```
php bin/console server:run
```