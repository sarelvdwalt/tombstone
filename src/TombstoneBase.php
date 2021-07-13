<?php

namespace SarelvdWalt\Tombstone;

abstract class TombstoneBase
{
    private static Tombstone $singleton;

    protected array $records;

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

    public function record($uniqueIdentifier)
    {
        $timer = -microtime(true);
        if (!array_key_exists($uniqueIdentifier, $this->records)) {
            $trace = debug_backtrace(false, 1);

            $this->records[$uniqueIdentifier] = [
                'c' => 0,
                'first_seen' => microtime(true),
                'time_taken' => 0,
                'trace_file' => $trace[0]['file'],
                'trace_line' => $trace[0]['line'],
            ];
        }
        $timer += microtime(true);

        $this->records[$uniqueIdentifier]['c']++;
        $this->records[$uniqueIdentifier]['time_taken'] += $timer;
    }

    abstract public function shutdown();
}