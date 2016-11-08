# Joomla-AMP
AMP Joomla! (fork from @Lullabot)

#Требование: PHP 5.5 and higher

# Вам нужно скопировать все файлы к себе в шаблон!
Распаковать в папку с Вашим шаблоном, чтобы был вот такой примерный вид:

![084141](https://cloud.githubusercontent.com/assets/1074710/20105560/15047ac8-a5e3-11e6-81ad-284e37b1105c.png)

по адресу: `http://mysite.ru/my-article.html?amp` - будет отображена AMP версия статьи.

Вам также **необходимо добавить ссылку на AMP версию на странице статьи (article)**.

```<link rel="amphtml" href="http://mysite.ru/my-article.html?amp" />```

Если переопредлен:

`$doc =& JFactory::getDocument();`
`$doc->addCustomTag( '<link rel="amphtml" href="'.JURI::current().'?tmpl=amp" />' );`

Не волнуйтесь дублей не будет, т.к. на AMP версии есть canonical:

`<link rel='canonical' href='<?php echo JURI::current(); ?>' >`
