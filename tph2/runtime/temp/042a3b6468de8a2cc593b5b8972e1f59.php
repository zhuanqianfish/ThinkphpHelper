<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:37:"template/ProjectConfig\formField.html";i:1516256997;}*/ ?>
<tr>
    <td> <span>字段：<?php echo $fieldName; ?> <input type="hidden" name="form[<?php echo $findex; ?>][field_name]" value="<?php echo $fieldName; ?>" > </span> </td>
    <td> <input type="text" name="form[<?php echo $findex; ?>][title]" placeholder="中文描述"> </td>
    <td> <select name="form[<?php echo $findex; ?>][input_type]" id="">
        <option value="text">text</option>
        <option value="select">select</option>
        <option value="radio">radio</option>
        <option value="checkbox">checkbox</option>
        <option value="textarea">textarea</option>
        <option value="password">password</option>
        <option value="number">number</option>
        <option value="date">date</option>
    </select> </td>
    <td> <input type="text" name="form[<?php echo $findex; ?>][input_value]" placeholder="选项值，以#分隔"> </td>
    <td> <input type="text" name="form[<?php echo $findex; ?>][default_value]" placeholder="默认值"> </td>
    <td> <input type="checkbox" name="form[<?php echo $findex; ?>][is_short]" > </td>
    <td> <input type="checkbox" name="form[<?php echo $findex; ?>][is_search]" > </td>
    <td><select name="form[<?php echo $findex; ?>][searche_type]" id="">
            <option value="text">text</option>
            <option value="select">select</option>
            <option value="date">date</option>
    </select> </td>
    <td><input type="checkbox" name="form[<?php echo $findex; ?>][is_not_null]" >
    <td><input type="text" name="form[<?php echo $findex; ?>][v_datatype]" placeholder="正则或预定义规则"> </td>
    <td><input type="text" name="form[<?php echo $findex; ?>][v_nullmsg]" placeholder="必填项为空时提示"> </td>
    <td><input type="text" name="form[<?php echo $findex; ?>][v_errormsg]" placeholder="格式错误时提示"> </td>
    
</tr>