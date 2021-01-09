<?php

echo 'random';

$hash = password_hash('random',PASSWORD_DEFAULT);
echo $hash;
echo password_verify('random',$hash);


?>