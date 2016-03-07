# EmbarkNow Injections

Building better software requires a better system of bootstrapping applications. Dependency injection is a principal that we should all be aware of, and using. Even with this being the case, configuring an injection system is a difficult task to get right first time.

### Config file Hell

Configuring an injection system can lead to multiple config files which define the inner functionality. These are untestable.

### Bootstrap Hell

Configuring an injection system can lead to a huge bootstrap file of internal logic just to define the functionality. This is untestable.

### Using Injections

Injections are small invokable testable classes that define the smallest details of your application. You have to define your data layer in the injector? Write an Injection. You have to define your Twitter API? Write an Injection.

EmbarkNow Injections don't have any ties to any implementation of the dependency injection principle, so you're free to use any, and let this small package aid in your application bootstrap process.

## What are Injections really?

An Injection is a class that is invokable, and much like the popular middleware pattern. It recieves input in the form of an injector implementation instance. This could be any implementation; We prefer Auryn.

The Injection is then allowed to make changes to that instance by using available methods.

## Installation

```
composer require embarknow/injections
```
