<?php

namespace Masterix21\GreenPass\Entities\Certificates;

use Carbon\Carbon;
use Masterix21\GreenPass\Entities\Certificates\Concerns\CertificateType;
use Masterix21\GreenPass\Entities\DiseaseAgents\DiseaseAgent;

class RecoveryStatement extends CertificateType
{
    /**
     * The date of the holder's first positive NAAT test result.
     *
     * @var Carbon|null
     */
    public $date;

    /**
     * The first date on which the certificate is considered to be valid.
     *
     * @var Carbon|null
     */
    public $validFrom;

    /**
     * The last date on which the certificate is considered to be valid,
     * assigned by the certificate issuer.
     *
     * @var Carbon|null
     */
    public $validUntil;

    public function __construct(array $data)
    {
        $this->id = $data['r'][0]['ci'] ?? null;

        $this->diseaseAgent = DiseaseAgent::resolveById($data['r'][0]['tg']);

        $this->country = $data['r'][0]['co'] ?? null;
        $this->issuer = $data['r'][0]['is'] ?? null;

        $this->date = !empty($data['r'][0]['fr']) ? Carbon::parse($data['r'][0]['fr']) : null;
        $this->validFrom = !empty($data['r'][0]['df']) ? Carbon::parse($data['r'][0]['df']) : null;
        $this->validUntil = !empty($data['r'][0]['du']) ? Carbon::parse($data['r'][0]['du']) : null;
    }
}
