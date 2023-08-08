<?php

namespace App\Resolvers;

use App\Models\PaymentPlatform;

class PaymentPlatformResolver
{

    protected $paymentPlatforms;

    public function __construct()
    {
        $this->paymentPlatforms = PaymentPlatform::all();
    }

    public function resolveService($paymentPlatformId)
    {
        $name = strtolower($this->paymentPlatforms->firstWhere('id', $paymentPlatformId)->name);
        // $name = strtolower($this->paymentPlatforms);

        $service = config("services.{$name}.class");


        if ($service) {
            return resolve($service);
        }

        throw new \Exception(__('The selected platform is not in the configuration'));
    }
}
