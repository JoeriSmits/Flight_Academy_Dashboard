<?php

/**
 * @file
 * Teamspeak 3 PHP Framework
 *
 * $Id: Blacklist.php 10/11/2013 11:35:21 scp@orilla $
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
 * @class Teamspeak3_Adapter_Blacklist
 * @brief Provides methods to check if an IP address is currently blacklisted.
 */
class Teamspeak3_Adapter_Blacklist extends Teamspeak3_Adapter_Abstract
{
  /**
   * The IPv4 address or FQDN of the Teamspeak Systems update server.
   *
   * @var string
   */
  protected $default_host = "blacklist.teamspeak.com";

  /**
   * The UDP port number of the Teamspeak Systems update server.
   *
   * @var integer
   */
  protected $default_port = 17385;

  /**
   * Stores an array containing the latest build numbers.
   *
   * @var array
   */
  protected $build_numbers = null;

  /**
   * Connects the Teamspeak3_Transport_Abstract object and performs initial actions on the remote
   * server.
   *
   * @return void
   */
  public function syn()
  {
    if(!isset($this->options["host"]) || empty($this->options["host"])) $this->options["host"] = $this->default_host;
    if(!isset($this->options["port"]) || empty($this->options["port"])) $this->options["port"] = $this->default_port;

    $this->initTransport($this->options, "Teamspeak3_Transport_UDP");
    $this->transport->setAdapter($this);

    Teamspeak3_Helper_Profiler::init(spl_object_hash($this));

    Teamspeak3_Helper_Signal::getInstance()->emit("blacklistConnected", $this);
  }

  /**
   * The Teamspeak3_Adapter_Blacklist destructor.
   *
   * @return void
   */
  public function __destruct()
  {
    if($this->getTransport() instanceof Teamspeak3_Transport_Abstract && $this->getTransport()->isConnected())
    {
      $this->getTransport()->disconnect();
    }
  }

  /**
   * Returns TRUE if a specified $host IP address is currently blacklisted.
   *
   * @param  string $host
   * @throws Teamspeak3_Adapter_Blacklist_Exception
   * @return boolean
   */
  public function isBlacklisted($host)
  {
    if(ip2long($host) === FALSE)
    {
      $addr = gethostbyname($host);

      if($addr == $host)
      {
        throw new Teamspeak3_Adapter_Blacklist_Exception("unable to resolve IPv4 address (" . $host . ")");
      }

      $host = $addr;
    }

    $this->getTransport()->send("ip4:" . $host);
    $repl = $this->getTransport()->read(1);
    $this->getTransport()->disconnect();

    if(!count($repl))
    {
      return FALSE;
    }

    return ($repl->toInt()) ? FALSE : TRUE;
  }
}
