<?php 

ob_start();

$greetings     = 'Привет, меня зовут Сергей';
$greetings2    = 'И я умею в PHP!';
$skills_header = 'Мои навыки с резюме HH:';
$skills        = implode(', ', getSkills());


$dom = getSkills();


include('main.php');

$content = ob_get_contents();

ob_end_clean();

echo $content;

function getSkills() {
	$hh = file_get_contents('https://hh.ru/resume/daaa6f17ff0245ffad0039ed1f4166794c556b');
	$hh = explode('<div class="bloko-tag-list">', $hh);
	$hh = explode('<div data-qa="resume-block-driver-experience" class="resume-block">', $hh[1]);

	preg_match_all('/>(\w)+</', $hh[0], $matches);

	$tags = array_map(fn($value): string => str_replace(['>', '<'], ['', ''], $value), $matches[0]);

	return $tags;
}