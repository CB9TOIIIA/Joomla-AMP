# Joomla-AMP
AMP Joomla! (fork from @Lullabot)

# Вам нужно скопировать все файлы к себе в шаблон!
по адресу: `http://mysite.ru/my-article.html?amp` - будет отображена AMP версия статьи.

Вам также **необходимо добавить ссылку на AMP версию на странице статьи (article)**.

```<link rel="amphtml" href="http://mysite.ru/my-article.html?amp" />```

Не волнуйтесь дублей не будет, т.к. на AMP версии есть canonical:

`<link rel='canonical' href='<?php echo JURI::current(); ?>' >`
