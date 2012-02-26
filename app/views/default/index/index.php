<?php
if($_POST) {
    echo $view->msg;
} else {
    ?>
<div id="form_container">

		<h1><a>Formularz zgłoszeniowy</a></h1>
		<form id="form" class="appnitro"  method="post" action="">
					<div class="form_description">
			<h2>Formularz zgłoszeniowy</h2>
			<p></p>
		</div>
			<ul >

					<li id="li_1" >
		<label class="description" for="name">Imie </label>
		<div>
			<input id="name" name="name" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li>		<li id="li_2" >
		<label class="description" for="content">drugie pole </label>
		<div>
			<input id="content" name="content" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li>

					<li class="buttons">
			    <input type="hidden" name="form_id" value="357586" />

				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>
	</div>
<?php
}
?>
