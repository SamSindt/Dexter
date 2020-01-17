<?php
    class LogoutController {
        public function submit () {
            session_start();
            session_destroy ();
        }
    }