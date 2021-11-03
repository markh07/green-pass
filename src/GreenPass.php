<?php

namespace Masterix21\GreenPass;

use Masterix21\GreenPass\Entities\Certificates\Concerns\CertificateType;
use Masterix21\GreenPass\Entities\Certificates\RecoveryStatement;
use Masterix21\GreenPass\Entities\Certificates\TestResult;
use Masterix21\GreenPass\Entities\Certificates\VaccinationDose;
use Masterix21\GreenPass\Entities\Holder;

class GreenPass
{
    /**
     * Schema version
     *
     * @var string|mixed|null
     */
    public $version;

    /**
     * The person who holds the certificate.
     *
     * @var Holder
     */
    public $holder;

    /**
     * Certificate issued.
     *
     * @var CertificateType
     */
    public $certificate;

    public function __construct(array $data)
    {
        $this->version = $data['ver'] ?? null;

        $this->holder = new Holder($data);

        if (array_key_exists('v', $data)) {
            $this->certificate = new VaccinationDose($data);
        }

        if (array_key_exists('t', $data)) {
            $this->certificate = new TestResult($data);
        }

        if (array_key_exists('r', $data)) {
            $this->certificate = new RecoveryStatement($data);
        }
    }
}
