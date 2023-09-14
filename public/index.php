<?php
/*
 * This file is part of the Volta package.
 *
 * (c) Rob Demmenie <rob@volta-framework.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

use Volta\Component\Registry\Container;

require_once __DIR__ . '/../vendor/autoload.php';

ini_set('html_errors', false);
header('Content-Type: text/plain');

// --------------------------------------------------------------------------------------------------------------------

try{
    $c = new Container();
    $c->set('name 1', 'value 1');
    $c['name 2'] = 'value 2';
    echo $c->get('value 2');
    echo $c['value 1'];

} catch (ContainerExceptionInterface|NotFoundExceptionInterface $e) {
    print_r($e);
    exit(1);
}

// --------------------------------------------------------------------------------------------------------------------

/**
* Exception on duplicate entry.
 *
* To avoid accidentally overwriting an entry, an exception is thrown when
* an entry already exists with the same id. If we need to overwrite an entry
*/
try {
    $c['name 2'] = 'new value 2';
    $c->set('name 2',  'new value 2');

} catch (ContainerExceptionInterface $e) {
    print_r($e);
    exit(1);
}

// --------------------------------------------------------------------------------------------------------------------

/**
 * Exception thrown when entry is not found
 */
try{
    echo $c->get('name 3');
    echo $c->entry('name 3');
    echo $c['name 3'];

} catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
    print_r($e);
    exit(1);
}