<?php

/* Traits */
trait HelloTrait {
    public function sayHello() {
        echo "Hello from HelloTrait!" . PHP_EOL;
    }
}

trait WorldTrait {
    public function sayWorld() {
        echo "World!" . PHP_EOL;
    }
}

trait GoodbyeTrait {
    public function sayGoodbye() {
        echo "Goodbye!" . PHP_EOL;
    }
}

trait FarewellTrait {
    public function sayGoodbye() {
        echo "Farewell!" . PHP_EOL;
    }
}

trait PropertiesTrait {
    public $property = "I'm a trait property!";
}

/* Classes */

// Basic Trait
class MyClass {
    use HelloTrait;
}

// Multiple Traits
class MyCompositeClass {
    use HelloTrait, WorldTrait;
}

// Resolving Trait Conflict
class MyConflictClass {
    use GoodbyeTrait, FarewellTrait {
        FarewellTrait::sayGoodbye insteadof GoodbyeTrait;
    }
}

// Trait visibility
class MyClassWithChangedVisibility {
    use HelloTrait {
        sayHello as private privateHello;
    }
}

// Trait Aliasing Methods
class MyAliasedClass {
    use HelloTrait {
        sayHello as greet;
    }
}

// Trait with properties
class MyClassWithProperty {
    use PropertiesTrait;
}


$obj = new MyClass();
$obj->sayHello(); // Hello from HelloTrait!

$obj2 = new MyCompositeClass();
$obj2->sayHello(); // Hello from HelloTrait!
$obj2->sayWorld(); // World!

$obj3 = new MyConflictClass();
$obj3->sayGoodbye(); // Farewell!

$obj4 = new MyClassWithChangedVisibility();
// $obj4->privateHello(); // This throw an error since it's private now.

$obj5 = new MyAliasedClass();
$obj5->greet(); // Hello from HelloTrait!

$obj6 = new MyClassWithProperty();
echo $obj6->property . PHP_EOL; // I'm a trait property!

