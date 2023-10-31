<?php


// Base class
class Animal
{
    public function speak()
    {
        return "Some sound...";
    }
}

// Extending the Animal class
class Dog extends Animal
{
    // Overriding the parent method
    public function speak()
    {
        return "Woof!";
    }

    public function fetch()
    {
        return "Fetching the ball...";
    }
}

$dog = new Dog();
echo $dog->speak() . PHP_EOL;  // Woof!
echo $dog->fetch() . PHP_EOL; // Fetching the ball...

// Another class extending Animal
class Cat extends Animal
{
    public function speak()
    {
        return "Meow!";
    }
}

$cat = new Cat();
echo $cat->speak() . PHP_EOL;  // Meow!

// Defining an interface
interface Workable
{
    public function work();
}

// Implementing the interface
class Human implements Workable
{
    public function work()
    {
        return "Working on a computer...";
    }
}

$human = new Human();
echo $human->work() . PHP_EOL;  // Working on a computer...

// Extending a class and implementing an interface
class SuperHuman extends Human implements Workable
{
    public function fly()
    {
        return "Flying high in the sky!";
    }

    // Don't need to implement work() method here, as it's already defined in the Human class
}

$superHuman = new SuperHuman();
echo $superHuman->fly() . PHP_EOL;     // Flying high in the sky!
echo $superHuman->work() . PHP_EOL;    // Working on a computer...


