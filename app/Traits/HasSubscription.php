<?php

namespace App\Traits;

trait HasSubscription
{
    public function checkEmployeesLimitation()
    {
        $features = getCurrentSubscriptionFeatures();

        if ($features->is_limited_employee) {
            $total_employees =  currentCompany()->employees->count();

            if ($total_employees >= $features->max_employees) {
                return true;
            }
        }

        return false;
    }

    public function checkTeamLimitation()
    {
        $features = getCurrentSubscriptionFeatures();
        $total_teams = currentCompany()->teams->count() ?? 0;

        if ($total_teams >= $features->max_teams) {
            return true;
        }

        return false;
    }

    public function checkLeaveTypeLimitation()
    {
        $features = getCurrentSubscriptionFeatures();
        $total_leave_types = currentCompany()->leaveTypes->count() ?? 0;

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
