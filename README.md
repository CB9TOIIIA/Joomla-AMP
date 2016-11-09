# Joomla-AMP - AMP версия для Joomla!
(Компонент/CCK - не важен) - работает со всеми расширениями.
#Требование: PHP 5.5 и выше!!!

# Вам нужно скопировать все файлы к себе в шаблон!
Для начала распаковать содержимое архива в папку с Вашим шаблоном, чтобы был вот такой примерный вид:

![084141](https://cloud.githubusercontent.com/assets/1074710/20105560/15047ac8-a5e3-11e6-81ad-284e37b1105c.png)

По адресу: ```http://mysite.ru/my-article.html?amp``` - будет отображена AMP версия статьи.

Проверить валидность можете по сервису: ```https://validator.ampproject.org/#url=```

***

Вам также **необходимо добавить ссылку на AMP версию на странице статьи (article)**.

```<link rel="amphtml" href="http://mysite.ru/my-article.html?amp" />```

Если переопредлен:

```sh
$document = JFactory::getDocument();
$document->addCustomTag( '<link rel="amphtml" href="'.JURI::current().'?tmpl=amp" />' );
```

Не волнуйтесь дублей не будет, т.к. на AMP версии есть canonical:

`<link rel='canonical' href='<?php echo JURI::current(); ?>' >`

***

Далее пример для JBZoo - как передать доп. данные для микроразметки:

Добавим в full.php - ссылку на AMP версию:

```sh
$document->addCustomTag('<link rel="amphtml" href="'.JURI::current().'?tmpl=amp" />');

$desc = JString::trim(strip_tags($this->renderPosition('text')));
$desc_new = htmlspecialchars(JString::substr($desc, 0, 220));
$document->addCustomTag('<meta name="description" content="'.$desc_new.'" />');

$document->addCustomTag('<meta name="article-id" content="'.$item->id.'">');
$document->addCustomTag('<meta name="article-created" content="'.$item->created.'">');
$document->addCustomTag('<meta name="article-modified" content="'.$item->modified.'">');
```
