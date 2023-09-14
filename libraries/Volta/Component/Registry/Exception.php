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

namespace Volta\Component\Registry;

use  Psr\Container\ContainerExceptionInterface;

/**
 * As described in the specifications, Exceptions must implement the ContainerExceptionInterface
 */
class Exception extends \Exception implements ContainerExceptionInterface
{

}