
<?php
if(@$_POST['link'] && $templates->good == 3) {

     echo 'Twój link ('.$templates->link.') jest teraz dostępny w skróconej formie: <b><a href="http://'.$templates->link.'/" target="_blank">www.kroc.pl/'.$templates->skrot.'</a></b>';

} else {
?>
Wklej tutaj link, który chcesz skrócić(bez http://).<br />
    <form action="" method="post">
        <input name="link" type="text" value="Link..." size="50" style="border: 1px solid #e9e8e8; background: #e9e8e8; padding: 5px; font-weight: bold; text-decoration: none; color: #333;" />
        <input name="submit" type="submit" value="Tnij" style="border: 1px solid #4b98d7; background: #4b98d7; padding: 5px; font-weight: bold; text-decoration: none; color: #FFF;" />
    </form>
<?php
}
?>