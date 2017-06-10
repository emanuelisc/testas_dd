# Transportas

Trumpa testine programėle. Programėles idėja yra pristatinėti transporto paslaugas.

## Getting Started

Trumpas aprašas kaip naudotis turima programėle.

### Irasyti Composeri

Projekto kataloge įvykdom pateikta komanda

```
composer install
```

### Sukurti Duomenų baze

Tam kad galėtume saugoti visus duomenys reikia sukurt duomenų baze.

```
mysql -u root -p
```

Įveskite savo duomenų bazes slaptažodi.

Dabar sukuriam duomenų baze:

```
create databese {Duomenu bazes pavadinimas}
```
```
exit
```
Dabar projekte atidarius parameters.yml failą app/config/parameters.yml

Suvedame Sukurtos Duomenų bazes duomenys:

    database_host: 127.0.0.1
    database_port: null
    database_name: {Sukurtos Duomenu bazes pavadinimas}
    database_user: root
    database_password: {Jusu prisijungimas prie duomenu bazes}

Ir paskutine ką reikia atlikt tai sukurt lenteles bei ryšius tarp jų:
```
php bin/console doctrine:schema:update --force
```

### Administratorius

Tam kad sukurt administratorių iš pradžių reikia sukurt pati pirma vartotoja. Tai galima padaryt tiesiog užsukus i registracija ir prisiregistruoti.
Veliau ir vėl prisijungti prie mysql ir pakeisti naudotojo role "ROLE_USER" i "ROLE_ADMIN"
```
mysql -u root -p
```
```
use {duomenu bazes pavadinimas}
```
```
update table user set role='ROLE_ADMIN' where id=1;
```
Jau turime sukurta administratorių.

### Kaip pradėti naudotis projektu

Iš pradžių prisijunges administratorius turi sukurt automobilius kad vartotojai kuriant užsakymą
galėtu pasirinkti norimo automobilio išmatavimus.

Toliau prisiregistrave vartotojai gali pasirinkti transporto priemone bei keliones duomenys.

Prisijunges administruotojas matys prie skilties "Drivers" nauju užsakymu kieki.

Administruotojas turės rankiniu būdu suves reikalavimuose paduotus laikus Vairuotojo puslapyje.

Išsaugojęs duomenys Administratorius puslapyje "User tables" gales matyti visus duomenys.

Pasirinkęs vartotoją ir data gales matyti visus jo užsakymus nuo pasirinktos datos.
 
Kuro sąnaudos yra skaičiuojamos pagal praleista laiką važiuojant, stovint pas klientą, vykdant iškrovimą.