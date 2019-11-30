<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form)
{
    $exhPostId = new Typecho_Widget_Helper_Form_Element_Text(
        'exhPostId',
        NULL,
        NULL,
        _t('首页文章 Id'),
        _t('首页显示的第一篇文章的 Id，留空或写 0 的话就用最新的一篇')
    );
    $form->addInput($exhPostId);
}
function getArticleById($id)
{
    $id = intval($id);
    $post = Typecho_Widget::widget('Widget_Archive@post_'. $id, "type=post", "cid=". $id);
    $post->have();
    return $post;
}

function getTitle($ego)
{
    $ego->archiveTitle(array(
        'category'  =>  _t('分类 %s 下的文章'),
        'search'    =>  _t('包含关键字 %s 的文章'),
        'tag'       =>  _t('标签 %s 下的文章'),
        'author'    =>  _t('%s 发布的文章')
    ), '', ' - ');
    _fuck($ego, 'options')->title();
}

function _fuck($obj, $prop)
{
    $reflection = new ReflectionClass($obj);
    $property = $reflection->getProperty($prop);
    $property->setAccessible(true);
    return $property->getValue($obj);
}

/*
function themeFields($layout) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $layout->addItem($logoUrl);
}
*/
