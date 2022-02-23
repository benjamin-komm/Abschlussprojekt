<?php declare(strict_types = 1);

namespace core;

class ProjectConfig {

    private array $rawData;

    /**
     * Set raw config data
     * @param array $rawData
     */
    public function __construct(array $rawData) {
        $this->rawData = $rawData;
    }

    /**
     * Get raw config data
     * @return array
     */
    public function getRawData(): array {
        return $this->rawData;
    }

    /**
     * Check if a key exists in a config section
     * @param string $section
     * @param string $key
     * @return bool
     */
    public function hasKey(string $section, string $key): bool {
        return isset($this->rawData[$section][$key]);
    }

    /**
     * Get a specific config value
     * @param string $section
     * @param string $key
     * @return string
     */
    public function get(string $section, string $key): string {
        return $this->rawData[$section][$key];
    }

}