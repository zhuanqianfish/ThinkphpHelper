<?php
return [
    'name'          =>  '权限验证扩展', //名称
    'description'   =>  'RABC权限验证', //描述
    'explain'       =>  '注意，会覆盖目标模块下的tags.php,并在behavior文件夹下生成CheckAuth.php,在项目的extar文件夹下生成rbac.php配置' //说明
    'runSql'           =>  'sql/auth.sql', //数据库,可添加表前缀
    'copyFiles'         =>  [ //复制的文件列表及其规则  '文件名'=>'复制路径'
        'files/tags.php'  =>  BASE_PATH.getDbConfig('projectPath'),
        'files/behavior'    =>  BASE_PATH.getDbConfig('projectPath'),
        'files/extra/rbac.php'  =>  '../'.BASE_PATH.getDbConfig('projectPath'),
    ],
]