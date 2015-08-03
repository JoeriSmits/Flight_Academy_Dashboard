<?php

/**
 * @file
 * Teamspeak 3 PHP Framework
 *
 * $Id: Interface.php 10/11/2013 11:35:21 scp@orilla $
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
 * @class Teamspeak3_Helper_Signal_Interface
 * @brief Interface class describing the layout for Teamspeak3_Helper_Signal callbacks.
 */
interface Teamspeak3_Helper_Signal_Interface
{
  /**
   * Possible callback for '<adapter>Connected' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("serverqueryConnected", array($object, "onConnect"));
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("filetransferConnected", array($object, "onConnect"));
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("blacklistConnected", array($object, "onConnect"));
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("updateConnected", array($object, "onConnect"));
   *
   * @param  Teamspeak3_Adapter_Abstract $adapter
   * @return void
   */
  public function onConnect(Teamspeak3_Adapter_Abstract $adapter);

  /**
   * Possible callback for '<adapter>Disconnected' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("serverqueryDisconnected", array($object, "onDisconnect"));
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("filetransferDisconnected", array($object, "onDisconnect"));
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("blacklistDisconnected", array($object, "onDisconnect"));
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("updateDisconnected", array($object, "onDisconnect"));
   *
   * @return void
   */
  public function onDisconnect();

  /**
   * Possible callback for 'serverqueryCommandStarted' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("serverqueryCommandStarted", array($object, "onCommandStarted"));
   *
   * @param  string $cmd
   * @return void
   */
  public function onCommandStarted($cmd);

  /**
   * Possible callback for 'serverqueryCommandFinished' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("serverqueryCommandFinished", array($object, "onCommandFinished"));
   *
   * @param  string $cmd
   * @param  Teamspeak3_Adapter_ServerQuery_Reply $reply
   * @return void
   */
  public function onCommandFinished($cmd, Teamspeak3_Adapter_ServerQuery_Reply $reply);

  /**
   * Possible callback for 'notifyEvent' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("notifyEvent", array($object, "onEvent"));
   *
   * @param  Teamspeak3_Adapter_ServerQuery_Event $event
   * @param  Teamspeak3_Node_Host $host
   * @return void
   */
  public function onEvent(Teamspeak3_Adapter_ServerQuery_Event $event, Teamspeak3_Node_Host $host);

  /**
   * Possible callback for 'notifyError' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("notifyError", array($object, "onError"));
   *
   * @param  Teamspeak3_Adapter_ServerQuery_Reply $reply
   * @return void
   */
  public function onError(Teamspeak3_Adapter_ServerQuery_Reply $reply);

  /**
   * Possible callback for 'notifyServerselected' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("notifyServerselected", array($object, "onServerselected"));
   *
   * @param  Teamspeak3_Node_Host $host
   * @return void
   */
  public function onServerselected(Teamspeak3_Node_Host $host);

  /**
   * Possible callback for 'notifyServercreated' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("notifyServercreated", array($object, "onServercreated"));
   *
   * @param  Teamspeak3_Node_Host $host
   * @param  integer $sid
   * @return void
   */
  public function onServercreated(Teamspeak3_Node_Host $host, $sid);

  /**
   * Possible callback for 'notifyServerdeleted' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("notifyServerdeleted", array($object, "onServerdeleted"));
   *
   * @param  Teamspeak3_Node_Host $host
   * @param  integer $sid
   * @return void
   */
  public function onServerdeleted(Teamspeak3_Node_Host $host, $sid);

  /**
   * Possible callback for 'notifyServerstarted' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("notifyServerstarted", array($object, "onServerstarted"));
   *
   * @param  Teamspeak3_Node_Host $host
   * @param  integer $sid
   * @return void
   */
  public function onServerstarted(Teamspeak3_Node_Host $host, $sid);

  /**
   * Possible callback for 'notifyServerstopped' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("notifyServerstopped", array($object, "onServerstopped"));
   *
   * @param  Teamspeak3_Node_Host $host
   * @param  integer $sid
   * @return void
   */
  public function onServerstopped(Teamspeak3_Node_Host $host, $sid);

  /**
   * Possible callback for 'notifyServershutdown' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("notifyServershutdown", array($object, "onServershutdown"));
   *
   * @param  Teamspeak3_Node_Host $host
   * @return void
   */
  public function onServershutdown(Teamspeak3_Node_Host $host);

  /**
   * Possible callback for 'notifyLogin' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("notifyLogin", array($object, "onLogin"));
   *
   * @param  Teamspeak3_Node_Host $host
   * @return void
   */
  public function onLogin(Teamspeak3_Node_Host $host);

