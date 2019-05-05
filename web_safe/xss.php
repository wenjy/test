<?php
/**
 * @author: jiangyi
 * @date: 下午7:30 2019/4/4
 *
 * XSS（cross site script）攻击，通常是指通过'HTML注入'篡改网页
 * XSS Payload/XSS Worm
 *
 * 防御
 * 1、Cookie设置HttpOnly，禁止js访问cookie
 * 2、输入检查
 * 3、输出转义，HtmlEncode
 * 4、过滤富文本，采用白名单方法，只允许安全标签如 <a> <img> <div> 等
 */

// http://localhost/php/web_safe/xss.php?param=%3Cscript%3Ealert(xss)%3C/script%3E

$input = $_GET['param'] ?? '';

$html =  '<div>'.$input.'</div>';
//echo $html;

echo htmlspecialchars($html);
