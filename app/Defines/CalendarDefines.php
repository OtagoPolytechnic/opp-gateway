<?php

define('REPEAT_MODE_NO_REPEAT', 1);
define('REPEAT_MODE_WEEKLY', 4);

define('REPEAT_TYPES', json_encode(
    [
        REPEAT_MODE_NO_REPEAT => 'No Repeat',
        REPEAT_MODE_WEEKLY => 'Repeat Weekly',
    ]
));
