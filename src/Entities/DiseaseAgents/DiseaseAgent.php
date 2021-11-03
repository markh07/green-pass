<?php

namespace Masterix21\GreenPass\Entities\DiseaseAgents;

use Masterix21\GreenPass\Exceptions\InvalidDiseaseAgent;

abstract class DiseaseAgent
{
    abstract public static function id(): string;

    abstract public static function display(): string;

    abstract public static function active(): bool;

    abstract public static function version(): string;

    abstract public static function system(): string;

    /**
     * Resolve the disease class by ID.
     *
     * @param string $id
     *
     * @return static
     * @throws InvalidDiseaseAgent
     */
    public static function resolveById(string $id): self
    {
        switch ($id) {
            case "840539006":
                return new Covid19();
            default:
                throw new InvalidDiseaseAgent();
        }
    }
}
