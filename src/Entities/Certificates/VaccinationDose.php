<?php

namespace Masterix21\GreenPass\Entities\Certificates;

use Carbon\Carbon;
use Masterix21\GreenPass\Entities\Certificates\Concerns\CertificateType;
use Masterix21\GreenPass\Entities\DiseaseAgents\DiseaseAgent;

class VaccinationDose extends CertificateType
{
    /**
     * Type of the vaccine or prophylaxis used.
     *
     * @var string|null
     */
    public $type;

    /**
     * Medicinal product used for this specific dose of vaccination.
     *
     * @var string|null
     */
    public $product;

    /**
     * Vaccine marketing authorization holder or manufacturer
     *
     * @var string|null
     */
    public $manufacturer;

    /**
     * Sequence number (positive integer) of the dose given
     * during this vaccination event.
     *
     * @var int
     */
    public $doseGiven;

    /**
     * Total number of doses (positive integer) in a complete vaccination
     * series according to the used vaccination protocol.
     *
     * @var int
     */
    public $totalDoses;

    /**
     * The date when the described dose was received.
     *
     * @var Carbon|null
     */
    public $date;

    /**
     * The last date on which the certificate is considered to be valid,
     * assigned by the certificate issuer.
     *
     * @var Carbon|null
     */
    public $validUntil;

    public function __construct(array $data)
    {
        $this->id = $data['v'][0]['ci'] ?? null;

        $this->diseaseAgent = DiseaseAgent::resolveById($data['v'][0]['tg']);

        $this->country = $data['v'][0]['co'] ?? null;
        $this->issuer = $data['v'][0]['is'] ?? null;

        $this->type = $data['v'][0]['vp'] ?? null;
        $this->product = $data['v'][0]['mp'] ?? null;
        $this->manufacturer = $data['v'][0]['ma'] ?? null;
        $this->doseGiven = $data['v'][0]['dn'] ?? 0;
        $this->totalDoses = $data['v'][0]['sd'] ?? 0;

        $this->date = null;
        $this->validUntil = null;
        if (! empty($data['v'][0]['dt'] ?? null)) {
            $this->date = Carbon::parse($data['v'][0]['dt']);

            $this->validUntil = Carbon::parse($data['v'][0]['dt']);
            $this->validUntil->addYear();
        }
    }
}
