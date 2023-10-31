<?php

// Defining a namespace
namespace MyCompany\Package;

const MY_CONSTANT = "A constant in the namespace";

class MyClass
{
    public static function sayHello()
    {
        return "Hello from MyCompany\\Package\\MyClass!";
    }
}

function myFunction()
{
    return "A function inside MyCompany\\Package namespace.";
}

// Using sub-namespaces
namespace MyCompany\Package\SubPackage;

class SubClass
{
    public static function greet()
    {
        return "Greetings from SubPackage!";
    }
}

// Using classes from another namespace
namespace MyCompany\Users;

use MyCompany\Package\MyClass;
use MyCompany\Package\SubPackage\SubClass as RenamedSubClass;

// Aliasing/Importing with a different name

class User
{
    public static function display()
    {
        echo MyClass::sayHello() . PHP_EOL;
        echo RenamedSubClass::greet() . PHP_EOL;
    }
}

User::display();

// Accessing global classes from a namespace
namespace MyCompany\Utils;

class Utils
{
    public static function showLength($str)
    {
        // Using global PHP class "DateTime" from within a namespace
        $dt = new \DateTime();
        echo "Current date and time: " . $dt->format('Y-m-d H:i:s') . PHP_EOL;
        echo "Length of the string: " . strlen($str) . PHP_EOL;
    }
}

Utils::showLength('Hello, world!');

// Using functions from another namespace
namespace MyCompany\Reports;

use function MyCompany\Package\myFunction;

echo myFunction() . PHP_EOL;


