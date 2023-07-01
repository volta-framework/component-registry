# Volta\Component\Registry\Container

Dependency manager providing *psr/container-implementation 1.0.0.*

See also https://www.php-fig.org/psr/psr-11/

## Classes

* `Volta\Component\Registry\Container` implementing `Psr\Container\ContainerInterface`
* `Volta\Component\Registry\Exception` implementing `Psr\Container\ContainerExceptionInterface`
* `Volta\Component\Registry\NotFoundException` implementing `Psr\Container\NotFoundExceptionInterface`

## Usage

```php
use Volta\Component\Registry\Container;
use Volta\Component\Registry\Exception;
use Volta\Component\Registry\NotFoundException;

$c new Container();
$c->set('name 1', 'value 1');
$c['name 2'] = 'value 2';
echo $c->get('value 2');
echo $c['value 1'];

try {
    $c['name 2'] = 'new value 2';

} catch (Exception $e) {
    // thrown on duplicate entry.
    // To avoid accidentally overwriting an entry an exception is thrown when
    // an entry already exists with the same id. If we need to overwrite an entry
    // we should unset the entry first
    exit($e->getMessage());
}

try{
    echo $c['name 3'];

} catch (NotFoundException as $e) {
    // thrown when entry is not found
    exit($e->getMessage());
}

```
[//]: # (Start Volta\UmlDoc\MermaidDiagram)
```mermaid
classDiagram
    class Volta_Component_Registry_Container {
        #?Volta\Component\Registry\Container _instance$=NULL
        #array _items=[0..*]
        +getInstance():Volta\Component\Registry\Container
        +item(string id, mixed default=NULL):mixed
        +setInstance(?Volta\Component\Registry\Container container):void
        +unsetInstance():void
        +get(string id):mixed
        +has(string id):bool
        +offsetExists(mixed offset):bool
        +offsetGet(mixed offset):mixed
        +offsetSet(mixed offset, mixed value):void
        +offsetUnset(mixed offset):void
        +set(string id, mixed entry):Psr\Container\ContainerInterface
        +unset(string id):Psr\Container\ContainerInterface
    }
    Volta_Component_Registry_Container *-- Volta_Component_Registry_Container : #_instance=NULL
    Volta_Component_Registry_Container --> Volta_Component_Registry_Container : +getInstance()
    Volta_Component_Registry_Container ..> Volta_Component_Registry_Container : +setInstance(container)
    class Psr_Container_ContainerInterface {
         	&lt;&lt;interface&gt;&gt;
    }
    Volta_Component_Registry_Container --> Psr_Container_ContainerInterface : +set()
    Volta_Component_Registry_Container --> Psr_Container_ContainerInterface : +unset()
    Psr_Container_ContainerInterface..|>Volta_Component_Registry_Container
    class ArrayAccess {
         	&lt;&lt;interface&gt;&gt;
    }
    ArrayAccess..|>Volta_Component_Registry_Container
    class Volta_Component_Registry_Exception
    Exception<|--Volta_Component_Registry_Exception
    class Exception
    class Stringable {
         	&lt;&lt;interface&gt;&gt;
    }
    class Throwable {
         	&lt;&lt;interface&gt;&gt;
    }
    Stringable..|>Throwable
    Throwable..|>Exception
    class Psr_Container_ContainerExceptionInterface {
         	&lt;&lt;interface&gt;&gt;
    }
    Throwable..|>Psr_Container_ContainerExceptionInterface
    Psr_Container_ContainerExceptionInterface..|>Volta_Component_Registry_Exception
    class Volta_Component_Registry_NotFoundException
    Exception<|--Volta_Component_Registry_NotFoundException
    class Psr_Container_NotFoundExceptionInterface {
         	&lt;&lt;interface&gt;&gt;
    }
    Psr_Container_ContainerExceptionInterface..|>Psr_Container_NotFoundExceptionInterface
    Psr_Container_NotFoundExceptionInterface..|>Volta_Component_Registry_NotFoundException
```
[//]: # (End Volta\UmlDoc\MermaidDiagram)
[//]: # (Start Volta\UmlDoc\MdDiagram)

Generated @  20230619 13:50:49

# Volta\Component\Registry\
3 Classes, 0 Interfaces, 0 Traits, 0 Enums,
### [Volta\Component\Registry\Container](#) *implements* Psr\Container\ContainerInterface, ArrayAccess
#### Properties(2)
- protected static ?Volta\Component\Registry\Container **[_instance](#)** = NULL
- protected array **[_items](#)** = [0..*]
#### Methods(12)
- public static function **[getInstance](#)()**: Volta\Component\Registry\Container
- public static function **[item](#)(string id, mixed default=NULL)**: mixed
- public static function **[setInstance](#)(?Volta\Component\Registry\Container container)**: void\
&rdsh; *//public static function setInstance((ContainerInterface&ArrayAccess)|null $container = null): void PHP 8.2*
- public static function **[unsetInstance](#)()**: void
- public function **[get](#)(string id)**: mixed
- public function **[has](#)(string id)**: bool
- public function **[offsetExists](#)(mixed offset)**: bool
- public function **[offsetGet](#)(mixed offset)**: mixed
- public function **[offsetSet](#)(mixed offset, mixed value)**: void
- public function **[offsetUnset](#)(mixed offset)**: void
- public function **[set](#)(string id, mixed entry)**: Psr\Container\ContainerInterface
- public function **[unset](#)(string id)**: Psr\Container\ContainerInterface
### [Volta\Component\Registry\Exception](#) : Exception *implements* Stringable, Throwable, Psr\Container\ContainerExceptionInterface
### [Volta\Component\Registry\NotFoundException](#) : Exception *implements* Stringable, Throwable, Psr\Container\NotFoundExceptionInterface, Psr\Container\ContainerExceptionInterface

[//]: # (End Volta\UmlDoc\MdDiagram)
