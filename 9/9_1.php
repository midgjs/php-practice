<!-- 템플릿 파일 -->
<html>
    <head>
        <title>{title}}</title>
    </head>
    <body>
        <h1>{headline}</h1>
        <h2>By {byline}</h2>
        <div class="article">{article}</div>
        <p><small>페이지 생성일: {date}</small></p>
    </body>
</html>

<?php

$now = new DateTime();

$vars = array(
    'title' => 'Man Bites Dog',
    'headline' => 'Man and Dog Trapped in Biting Fiasco',
    'byline' => 'Ireneo Funes',
    'article' => <<<_HTML_
        <p>While walking in the park today, Bioy Casares took a big juicy
        bite out of his dog, Santa's Little Helper. When asked why he did
        it, Mr. Casares said, "I was hungry."</p>
        _HTML_ ,
    'date' => $now->format('l, F j, Y')
);
//$vars의 키를 {}로 감싼 템플릿 문법에 대응하도록
//$template_vars를 생성
$template_vars = array();
foreach($vars as $k => $v) {
    $template_vars['{'.$k.'}'] = $v;
}
//템플릿 불러오기
$template = file_get_contents('template.html');
if($template === false) {
    die("Can't read template.html: $php_errormsg");
}

//찾을 문자열과 교체할 문자열을 배열로 전달하면
//str_replace()는 각각의 쌍을 한 번에 교체한다
$html = str_replace(
    array_keys($template_vars),
    array_values($template_vars),
    $template
);

//HTML 페이지 생성
$result = file_put_contents('article.html', $html);
if($result === false) {
    die("article.html 파일을 생성할 수 없습니다: $php_errormsg");
}






























?>