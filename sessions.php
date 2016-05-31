<?php

function getMenu($user_type){
	
	$menu = "";

	switch($user_type){
		case "admin":
	
	$menu  = "            <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                <ul class=\"nav navbar-nav navbar-right\">
                    <li>
                        <a class=\"page-scroll\" href=\"http://localhost/salon/appointment/appointment.php\">appointment</a>
                    </li>
                    <li>
                        <a class=\"page-scroll\" href=\"http://localhost/salon/user/user.php\">User</a>
                    </li>
                    <li>
                        <a class=\"page-scroll\" href=\"http://localhost/salon/customer/customer.php\">Customer</a>
                    </li>
                    <li>
                        <a class=\"page-scroll\" href=\"http://localhost/salon/stylist/stylist.php\">Stylist</a>
                    </li>
                    <li>
                        <a class=\"page-scroll\" href=\"http://localhost/salon/salary/salary.php\">Salary</a>
                    </li>
                    <li>
                        <a class=\"page-scroll\" href=\"http://localhost/salon/transaction/transaction.php\">transaction</a>
                    </li>
                    <li>
                        <a class=\"page-scroll\" href=\"http://localhost/salon/profile/profile.php\">Profile</a>
                    </li>
                    
                    <li>
                        <a class=\"page-scroll\" href=\"http://localhost/salon/logout.php\">logout</a>
                    </li>
                    
                </ul>
            </div>";
            break;

            case "stylist":
            $menu = "            <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                <ul class=\"nav navbar-nav navbar-right\">
                    <li>
                        <a class=\"page-scroll\" href=\"http://localhost/salon/appointment/appointment.php\">appointment</a>
                    </li>
                    <li>
                        <a class=\"page-scroll\" href=\"http://localhost/salon/customer/customer.php\">Customer</a>
                    </li>
                    <li>
                        <a class=\"page-scroll\" href=\"http://localhost/salon/stylist/stylist.php\">Stylist</a>
                    </li>
                    <li>
                        <a class=\"page-scroll\" href=\"http://localhost/salon/transaction/transaction.php\">transaction</a>
                    </li>
                    <li>
                        <a class=\"page-scroll\" href=\"http://localhost/salon/profile/profile.php\">Profile</a>
                    </li>
                    
                    <li>
                        <a class=\"page-scroll\" href=\"logout.php\">logout</a>
                    </li>
                    
                </ul>
            </div>";

            case "customer":

            $menu = "            <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                <ul class=\"nav navbar-nav navbar-right\">
                    <li>
                        <a class=\"page-scroll\" href=\"http://localhost/salon/appointment/appointment.php\">appointment</a>
                    </li>
                     <li>
                        <a class=\"page-scroll\" href=\"http://localhost/salon/profile/profile.php\">Profile</a>
                    </li>
                    
                    <li>
                        <a class=\"page-scroll\" href=\"logout.php\">logout</a>
                    </li>
                    
                </ul>
            </div>";

        }
            return $menu;
}


?>