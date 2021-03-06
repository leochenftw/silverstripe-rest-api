<?php

namespace Ntb\RestAPI;

/**
 * Interface for permission checks.
 *
 * @author Christian Blank <c.blank@notthatbad.net>
 */
interface IPermissionChecks {

    /**
     * Checks if a given member has admin rights.
     * @param \Member $member the member
     * @return bool TRUE if given member is an admin
     */
    public function isAdmin($member);
}