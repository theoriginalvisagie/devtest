<?php
    /*=====[DB Parameters]=====*/
    //Docker:
    define("DB_HOST", "db");
    //XAMPP:
    // define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "devtest");
    /*==========*/

    // App Root
    define("APPROOT", dirname(__FILE__));
    // URL Root
    define("URLROOT", "http://localhost/dev-test/phpTest");
    //Admin Root
    define("ADMIN_DIR", APPROOT."/admin");
    //Modules Root
    define("MOD_DIR", ADMIN_DIR."/modules");
    //Libraries Root
    define("LIB_DIR", ADMIN_DIR."/libraries");
?>