# superapi.zabironin.ru
 
<h3>https://superapi.zabironin.ru/currencies</h3>
- список курсов валют с возможность пагинации
<table>
	<tr>
		<td>Параметр</td>
		<td>Default</td>
		<td>Explane</td>
	</tr>
	<tr>
		<td>page</td>
		<td>0</td>
		<td>Номер страницы пагинации</td>
	</tr>
	<tr>
		<td>perpage</td>
		<td>5</td>
		<td>Кол-во на странице</td>
	</tr>
</table>

<h3>https://superapi.zabironin.ru/currency/:ID</h3>
- возвращает курс валюты для переданного id (аттрибут ID узла Valute, прим. https://superapi.zabironin.ru/currency/R01010)


<h3>Обновление консолькой</h3>
$: php cli.php update
