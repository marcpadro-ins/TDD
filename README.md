# TDD - Desenvolupament amb Test Driven Development en Laravel

Aquest projecte és una demostració pràctica de Test Driven Development (TDD) utilitzant el framework Laravel. L'objectiu és mostrar com dissenyar i implementar funcionalitats seguint el cicle de TDD: escriure proves, codificar la funcionalitat mínima necessària i refactoritzar el codi.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Contingut del projecte

El projecte es divideix en diversos mòduls, cadascun amb la seva funcionalitat i conjunt de proves per garantir la qualitat del codi.

### Gestor de Tasques
Aquest mòdul gestiona la creació, actualització i eliminació de tasques dins l'aplicació.
- **Control·lador:** `GestorDeTasquesController`  
  Gestiona les peticions relacionades amb les tasques i coordina la interacció entre models i vistes.
- **Model:** `GestorDeTasques`  
  Conté la lògica de negoci per administrar les tasques.
- **Model:** `Tasca`  
  Defineix l'entitat Tasca, incloent atributs i relacions necessàries.
- **Proves:** `GestorDeTasquesTest`  
  Assegura que totes les operacions del gestor de tasques es comportin segons el disseny preestablert.

### Cuenta
Aquest mòdul s'encarrega de la gestió de comptes d'usuari, incloent operacions bàsiques i validacions.
- **Model:** `Cuenta`  
  Representa la informació d'un compte i les seves funcionalitats.
- **Proves:** `CuentaTest`  
  Verifica el comportament correcte de les operacions associades als comptes.

### Validar CCC i IBAN
Aquest mòdul implementa la validació dels números de compte bancari segons els formats CCC i IBAN.
- **Model:** `IBAN`  
  Conté la lògica per validar i processar els números CCC i IBAN.
- **Proves:** `IBANTest`  
  Assegura que la validació dels números de compte compleixi amb els requisits establerts.

### Workflow
El projecte integra un workflow d'integració contínua a GitHub Actions que automatitza l'execució de proves i altres tasques:
- **Integració contínua:** Cada push i pull request desencadena l'execució de la suite de proves, garantint que el codi mantingui la qualitat i estabilitat esperades.
