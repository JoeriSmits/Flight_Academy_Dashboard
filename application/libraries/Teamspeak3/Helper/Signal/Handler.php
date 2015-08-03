<?php

/**
 * @file
 * Teamspeak 3 PHP Framework
 *
 * $Id: Handler.php 10/11/2013 11:35:21 scp@orilla $
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package   Teamspeak3
 * @version   1.1.23
 * @author    Sven 'ScP' Paulsen
 * @copyright Copyright (c) 2010 by Planet Teamspeak. All rights reserved.
 */

/**
 * @class Teamspeak3_Helper_Signal_Handler
 * @brief Helper class providing handler functions for signals.
 */
class Teamspeak3_Helper_Signal_Handler
{
  /**
   * Stores the name of the subscribed signal.
   *
   * @var string
   */
  protected $signal = null;

  /**
   * Stores the callback function for the subscribed signal.
   *
   * @var mixed
   */
  protected $callback = null;

  /**
   * The Teamspeak3_Helper_Signal_Handler constructor.
   *
   * @param  string $signal
   * @param  mixed  $callback
   * @throws Teamspeak3_Helper_Signal_Exception
   * @return Teamspeak3_Helper_Signal_Handler
   */
  public function __construct($signal, $callback)
  {
    $this->signal = (string) $signal;

    if(!is_callable($callback))
    {
      throw new Teamspeak3_Helper_Signal_Exception("invalid callback specified for signal '" . $signal . "'");
    }

    $this->callback = $callback;
  }

  /**
   * Invoke the signal handler.
   *
   * @param  array $args
   * @return mixed
   */
  public function call(array $args = array())
  {
    return call_user_func_array($this->callback, $args);
  }
}
