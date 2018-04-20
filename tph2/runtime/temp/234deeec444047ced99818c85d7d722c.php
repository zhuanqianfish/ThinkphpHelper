<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:30:"template/Config\Formfield.html";i:1515824207;}*/ ?>
<tr>
    <td> <span>字段：<?php echo $fieldName; ?>:</span> </td>
    <td> <input type="text" name="fieldTitle" placeholder="中文描述"> </td>
    <td> <select name="fieldType" id="">
        <option value="text">text</option>
        <option value="select">select</option>
        <option value="radio">radio</option>
        <option value="checkbox">checkbox</option>
        <option value="textarea">textarea</option>
        <option value="password">password</option>
        <option value="number">number</option>
        <option value="date">date</option>
    </select> </td>
    <td> <input type="text" name="fieldTitle" placeholder="选项值，以#分隔"> </td>
    <td> <input type="text" name="fieldTitle" placeholder="默认值"> </td>
    <td> <input type="checkbox" name="isSrot" > </td>
    <td> <input type="checkbox" name="isSearch" > </td>
    <td></td><select name="searchType" id="">
            <option value="text">text</option>
            <option value="select">select</option>
            <option value="date">date</option>
    </select> </td>
    <td></td><input type="checkbox" name="isNotNull" >
    <td></td><input type="text" name="datatype" placeholder="正则或预定义规则"> </td>
    <td></td><input type="text" name="nullmsg" placeholder="必填项为空时提示"> </td>
    <td></td><input type="text" name="errormsg" placeholder="格式错误时提示"> </td>
    
</tr>