<?php

// Iterators
$directory = new DirectoryIterator(__DIR__);
foreach ($directory as $fileInfo) {
    if (!$fileInfo->isDot()) {
        echo $fileInfo->getFilename() . PHP_EOL;
    }
}

// Exceptions
try {
    throw new InvalidArgumentException("Invalid Argument passed.");
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}

// Data Structures
$stack = new SplStack();
$stack->push('a');
$stack->push('b');
$stack->push('c');

echo $stack->pop() . PHP_EOL;
echo $stack->top() . PHP_EOL;

// File manipulation
$fileObject = new SplFileObject('./resources/files/example.txt', 'w');
$fileObject->fwrite("Hello, SPL!");

// Autoload
function my_autoloader($class) {
    include './resources/files/' . $class . '.Class.php';
}
spl_autoload_register('my_autoloader');

$obj = new MyClass(); // Esto intentará cargar 'includes/MyClass.Class.php'

// Observer y Observable
class MyObserver implements SplObserver {
    public function update(SplSubject $subject) {
        echo 'Observer triggered on update!' . PHP_EOL;
    }
}

class MySubject implements SplSubject {
    private $observers;

    public function __construct() {
        $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer) {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer) {
        $this->observers->detach($observer);
    }

    public function notify() {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

$subject = new MySubject();
$observer = new MyObserver();
$subject->attach($observer);
$subject->notify();