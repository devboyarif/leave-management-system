<?php

namespace App\Traits;

trait HasSubscription
{
    public function checkEmployeesLimitation($company = null)
    {
        if ($company) {
            $features = $company->subscription->plan->planFeatures;
        }else{
            $features = getCurrentSubscriptionFeatures();
        }


        if ($features->is_limited_employee) {
            $company = $company ?? currentCompany();
            $total_employees =  $company->employees->count();

            if ($total_employees >= $features->max_employees) {
                return true;
            }
        }

        return false;
    }

    public function checkTeamLimitation($company = null)
    {
        if ($company) {
            $features = $company->subscription->plan->planFeatures;
        }else{
            $features = getCurrentSubscriptionFeatures();
            $company = currentCompany();
        }

        $total_teams = $company->teams->count() ?? 0;

        if ($total_teams >= $features->max_teams) {
            return true;
        }

        return false;
    }

    public function checkLeaveTypeLimitation($company = null)
    {
        if ($company) {
            $features = $company->subscription->plan->planFeatures;
        }else{
            $features = getCurrentSubscriptionFeatures();
            $company = currentCompany();
        }

        $total_leave_types = $company->leaveTypes->count() ?? 0;

        if ($total_leave_types >= $features->max_leave_types) {
            return true;
        }

        return false;
    }

    public function checkCustomThemeAccess()
    {
        $features = getCurrentSubscriptionFeatures();

        if (!$features->custom_theme_look) {
            return true;
        }

        return false;
    }
}
