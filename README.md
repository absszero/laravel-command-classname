# Laravel Command Classname

![actions/workflows/run-tests.yaml](https://github.com/absszero/laravel-command-classname/actions/workflows/run-tests.yaml/badge.svg)


## Requirements

Laravel `5.6` ~ `10.x`

## Installation

1. `composer require absszero/laravel-command-classname`

## Usage

- Display all command class names

```shell
 $ php ./artisan classname

 Available commands:
  clear-compiled        Illuminate\Foundation\Console\ClearCompiledCommand
  completion            Symfony\Component\Console\Command\DumpCompletionCommand
  db                    Illuminate\Database\Console\DbCommand
  down                  Illuminate\Foundation\Console\DownCommand
  env                   Illuminate\Foundation\Console\EnvironmentCommand
  help                  Symfony\Component\Console\Command\HelpCommand
  inspire               Illuminate\Foundation\Console\ClosureCommand
  ...
```

- Display all command paths

```shell
 $ php ./artisan classname --path

 Available commands:
  clear-compiled        /Volumes/laravel-project/vendor/laravel/framework/src/Illuminate/Foundation/Console/ClearCompiledCommand.php
  completion            /Volumes/laravel-project/vendor/symfony/console/Command/DumpCompletionCommand.php
  db                    /Volumes/laravel-project/vendor/laravel/framework/src/Illuminate/Database/Console/DbCommand.php
  down                  /Volumes/laravel-project/vendor/laravel/framework/src/Illuminate/Foundation/Console/DownCommand.php
  env                   /Volumes/laravel-project/vendor/laravel/framework/src/Illuminate/Foundation/Console/EnvironmentCommand.php
  help                  /Volumes/laravel-project/vendor/symfony/console/Command/HelpCommand.php
  inspire               /Volumes/laravel-project/vendor/laravel/framework/src/Illuminate/
  ...
```

- Display single command

```shell
 $ php ./artisan classname clear-compiled

 Available commands:
  clear-compiled        Illuminate\Foundation\Console\ClearCompiledCommand
