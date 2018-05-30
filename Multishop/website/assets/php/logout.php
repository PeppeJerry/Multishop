<?php

session_unset();
session_destroy();
unset($_SESSION);
sleep(2);
header("Location: ../../");
exit();