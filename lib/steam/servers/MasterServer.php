<?php
/**
 * This code is free software; you can redistribute it and/or modify it under
 * the terms of the new BSD License.
 *
 * @author Sebastian Staudt
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package Steam Condenser (PHP)
 * @subpackage SteamSocket
 * @version $Id$
 */

require_once "InetAddress.php";
require_once "steam/packets/A2M_GET_SERVERS_BATCH2_Packet.php";
require_once "steam/sockets/MasterServerSocket.php";

/**
 * @package Steam Condenser (PHP)
 * @subpackage MasterServer
 */
class MasterServer
{
  const GOLDSRC_MASTER_SERVER = "hl1master.steampowered.com:27010";
  const SOURCE_MASTER_SERVER = "hl2master.steampowered.com:27011";

  /**
   * @var MasterServerSocket
   */
  private $socket;

  public function __construct($masterServer)
  {
    $masterServer = explode(":", $masterServer);
    $this->socket = new MasterServerSocket(new InetAddress($masterServer[0]), $masterServer[1]);
  }


  public function getServers($regionCode = A2M_GET_SERVERS_BATCH2_Packet::REGION_ALL , $filter = "")
  {
    $finished = false;
    $portNumber = 0;
    $hostName = "0.0.0.0";

    do
    {
      $this->socket->send(new A2M_GET_SERVERS_BATCH2_Packet($regionCode, "$hostName:$portNumber", $filter));
      $serverStringArray = $this->socket->getReply()->getServers();
      	
      foreach($serverStringArray as $serverString)
      {
        $serverString = explode(":", $serverString);
        $hostName = $serverString[0];
        $portNumber = $serverString[1];

        if($hostName != "0.0.0.0" && $portNumber != 0)
        {
          $serverArray[] = array($hostName, $portNumber);
        }
        else
        {
          $finished = true;
        }
      }
    }
    while(!$finished);

    return $serverArray;
  }
}
?>
