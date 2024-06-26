<?php
/**
 * This code is free software; you can redistribute it and/or modify it under
 * the terms of the new BSD License.
 *
 * Copyright (c) 2008-2015, Sebastian Staudt
 *
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

namespace Synida\SteamCondenser\Servers\Packets;

use Synida\SteamCondenser\Exceptions\PacketFormatException;

/**
 * This class represents a S2A_RULES response sent by a game server
 *
 * It is used to transfer a list of server rules (a.k.a. CVARs) with their
 * active values.
 *
 * @author Sebastian Staudt
 * @package steam-condenser
 * @subpackage packets
 * @see GameServer::updateRulesInfo()
 */
class S2ARULESPacket extends SteamPacket {

    /**
     * @var array
     */
    private $rulesArray;

    /**
     * Creates a new S2A_RULES response object based on the given data
     *
     * @param string $contentData The raw packet data sent by the server
     * @throws PacketFormatException if the packet data is missing
     */
    public function __construct($contentData) {
        if (empty($contentData)) {
            throw new PacketFormatException('Wrong formatted S2A_RULES packet.');
        }
        parent::__construct(SteamPacket::S2A_RULES_HEADER, $contentData);

        $rulesCount = $this->contentData->getShort();
        $this->rulesArray = [];

        for($x = 0; $x < $rulesCount; $x++) {
            $rule  = $this->contentData->getString();
            $value = $this->contentData->getString();

            if(empty($rule)) {
                break;
            }

            $this->rulesArray[$rule] = $value;
        }
    }

    /**
     * Returns the list of server rules (a.k.a. CVars) with the current values
     *
     * @return array A list of server rules
     */
    public function getRulesArray() {
        return $this->rulesArray;
    }
}