  /**
   * Possible callback for 'notifyLogout' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("notifyLogout", array($object, "onLogout"));
   *
   * @param  Teamspeak3_Node_Host $host
   * @return void
   */
  public function onLogout(Teamspeak3_Node_Host $host);

  /**
   * Possible callback for 'notifyTokencreated' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("notifyTokencreated", array($object, "onTokencreated"));
   *
   * @param  Teamspeak3_Node_Server $server
   * @param  string $token
   * @return void
   */
  public function onTokencreated(Teamspeak3_Node_Server $server, $token);

  /**
   * Possible callback for 'filetransferHandshake' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("filetransferHandshake", array($object, "onFtHandshake"));
   *
   * @param  Teamspeak3_Adapter_FileTransfer $adapter
   * @return void
   */
  public function onFtHandshake(Teamspeak3_Adapter_FileTransfer $adapter);

  /**
   * Possible callback for 'filetransferUploadStarted' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("filetransferUploadStarted", array($object, "onFtUploadStarted"));
   *
   * @param  string  $ftkey
   * @param  integer $seek
   * @param  integer $size
   * @return void
   */
  public function onFtUploadStarted($ftkey, $seek, $size);

  /**
   * Possible callback for 'filetransferUploadProgress' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("filetransferUploadProgress", array($object, "onFtUploadProgress"));
   *
   * @param  string  $ftkey
   * @param  integer $seek
   * @param  integer $size
   * @return void
   */
  public function onFtUploadProgress($ftkey, $seek, $size);

  /**
   * Possible callback for 'filetransferUploadFinished' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("filetransferUploadFinished", array($object, "onFtUploadFinished"));
   *
   * @param  string  $ftkey
   * @param  integer $seek
   * @param  integer $size
   * @return void
   */
  public function onFtUploadFinished($ftkey, $seek, $size);

  /**
   * Possible callback for 'filetransferDownloadStarted' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("filetransferDownloadStarted", array($object, "onFtDownloadStarted"));
   *
   * @param  string  $ftkey
   * @param  integer $buff
   * @param  integer $size
   * @return void
   */
  public function onFtDownloadStarted($ftkey, $buff, $size);

  /**
   * Possible callback for 'filetransferDownloadProgress' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("filetransferDownloadProgress", array($object, "onFtDownloadProgress"));
   *
   * @param  string  $ftkey
   * @param  integer $buff
   * @param  integer $size
   * @return void
   */
  public function onFtDownloadProgress($ftkey, $buff, $size);

  /**
   * Possible callback for 'filetransferDownloadFinished' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("filetransferDownloadFinished", array($object, "onFtDownloadFinished"));
   *
   * @param  string  $ftkey
   * @param  integer $buff
   * @param  integer $size
   * @return void
   */
  public function onFtDownloadFinished($ftkey, $buff, $size);

  /**
   * Possible callback for '<adapter>DataRead' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("serverqueryDataRead", array($object, "onDebugDataRead"));
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("filetransferDataRead", array($object, "onDebugDataRead"));
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("blacklistDataRead", array($object, "onDebugDataRead"));
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("updateDataRead", array($object, "onDebugDataRead"));
   *
   * @param  string $data
   * @return void
   */
  public function onDebugDataRead($data);

  /**
   * Possible callback for '<adapter>DataSend' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("serverqueryDataSend", array($object, "onDebugDataSend"));
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("filetransferDataSend", array($object, "onDebugDataSend"));
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("blacklistDataSend", array($object, "onDebugDataSend"));
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("updateDataSend", array($object, "onDebugDataSend"));
   *
   * @param  string $data
   * @return void
   */
  public function onDebugDataSend($data);

  /**
   * Possible callback for '<adapter>WaitTimeout' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("serverqueryWaitTimeout", array($object, "onWaitTimeout"));
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("filetransferWaitTimeout", array($object, "onWaitTimeout"));
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("blacklistWaitTimeout", array($object, "onWaitTimeout"));
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("updateWaitTimeout", array($object, "onWaitTimeout"));
   *
   * @param  integer $time
   * @param  Teamspeak3_Adapter_Abstract $adapter
   * @return void
   */
  public function onWaitTimeout($time, Teamspeak3_Adapter_Abstract $adapter);

  /**
   * Possible callback for 'errorException' signals.
   *
   * === Examples ===
   *   - Teamspeak3_Helper_Signal::getInstance()->subscribe("errorException", array($object, "onException"));
   *
   * @param  Teamspeak3_Exception $e
   * @return void
   */
  public function onException(Teamspeak3_Exception $e);
}
