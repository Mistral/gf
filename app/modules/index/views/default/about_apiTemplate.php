API pozwala na korzystania z <b>kroc.pl</b> w serwisach zewnętrznych, własnych stronach internetowych. Interfejs zapewnia skuteczne i szybkie skracanie linków. Korzystając z niego wystarczy podać jako parametr link, który chcemy skrócić, a w odpowiedzi API odeśle link skrótu.
  <br /><br />    <br />   
        <b>Korzystanie:</b><br /> <br />
        Wywołaj link: <b>http://kroc.pl/api/TUTAJ_LINK</b> - za pomocą cURL bądź innej metody, lub zwykłe get_file_contents();<br />
        W odpowiedzi otrzymasz JEDYNIE skrócony link przechowywany na serwerze kroc.pl<br />
		<br />
		Aby skorzystać ze skroconego linku należy wywołać <b>http://kroc.pl/TUTAJ_SKROT</b>