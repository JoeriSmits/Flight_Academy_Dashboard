<?php

/**
 * @file
 * Teamspeak 3 PHP Framework
 *
 * $Id: ServerQuery.php 10/11/2013 11:35:21 scp@orilla $
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
 * @class Teamspeak3_Adapter_ServerQuery
 * @brief Provides low-level methods for ServerQuery communication with a Teamspeak 3 Server.
 */
class Teamspeak3_Adapter_ServerQuery extends Teamspeak3_Adapter_Abstract
{
  /**
   * Stores a singleton instance of the active Teamspeak3_Node_Host object.
   *
   * @var Teamspeak3_Node_Host
   */
  protected $host = null;

  /**
   * Stores the timestamp of the last command.
   *
   * @var integer
   */
  protected $timer = null;

  /**
   * Number of queries executed on the server.
   *
   * @var integer
   */
  protected $count = 0;

  /**
   * Stores an array with unsupported commands.
   *
   * @var array
   */
  protected $block = array("help");

  /**
   * Connects the Teamspeak3_Transport_Abstract object and performs initial actions on the remote
   * server.
   *
   * @throws Teamspeak3_Adapter_Exception
   * @return void
   */
  protected function syn()
  {
    $this->initTransport($this->options);
    $this->transport->setAdapter($this);

    Teamspeak3_Helper_Profiler::init(spl_object_hash($this));

    if(!$this->getTransport()->readLine()->startsWith(Teamspeak3::READY))
    {
      throw new Teamspeak3_Adapter_Exception("invalid reply from the server");
    }

    Teamspeak3_Helper_Signal::getInstance()->emit("serverqueryConnected", $this);
  }

  /**
   * The Teamspeak3_Adapter_ServerQuery destructor.
   *
   * @return void
   */
  public function __destruct()
  {
    if($this->getTransport() instanceof Teamspeak3_Transport_Abstract && $this->transport->isConnected())
    {
      try
      {
        $this->request("quit");
      }
      catch(Exception $e)
      {
        return;
      }
    }
  }

  /**
   * Sends a prepared command to the server and returns the result.
   *
   * @param  string  $cmd
   * @param  boolean $throw
   * @throws Teamspeak3_Adapter_Exception
   * @return Teamspeak3_Adapter_ServerQuery_Reply
   */
  public function request($cmd, $throw = TRUE)
  {
    $query = Teamspeak3_Helper_String::factory($cmd)->section(Teamspeak3::SEPARATOR_CELL);

    if(strstr($cmd, "\r") || strstr($cmd, "\n"))
    {
      throw new Teamspeak3_Adapter_Exception("illegal characters in command '" . $query . "'");
    }
    elseif(in_array($query, $this->block))
    {
      throw new Teamspeak3_Adapter_ServerQuery_Exception("command not found", 0x100);
    }

    Teamspeak3_Helper_Signal::getInstance()->emit("serverqueryCommandStarted", $cmd);

    $this->getProfiler()->start();
    $this->getTransport()->sendLine($cmd);
    $this->timer = time();
    $this->count++;

    $rpl = array();

    do {
      $str = $this->getTransport()->readLine();
      $rpl[] = $str;
    } while($str instanceof Teamspeak3_Helper_String && $str->section(Teamspeak3::SEPARATOR_CELL) != Teamspeak3::ERROR);

    $this->getProfiler()->stop();

    $reply = new Teamspeak3_Adapter_ServerQuery_Reply($rpl, $cmd, $this->getHost(), $throw);

    Teamspeak3_Helper_Signal::getInstance()->emit("serverqueryCommandFinished", $cmd, $reply);

    return $reply;
  }

  /**
   * Waits for the server to send a notification message and returns the result.
   *
   * @throws Teamspeak3_Adapter_Exception
   * @return Teamspeak3_Adapter_ServerQuery_Event
   */
  public function wait()
  {
    if($this->getTransport()->getConfig("blocking"))
    {
      throw new Teamspeak3_Adapter_Exception("only available in non-blocking mode");
    }

    do {
      $evt = $this->getTransport()->readLine();
    } while($evt instanceof Teamspeak3_Helper_String && !$evt->section(Teamspeak3::SEPARATOR_CELL)->startsWith(Teamspeak3::EVENT));

    return new Teamspeak3_Adapter_ServerQuery_Event($evt, $this->getHost());
  }

  /**
   * Uses given parameters and returns a prepared ServerQuery command.
   *
   * @param  string $cmd
   * @param  array  $params
   * @return string
   */
  public function prepare($cmd, array $params = array())
  {
    $args = array();
    $cells = array();

    foreach($params as $ident => $value)
    {
      $ident = is_numeric($ident) ? "" : strtolower($ident) . Teamspeak3::SEPARATOR_PAIR;

      if(is_array($value))
      {
        $value = array_values($value);

        for($i = 0; $i < count($value); $i++)
        {
          if($value[$i] === null) continue;
          elseif($value[$i] === FALSE) $value[$i] = 0x00;
          elseif($value[$i] === TRUE) $value[$i] = 0x01;
          elseif($value[$i] instanceof Teamspeak3_Node_Abstract) $value[$i] = $value[$i]->getId();

          $cells[$i][] = $ident . Teamspeak3_Helper_String::factory($value[$i])->escape()->toUtf8();
        }
      }
      else
      {
        if($value === null) continue;
        elseif($value === FALSE) $value = 0x00;
        elseif($value === TRUE) $value = 0x01;
        elseif($value instanceof Teamspeak3_Node_Abstract) $value = $value->getId();

        $args[] = $ident . Teamspeak3_Helper_String::factory($value)->escape()->toUtf8();
      }
    }

    foreach(array_keys($cells) as $ident) $cells[$ident] = implode(Teamspeak3::SEPARATOR_CELL, $cells[$ident]);

    if(count($args)) $cmd .= " " . implode(Teamspeak3::SEPARATOR_CELL, $args);
    if(count($cells)) $cmd .= " " . implode(Teamspeak3::SEPARATOR_LIST, $cells);

    return trim($cmd);
  }

  /**
   * Returns the timestamp of the last command.
   *
   * @return integer
   */
  public function getQueryLastTimestamp()
  {
    return $this->timer;
  }

  /**
   * Returns the number of queries executed on the server.
   *
   * @return integer
   */
  public function getQueryCount()
  {
    return $this->count;
  }

  /**
   * Returns the total runtime of all queries.
   *
   * @return mixed
   */
  public function getQueryRuntime()
  {
    return $this->getProfiler()->getRuntime();
  }

  /**
   * Returns the Teamspeak3_Node_Host object of the current connection.
   *
   * @return Teamspeak3_Node_Host
   */
  public function getHost()
  {
    if($this->host === null)
    {
      $this->host = new Teamspeak3_Node_Host($this);
    }

    return $this->host;
  }
}
