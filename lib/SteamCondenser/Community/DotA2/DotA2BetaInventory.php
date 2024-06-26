<?php
/**
 * This code is free software; you can redistribute it and/or modify it under
 * the terms of the new BSD License.
 *
 * Copyright (c) 2012-2014, Sebastian Staudt
 *
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

namespace Synida\SteamCondenser\Community\DotA2;

use Synida\SteamCondenser\Community\GameInventory;

/**
 * Represents the inventory of a player of the DotA 2 beta
 *
 * @author     Sebastian Staudt
 * @package    steam-condenser
 * @subpackage community
 */
class DotA2BetaInventory extends GameInventory {

    const APP_ID = 205790;

    const ITEM_CLASS = 'DotA2Item';

    /**
     * This checks the cache for an existing inventory. If it exists it is
     * returned. Otherwise a new inventory is created.
     *
     * @param string $steamId The 64bit Steam ID or vanity URL of the user
     * @param bool $fetchNow Whether the data should be fetched now
     * @param bool $bypassCache Whether the cache should be bypassed
     * @return DotA2BetaInventory The inventory created from the given options
     */
    public static function createInventory($steamId, $fetchNow = true, $bypassCache = false) {
        return parent::create(self::APP_ID, $steamId, $fetchNow, $bypassCache);
    }

}
