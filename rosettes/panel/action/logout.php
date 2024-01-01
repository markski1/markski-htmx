<?php

    setcookie("rosettes_key", "_", time() - 3600, "/");
    unset($_COOKIE['rosettes_key']);
    Header('Location: ../index');