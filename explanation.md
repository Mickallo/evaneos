# Refactoring Kata Test

## Clean Up

1st pass on code before hard change
update to php 8.1 
change library faker because deprecated
add tools (phpcsfixer / phpmd)
add autoload PSR 4

## ViewModel

Add Viewmodel Pattern to handle placeholder on message
And some improvements on TemplateManager

## Archi refacto

Segregation between App / Domain / Archi
add interfaces for repositories
and 1st pass on Dependency injection

## Dependency injection

add library php/di
refacto exemple and unitTest to use it

## clean Singleton

PHP/DI use singleton by default, we can remove the trait

## Next ...

Why do we pass class Quote in Template $data and not just quoteId ? 
not use phpUnit for End To End but 'behat' instead with cucumber senarii 
Use mock or DI with special config on phpunit test

