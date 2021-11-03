<?php

namespace Masterix21\GreenPass\Entities;

use Carbon\Carbon;

class Holder
{
    /**
     * @var string|null
     */
    public $surname = null;

    /**
     * @var string|null
     */
    public $standardisedSurname;

    /**
     * @var string|null
     */
    public $forename;

    /**
     * @var string|null
     */
    public $standardisedForename;

    /**
     * @var Carbon|null
     */
    public $dateOfBirth;

    public function __construct(array $data)
    {
        $this->dateOfBirth = !empty($data['dob'] ?? null) ? Carbon::parse($data['dob']) : null;

        $this->surname = $data['nam']['fn'] ?? null;
        $this->standardisedSurname = $data['nam']['fnt'] ?? null;
        $this->forename = $data['nam']['gn'] ?? null;
        $this->standardisedForename = $data['nam']['gnt'] ?? null;
    }
}
