<?php

// Simple Class
class SimpleClass {
    public $property = "I'm a property of SimpleClass";

    public function displayProperty() {
        return $this->property . PHP_EOL;
    }
}

$simple = new SimpleClass();
echo $simple->displayProperty();

// Class with constructor
class ConstructorClass {
    private $property;

    public function __construct($value) {
        $this->property = $value;
    }

    public function displayProperty() {
        return $this->property . PHP_EOL;
    }
}

$constructed = new ConstructorClass("I'm constructed!");
echo $constructed->displayProperty();

// Inheritance
class ParentClass {
    public function sayHello() {
        return "Hello from ParentClass!" . PHP_EOL;
    }
}

class ChildClass extends ParentClass {
    public function sayGoodbye() {
        return "Goodbye from ChildClass!" . PHP_EOL;
    }
}

$child = new ChildClass();
echo $child->sayHello();  // Inherited method
echo $child->sayGoodbye();

// Interface
interface ExampleInterface {
    public function doSomething();
}

class InterfaceClass implements ExampleInterface {
    public function doSomething() {
        return "Doing something as defined by MyInterface!" . PHP_EOL;
    }
}

$interfaceInstance = new InterfaceClass();
echo $interfaceInstance->doSomething();

// Abstract Class
abstract class AbstractClass {
    abstract public function abstractMethod();

    public function concreteMethod() {
        return "I'm a concrete method!" . PHP_EOL;
    }
}

class ConcreteClass extends AbstractClass {
    public function abstractMethod() {
        return "I'm implementing the abstract method!" . PHP_EOL;
    }
}

$concrete = new ConcreteClass();
echo $concrete->concreteMethod();
echo $concrete->abstractMethod();
