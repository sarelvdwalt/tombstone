<?php

namespace SarelvdWalt\Tombstone;

abstract class TombstoneBase
{
    private static Tombstone $singleton;

    /**
     * Tombstone constructor: Deliberately made protected to avoid misuse.
     */
    protected function __construct()
    {
    }

    /** Avoid cloning (only use singleton to instantiate) */
    protected function __clone()
    {
    }

    /**
     * @return Tombstone
     */
    public static function getInstance(): Tombstone
    {
        if (!isset(self::$singleton)) {
            self::$singleton = new static();
            register_shutdown_function([self::$singleton, 'shutdown']);
        }

        return self::$singleton;
    }

}