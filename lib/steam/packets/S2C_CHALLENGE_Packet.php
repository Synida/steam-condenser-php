<?php
/**
 * @author Sebastian Staudt
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package Steam Condenser (PHP)
 * @subpackage Packets
 * @version $Id$
 */

require_once "steam/packets/SteamPacket.php";

/**
 * @package Steam Condenser (PHP)
 * @subpackage Packets
 */
class S2C_CHALLENGE_Packet extends SteamPacket
{
  /**
   * @param long $challengeNumber
   */
  public function __construct($challengeNumber)
  {
    parent::__construct(SteamPacket::S2C_CHALLENGE_HEADER, $challengeNumber);
  }

  /**
   * @return int
   */
  public function getChallengeNumber()
  {
    return $this->contentData->rewind()->getLong();
  }
}
?>