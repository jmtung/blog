<?php
$json = file_get_contents('php://input');
$data = json_decode($json);
if (empty($data->ref)) {
    file_put_contents('/var/www/html/log/blog.log', 'type: test  '.'status: success  time: '.date('Y年m月d日 H:i:s',time()).PHP_EOL,FILE_APPEND) or die('error');
} else {
    if ($data->token == '006542') {
        $command = "sudo git --git-dir='/var/www/blog/.git' --work-tree='/var/www/blog' pull";
        $exec_res = shell_exec($command);
        if ($exec_res!=''){
            $status="success";
        }else{
            $status="fail";
        }
        file_put_contents('/var/www/blog/blog.log', 'type: blog  status: '.$status. '  time:' . date('Y年m月d日 H:i:s', time()) . PHP_EOL, FILE_APPEND) or die('error');
    }
}