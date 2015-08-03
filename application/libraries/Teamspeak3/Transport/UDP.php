<?php

/**
 * @file
 * Teamspeak 3 PHP Framework
 *
 * $Id: UDP.php 10/11/2013 11:35:22 scp@orilla $
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
 * @class Teamspeak3_Transport_UDP
 * @brief Class for connecting to a remote server through UDP.
 */
class Teamspeak3_Transport_UDP extends Teamspeak3_Transport_Abstract
{
  /**
   * Connects to a remote server.
   *
   * @throws Teamspeak3_Transport_Exception
   * @return void
   */
  public function connect()
  {
    if($this->stream !== null) return;

    $host = strval($this->config["host"]);
    $port = strval($this->config["port"]);

    $address = "udp://" . $host . ":" . $port;
    $timeout = intval($this->config["timeout"]);

    $this->stream = @stream_socket_client($address, $errno, $errstr, $timeout);

    if($this->stream === FALSE)
    {
      throw new Teamspeak3_Transport_Exception(Teamspeak3_Helper_String::factory($errstr)->toUtf8()->toString(), $errno);
    }

    @stream_set_timeout($this->stream, $timeout);
    @stream_set_blocking($this->stream, $this->config["blocking"] ? 1 : 0);
  }

  /**
   * Disconnects from a remote server.
   *
   * @return void
   */
  public function disconnect()
  {
    if($this->stream === null) return;

    $this->stream = null;

    Teamspeak3_Helper_Signal::getInstance()->emit(strtolower($this->getAdapterType()) . "Disconnected");
  }

  /**
   * Reads data from the stream.
   *
   * @param  integer $length
   * @throws Teamspeak3_Transport_Exception
   * @return Teamspeak3_Helper_String
   */
  public function read($length = 4096)
  {
    $this->connect();
    $this->waitForReadyRead();

    $data = @fread($this->stream, $length);

    Teamspeak3_Helper_Signal::getInstance()->emit(strtolower($this->getAdapterType()) . "DataRead", $data);

    if($data === FALSE)
    {
      throw new Teamspeak3_Transport_Exception("connection to server '" . $this->config["host"] . ":" . $this->config["port"] . "' lost");
    }

    return new Teamspeak3_Helper_String($data);
  }

  /**
   * Writes data to the stream.
   *
   * @param  string $data
   * @return void
   */
  public function send($data)
  {
    $this->connect();

    @stream_socket_sendto($this->stream, $data);

    Teamspeak3_Helper_Signal::getInstance()->emit(strtolower($this->getAdapterType()) . "DataSend", $data);
  }
}
