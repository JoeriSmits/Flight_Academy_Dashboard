<?php

/**
 * @file
 * Teamspeak 3 PHP Framework
 *
 * $Id: FileTransfer.php 10/11/2013 11:35:21 scp@orilla $
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
 * @class Teamspeak3_Adapter_FileTransfer
 * @brief Provides low-level methods for file transfer communication with a Teamspeak 3 Server.
 */
class Teamspeak3_Adapter_FileTransfer extends Teamspeak3_Adapter_Abstract
{
  /**
   * Connects the Teamspeak3_Transport_Abstract object and performs initial actions on the remote
   * server.
   *
   * @throws Teamspeak3_Adapter_Exception
   * @return void
   */
  public function syn()
  {
    $this->initTransport($this->options);
    $this->transport->setAdapter($this);

    Teamspeak3_Helper_Profiler::init(spl_object_hash($this));

    Teamspeak3_Helper_Signal::getInstance()->emit("filetransferConnected", $this);
  }

  /**
   * The Teamspeak3_Adapter_FileTransfer destructor.
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
   * Sends a valid file transfer key to the server to initialize the file transfer.
   *
   * @param  string $ftkey
   * @throws Teamspeak3_Adapter_FileTransfer_Exception
   * @return void
   */
  protected function init($ftkey)
  {
    if(strlen($ftkey) != 32)
    {
      throw new Teamspeak3_Adapter_FileTransfer_Exception("invalid file transfer key format");
    }

    $this->getProfiler()->start();
    $this->getTransport()->send($ftkey);

    Teamspeak3_Helper_Signal::getInstance()->emit("filetransferHandshake", $this);
  }

  /**
   * Sends the content of a file to the server.
   *
   * @param  string  $ftkey
   * @param  integer $seek
   * @param  string  $data
   * @throws Teamspeak3_Adapter_FileTransfer_Exception
   * @return void
   */
  public function upload($ftkey, $seek, $data)
  {
    $this->init($ftkey);

    $size = strlen($data);
    $seek = intval($seek);
    $pack = 4096;

    Teamspeak3_Helper_Signal::getInstance()->emit("filetransferUploadStarted", $ftkey, $seek, $size);

    for(;$seek < $size;)
    {
      $rest = $size-$seek;
      $pack = $rest < $pack ? $rest : $pack;
      $buff = substr($data, $seek, $pack);
      $seek = $seek+$pack;

      $this->getTransport()->send($buff);

      Teamspeak3_Helper_Signal::getInstance()->emit("filetransferUploadProgress", $ftkey, $seek, $size);
    }

    $this->getProfiler()->stop();

    Teamspeak3_Helper_Signal::getInstance()->emit("filetransferUploadFinished", $ftkey, $seek, $size);

    if($seek < $size)
    {
      throw new Teamspeak3_Adapter_FileTransfer_Exception("incomplete file upload (" . $seek . " of " . $size . " bytes)");
    }
  }

  /**
   * Returns the content of a downloaded file as a Teamspeak3_Helper_String object.
   *
   * @param  string  $ftkey
   * @param  integer $size
   * @param  boolean $passthru
   * @throws Teamspeak3_Adapter_FileTransfer_Exception
   * @return Teamspeak3_Helper_String
   */
  public function download($ftkey, $size, $passthru = FALSE)
  {
    $this->init($ftkey);

    if($passthru)
    {
      return $this->passthru($size);
    }

    $buff = new Teamspeak3_Helper_String("");
    $size = intval($size);
    $pack = 4096;

    Teamspeak3_Helper_Signal::getInstance()->emit("filetransferDownloadStarted", $ftkey, count($buff), $size);

    for($seek = 0;$seek < $size;)
    {
      $rest = $size-$seek;
      $pack = $rest < $pack ? $rest : $pack;
      $data = $this->getTransport()->read($rest < $pack ? $rest : $pack);
      $seek = $seek+$pack;

      $buff->append($data);

      Teamspeak3_Helper_Signal::getInstance()->emit("filetransferDownloadProgress", $ftkey, count($buff), $size);
    }

    $this->getProfiler()->stop();

    Teamspeak3_Helper_Signal::getInstance()->emit("filetransferDownloadFinished", $ftkey, count($buff), $size);

    if(strlen($buff) != $size)
    {
      throw new Teamspeak3_Adapter_FileTransfer_Exception("incomplete file download (" . count($buff) . " of " . $size . " bytes)");
    }

    return $buff;
  }

  /**
   * Outputs all remaining data on a Teamspeak 3 file transfer stream using PHP's fpassthru()
   * function.
   *
   * @param  integer $size
   * @throws Teamspeak3_Adapter_FileTransfer_Exception
   * @return void
   */
  protected function passthru($size)
  {
    $buff_size = fpassthru($this->getTransport()->getStream());

    if($buff_size != $size)
    {
      throw new Teamspeak3_Adapter_FileTransfer_Exception("incomplete file download (" . intval($buff_size) . " of " . $size . " bytes)");
    }
  }
}
