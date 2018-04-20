<?php
	return array(
	/*
	 * 数据字段中文定义：
	 * array([表名] => array([字段名] => [中文名称] || array('asName'=>[中文名], 
	 * 						'inType'=>[输入类型], 'dataSource'=>'[数据源@数据源类型]', 'verifi'=>[验证规则]) ))
	 */
	'DB_FIELD_DICT'	=>	array(
		'article'	=>	array(
			'id'	=>	'编号',
			'title'	=>	array('asName' => '文章标题', 'inType' => 'text', 'dataSource' => 'title@config', 'verifi' => 'notNull'),
			'ltitle'	=>	array('asName' => '简略标题', 'inType' => 'text'),
		),
	),
	
	//表名中文定义
	'DB_TABLE_DICT'	=> array(
		'article'	=>	'文章',
	),
);