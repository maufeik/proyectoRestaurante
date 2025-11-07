<?php
/**
 * ckecks permission to access a page
 * @param string $role the role of the user
 * @param string $page the page being accessed
 * @return bool true if access is granted, false otherwise
 */
function isGranted(string $role, string $page): bool {
    $granted = false;
    switch ($role) {
        case 'admin':
            $granted = true;
            break;
        default:
            $granted = false;
            break;
    }
    return $granted;
}

