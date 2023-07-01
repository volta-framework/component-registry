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

use Psr\Container\NotFoundExceptionInterface;
use Volta\Component\Registry\Container;
use Volta\Component\Registry\Exception;
use Volta\Component\Registry\NotFoundException;

require_once __DIR__ . '/../vendor/autoload.php';

// --------------------------------------------------------------------------------------------------------------------

try{
    $c = new Container();
    $c->set('name 1', 'value 1');
    $c['name 2'] = 'value 2';
    echo $c->get('value 2');
    echo $c['value 1'];

} catch (Exception $e) {
    exit($e->getMessage());

} catch (NotFoundExceptionInterface $e) {
    exit($e->getMessage());
}

// --------------------------------------------------------------------------------------------------------------------

/**
* Exception on duplicate entry.
 *
* To avoid accidentally overwriting an entry an exception is thrown when
* an entry already exists with the same id. If we need to overwrite an entry
*/
try {
    $c['name 2'] = 'new value 2';

} catch (Exception $e) {

    exit($e->getMessage());
}

// --------------------------------------------------------------------------------------------------------------------

/**
 * Exception thrown when entry is not found
 */
try{
    echo $c['name 3'];

} catch (NotFoundException $e) {

    exit($e->getMessage());
}