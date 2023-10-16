<?php
/*
 * This file is part of the Volta package.
 *
 * (c) Rob Demmenie <rob@volta-server-framework.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Volta\Component\Registry;

use  Psr\Container\NotFoundExceptionInterface;

/**
 * As described in the specifications, Exceptions must implement the NotFoundExceptionInterface
 */
class NotFoundException extends \Exception implements NotFoundExceptionInterface
{

}