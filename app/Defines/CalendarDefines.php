<?php

define('REPEAT_MODE_NO_REPEAT', 'no_repeat');
define('REPEAT_MODE_WEEKLY', 'repeat_weekly');

define('REPEAT_TYPES', json_encode(
    [
        REPEAT_MODE_NO_REPEAT => 'No Repeat',
        REPEAT_MODE_WEEKLY => 'Repeat Weekly',
    ]
));
