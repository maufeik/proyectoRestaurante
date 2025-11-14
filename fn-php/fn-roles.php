<?php
/**
 * ckecks permission to access a page
 * @param string $role the role of the user
 * @param string $page the page being accessed (e.g., 'adminmenus', 'daymenu')
 * @return bool true if access is granted, false otherwise
 */
function isGranted(string $role, string $page): bool {
    $role = strtolower($role); 

    $admin_pages = ['adminmenus', 'adminusers'];

    $logged_in_pages = ['daymenu', 'viewmenus'];
    
    if (in_array($page, $admin_pages)) {
        return ($role === 'admin');
    }
    

    if (in_array($page, $logged_in_pages)) {
        return ($role === 'admin' || $role === 'registered' || $role === 'staff');
    }

    return true; 
}