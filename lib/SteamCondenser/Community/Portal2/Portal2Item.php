<?php
/**
 * This code is free software; you can redistribute it and/or modify it under
 * the terms of the new BSD License.
 *
 * Copyright (c) 2011-2015, Sebastian Staudt
 *
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

namespace Synida\SteamCondenser\Community\Portal2;

use Synida\SteamCondenser\Community\GameItem;

/**
 * Represents a Portal 2 item
 *
 * @author     Sebastian Staudt
 * @package    steam-condenser
 * @subpackage community
 */
class Portal2Item extends GameItem {

    /**
     * @var array The names of the bots available in Portal 2
     */
    private static $BOTS = ['pbody', 'atlas'];

    /**
     * @var array
     */
    private $equipped;

    /**
     * Creates a new instance of a Portal2Item with the given data
     *
     * @param Portal2Inventory $inventory The inventory this item is contained
     *        in
     * @param \stdClass $itemData The data specifying this item
     * @throws \Synida\SteamCondenser\Exceptions\WebApiException on Web API errors
     */
    public function __construct(Portal2Inventory $inventory, $itemData) {
        parent::__construct($inventory, $itemData);

        $this->equipped = [];
        foreach (self::$BOTS as $botId => $botName) {
            $this->equipped[self::$BOTS[$botId]] = (($itemData->inventory & (1 << 16 + $botId)) != 0);
        }
    }

    /**
     * Returns the name for each bot this player has equipped this item
     *
     * @return array The names of the bots this player has equipped this item
     */
    public function getBotsEquipped() {
        $botsEquipped = [];
        foreach($this->equipped as $botId => $equipped) {
            if($equipped) {
                $botsEquipped[] = $botId;
            }
        }

        return $botsEquipped;
    }

    /**
     * Returns whether this item is equipped by this player at all
     *
     * @return bool Whether this item is equipped by this player at all
     */
    public function isEquipped() {
        return in_array(true, $this->equipped);
    }

}
