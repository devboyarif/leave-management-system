<?php

namespace App\Traits;

trait HasSubscription
{
    public function checkEmployeesLimitation()
    {
        $features = getCurrentSubscriptionFeatures();

        if ($features->is_limited_user) {
            $total_employees =  currentCompany()->employees->count();

            if ($total_employees >= $features->max_employees) {
                return true;
            }
        }

        return false;
    }
}
