<?php

/**
 * @file
 * Teamspeak 3 PHP Framework
 *
 * $Id: Event.php 10/11/2013 11:35:21 scp@orilla $
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
 * @class Teamspeak3_Adapter_ServerQuery_Event
 * @brief Provides methods to analyze and format a ServerQuery event.
 */
class Teamspeak3_Adapter_ServerQuery_Event implements ArrayAccess
{
  /**
   * Stores the event type.
   *
   * @var Teamspeak3_Helper_String
   */
  protected $type = null;

  /**
   * Stores the event data.
   *
   * @var array
   */
  protected $data = null;

  /**
   * Stores the event data as an unparsed string.
   *
   * @var Teamspeak3_Helper_String
   */
  protected $mesg = null;

  /**
   * Creates a new Teamspeak3_Adapter_ServerQuery_Event object.
   *
   * @param  Teamspeak3_Helper_String $evt
   * @param  Teamspeak3_Node_Host     $con
   * @throws Teamspeak3_Adapter_Exception
   * @return Teamspeak3_Adapter_ServerQuery_Event
   */
  public function __construct(Teamspeak3_Helper_String $evt, Teamspeak3_Node_Host $con = null)
  {
    if(!$evt->startsWith(Teamspeak3::EVENT))
    {
      throw new Teamspeak3_Adapter_Exception("invalid notification event format");
    }

    list($type, $data) = $evt->split(Teamspeak3::SEPARATOR_CELL, 2);

    if(empty($data))
    {
      throw new Teamspeak3_Adapter_Exception("invalid notification event data");
    }

    $fake = new Teamspeak3_Helper_String(Teamspeak3::ERROR . Teamspeak3::SEPARATOR_CELL . "id" . Teamspeak3::SEPARATOR_PAIR . 0 . Teamspeak3::SEPARATOR_CELL . "msg" . Teamspeak3::SEPARATOR_PAIR . "ok");
    $repl = new Teamspeak3_Adapter_ServerQuery_Reply(array($data, $fake), $type);

    $this->type = $type->substr(strlen(Teamspeak3::EVENT));
    $this->data = $repl->toList();
    $this->mesg = $data;

    Teamspeak3_Helper_Signal::getInstance()->emit("notifyEvent", $this, $con);
    Teamspeak3_Helper_Signal::getInstance()->emit("notify" . ucfirst($this->type), $this, $con);
  }

  /**
   * Returns the event type string.
   *
   * @return Teamspeak3_Helper_String
   */
  public function getType()
  {
    return $this->type;
  }

  /**
   * Returns the event data array.
   *
   * @return array
   */
  public function getData()
  {
    return $this->data;
  }

  /**
   * Returns the event data as an unparsed string.
   *
   * @return Teamspeak3_Helper_String
   */
  public function getMessage()
  {
    return $this->mesg;
  }

  /**
   * @ignore
   */
  public function offsetExists($offset)
  {
    return array_key_exists($offset, $this->data) ? TRUE : FALSE;
  }

  /**
   * @ignore
   */
  public function offsetGet($offset)
  {
    if(!$this->offsetExists($offset))
    {
      throw new Teamspeak3_Adapter_ServerQuery_Exception("invalid parameter", 0x602);
    }

    return $this->data[$offset];
  }

  /**
   * @ignore
   */
  public function offsetSet($offset, $value)
  {
    throw new Teamspeak3_Node_Exception("event '" . $this->getType() . "' is read only");
  }

  /**
   * @ignore
   */
  public function offsetUnset($offset)
  {
    unset($this->data[$offset]);
  }

  /**
   * @ignore
   */
  public function __get($offset)
  {
    return $this->offsetGet($offset);
  }

  /**
   * @ignore
   */
  public function __set($offset, $value)
  {
    $this->offsetSet($offset, $value);
  }
}
