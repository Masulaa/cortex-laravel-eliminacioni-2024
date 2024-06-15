# Projektni-zadatak-laravel-srednjoskolci

Ova aplikacija je napravljena u Laravelu i služi za dijeljenje blogova.
Omogućuje korisnicima kreiranje, uređivanje,brisanje i pregled blogova (postova).
Korisnici mogu da kreiraju, uređuju i brisu svoje postove, dok admini (superadministratori) imaju dodatne permisije za upravljanje postovima i korisnicima u admin panel.

## Instalacija

### GNU/Linux
```bash
git clone https://github.com/lucic15/projektni-zadatak-laravel-srednjoskolci.git
cd projektni-zadatak-laravel-srednjoskolci
composer install
cp -r .env.example .env
php artisan key:generate
$EDITOR .env
php artisan migrate
```

### Windows
```bash
git clone https://github.com/lucic15/projektni-zadatak-laravel-srednjoskolci.git
cd projektni-zadatak-laravel-srednjoskolci
composer install
copy .env.example .env
php artisan key:generate
notepad .env
php artisan migrate
```

Za kreiranje administratora mozete koristiti artisan komandu 'create':
```bash
php artisan create admin Administrator administrator@proton.me admin123 admin123 
```
Ili

```bash
php artisan create
```

Takodje mozete da koristite ugradjene seed-ere umjesto da rucno kucate podatke.
Napomena: Koriscenje seed-era je neophodno kako bi se kreirale i kategorije za postove:

```bash
php artisan db:seed
```

Kako bi pokrenuli aplikaciju:
```bash
php artisan serve
```

## Autorizacija

Aplikacija koristi custom sistem za autorizaciju.
Postoje 3 vrste korisnika:
- Guest (ili gost) - Moze samo da gleda postove na stranici. Dok se korisnik ne uloguje on je gost.
- User - Ovo je default nalog koji se pravi na signup stranici ili preko 'create' komande. Moze da mijenja, brise, pravi postove.
- Admin (Superadmin) - Administrator koji ima sve permisije nad stranicom. Ima pristup admin panelu koji mu dava permisije da mijenja sve postove, kao i druge naloge. Moze da dava i oduzima permisije drugim nalozima.
