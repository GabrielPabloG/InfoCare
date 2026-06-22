<?php
echo "MYSQLHOST: " . (getenv('MYSQLHOST') ?: 'NÃO DEFINIDO') . "<br>";
echo "MYSQLPORT: " . (getenv('MYSQLPORT') ?: 'NÃO DEFINIDO') . "<br>";
echo "MYSQLDATABASE: " . (getenv('MYSQLDATABASE') ?: 'NÃO DEFINIDO') . "<br>";