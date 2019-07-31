<?php
ini_set( 'session.gc_maxlifetime', 10 );
$class = new userSession();
$class->addFavoriteSession(1);




class userSession {
    public function returnSessions() {
        echo session_id();
    }

    public function addFavoriteSession(string $propertyId) {
        session_start();
        if (!isset($_SESSION['favorite-properties'])) {
            $_SESSION['favorite-properties'] = array();
        }
        $newAddProperty = array(
            'property-id' => $propertyId
        );

        array_push($_SESSION['favorite-properties'] , $newAddProperty);
        setcookie(session_name(), '', time() - 3600 );
        print_r($_SESSION['favorite-properties']);
    }

    public function removeFavoriteSession(string $propertyId) {
        unset($_SESSION['favorite-properties'][$propertyId]);
        print_r($_SESSION['favorite-properties']);
    }

    public function removeAllFavoliteSession() {
        $_SESSION['favorite-properties'] = array();
        print_r($_SESSION['favorite-properties']);
    }
}
