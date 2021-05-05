<link href="/projekt-kultura/public/styles/courses.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@400;700&display=swap" rel="stylesheet">

<?php
    $course = $params['course'];

    $error = '';
    if($params['error']){
        if($params['error'] === 'notCreated'){
            $error = "Nie udało się zrealizować zamówienia.";
        }
    }
?>

<section class="container mb-5 mt-5">

    <?php if($error != ''): ?>
        <div class="alert alert-danger alert-block col-12 my-3">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong> <?php echo $error ?> </strong>
        </div>
    <?php endif; ?>

    <h1 class="text-center font-weight-bold text-uppercase font-italic" style="font-family: 'Lora', serif;">
        Formularz Zakupu kursu </h1>
    <h2 class="text-center font-weight-normal text-uppercase mb-5 mt-4" style="font-family: 'Lora', serif;">
        <?php echo $course['title'] ?> </h2>

    <div class="row justify-content-center">

        <form action="/projekt-kultura/?page=paymentFormCourse" method="POST" class="form col-12 col-md-10 col-xl-9">

            <input type="hidden" name="name_of_course" value="<?php echo $course['title'] ?>">
            <input type="hidden" name="price" value="<?php echo $params['price'] ?>" id="priceToPay">

            <p class="font-weight-bold mb-2" style="font-size: 17px" style="font-family: 'Bitter', serif;"> Dane: </p>
            <div class="form-group mb-3 ml-2">
                <div>
                    <input id="email" type="email" class="form-control"
                        name="email" required autocomplete="email" value="" placeholder="E-mail *">
                </div>
            </div>

            <div class="form-group mb-3 ml-2">
                <div>
                    <input id="name" type="text" class="form-control" name="name"
                        required autocomplete="billing given-name" value="" placeholder="Imię *">
                </div>
            </div>

            <div class="form-group mb-3 ml-2">
                <div>
                    <input id="surname" type="text" class="form-control"
                        name="surname" required autocomplete="billing family-name" value=""
                        placeholder="Nazwisko *">
                </div>
            </div>

            <div class="form-group mb-3 ml-2">
                <div>
                    <input id="phone" type="text" class="form-control" name="phone"
                        required autocomplete="phone" value="" placeholder="Telefon *">
                </div>
            </div>

            <p class="font-weight-bold mb-2" style="font-size: 17px" style="font-family: 'Bitter', serif;">
                Potwierdzenie zakupu: </p>

            <div class="custom-control custom-radio mb-3 ml-4">
                <input class="custom-control-input" type="checkbox" name="faktura" id="Radios2" value="faktura"
                    onchange="showFaktura()">
                <label class="custom-control-label" for="Radios2">
                    Faktura VAT
                </label>
            </div>

            <div id="faktura">

                <div class="form-group mb-3 ml-2">
                    <div>
                        <input id="company" type="text" class="form-control"
                            name="company" autocomplete="company" value="" placeholder="Firma">
                    </div>
                </div>

                <div class="form-group mb-3 ml-2">
                    <div>
                        <input id="nip" type="text" class="form-control" name="nip"
                            autocomplete="nip" value="" placeholder="Nip">
                    </div>
                </div>

                <div class="form-group mb-3 ml-2">
                    <div>
                        <input id="street" type="text" class="form-control"
                            name="street" autocomplete="street" value="" placeholder="Ulica *">
                    </div>
                </div>

                <div class="form-group mb-3 ml-2">
                    <div>
                        <input id="numberOfFlat" type="text"
                            class="form-control" name="numberOfFlat"
                            autocomplete="numberOfFlat" value=""
                            placeholder="Number mieszkania *">
                    </div>
                </div>

                <div class="form-group mb-3 ml-2">
                    <div>
                        <input id="city" type="text" class="form-control"
                            name="city" autocomplete="city" value="" placeholder="Miejscowość *">
                    </div>
                </div>

                <div class="form-group mb-3 ml-2">
                    <div>
                        <input id="zip" type="text" class="form-control" name="zip"
                            autocomplete="zip" value="" placeholder="Kod pocztowy *">
                    </div>
                </div>
            </div>

            <p class="font-weight-bold mb-2" style="font-size: 17px" style="font-family: 'Bitter', serif;"> Warianty
                szkolenia: </p>

            <div class="custom-control custom-radio mb-2 ml-4">
                <input class="custom-control-input wariant" type="radio" onclick="change(<?php echo $course['price1'] ?>)"
                    name="variant" id="Radio1" value="1" <?php echo $params['variant'] == 1 ? 'checked' : '' ?>>
                <label class="custom-control-label" for="Radio1">
                    <b> Wariant 1 </b> - FILM SZKOLENIOWY <?php echo $course['variant1'] ? '+ '.$course['variant1'] : '' ?>
                    (<span class="text-danger font-weight-bold"
                        style="font-family: 'Bitter', serif;"><?php echo $course['price1'] ?> zł</span>)
                </label>
            </div>

            <div class="custom-control custom-radio mb-2 ml-4">
                <input class="custom-control-input wariant" type="radio" name="variant" id="Radio2"
                    onclick="change(<?php echo $course['price2'] ?>)" value="2" <?php echo $params['variant'] == 2 ? 'checked' : '' ?>>
                <label class="custom-control-label" for="Radio2">
                    <b> Wariant 2 </b> - FILM SZKOLENIOWY <?php echo $course['variant2'] ? '+ '.$course['variant2'] : '' ?> (<span
                        class="text-danger font-weight-bold" style="font-family: 'Bitter', serif;"><?php echo $course['price2'] ?> zł</span>)
                </label>
            </div>

            <div class="custom-control custom-radio mb-3 ml-4">
                <input class="custom-control-input wariant" type="radio" name="variant"
                    onclick="change(<?php echo $course['price3'] ?>)" id="Radio3" value="3" <?php echo $params['variant'] == 3 ? 'checked' : '' ?>>
                <label class="custom-control-label" for="Radio3">
                    <b> Wariant 3 </b> - FILM SZKOLENIOWY <?php echo $course['variant3'] ? '+ '.$course['variant3'] : '' ?> (<span
                        class="text-danger font-weight-bold" style="font-family: 'Bitter', serif;"><?php echo $course['price3'] ?> zł</span>)
                </label>
            </div>

            <p class="font-weight-bold mb-2" style="font-size: 17px" style="font-family: 'Bitter', serif;">
                Podsumowanie: </p>
            <p class="mb-2 text-justify"> Wypełniając powyższy formularz deklarujesz chęć otrzymania szkolenia
                (nagranie) pt.
                <?php echo $course['title'] ?>
            </p>
            <p class="mb-2 text-justify"> Po zatwierdzeniu płatności otrzymasz na wskazany adres e-mail klucz,
                umożliwiający przejście do szkolenia (nagrania), który należy wpisać w
                zakładce Szkolenia pod zakupionym kursem. <b> Klucz aktywny jest 10 dni od daty zaksięgowania płatności. </b>
            </p>
            <p class="text-justify"> Wypełniając formularz upoważniasz Stowarzyszenie Inicjatyw Społecznych "PROJEKT
                KULTURA", ul. Ceramików
                25, 68-130 Gozdnica, NIP: 9241916159, do wystawienia faktury bez podpisu nabywcy. </p>

            <p class="font-weight-bold mb-2" style="font-size: 17px" style="font-family: 'Bitter', serif;"> Warunki:
            </p>
            <div class="form-check mb-3 ml-4">
                <input type="checkbox" class="form-check-input" id="regulamin"
                    name="regulamin" required>

                <label class="form-check-label text-justify" for="regulamin"> <span class="text-danger">*</span> Wyrażam
                    zgodę na
                    przetwarzanie danych osobowych w celu wykonania umowy. Administratorem danych osobowych jest
                    Stowarzyszenie Inicjatyw Społecznych "PROJEKT KULTURA", ul. Ceramików 25, 68-130 Gozdnica, NIP:
                    9241916159, REGON: 387060723. W związku ze zgłoszeniem Pani/Pana do udziału w szkoleniu, informujemy
                    iż:
                    Administratorem Pani/Pana danych osobowych jest Stowarzyszenie Inicjatyw Społecznych "PROJEKT
                    KULTURA" („Administrator”)<span id="rodo">...<span class="font-weight-bold"> Więcej </span></span>
                </label>
            </div>

            <input type="hidden" name="p24_merchant_id" value="142447" />
            <input type="hidden" name="p24_pos_id" value="142447" />
            <input type="hidden" name="p24_amount" id="p24_priceToPay" value="{{ ($kurs->cena)*100 }}" />

            <div class="row justify-content-center mt-4 pt-2">
                <button type="submit" class="btn btn-lg btn-success" style="font-family: 'Bitter', serif;"
                    id="buyButton"> ZAKUP KURS -
                    <?php echo $params['price'] ?> zł
                </button>
            </div>
        </form>
    </div>

</section>

<script>
    document.getElementById('faktura').style.display = 'none';

    function change(price){
        document.getElementById('buyButton').innerHTML = 'ZAKUP KURS - '+price+' zł'; 
        document.getElementById('priceToPay').innerHTML = price; 
        document.getElementById('priceToPay').value = price; 
        document.getElementById('p24_priceToPay').value = price*100; 
    }

    function showFaktura(){
        if(document.getElementById('Radios2').checked == true){
            document.getElementById('faktura').style.display = 'block';
            document.getElementById('form').action = '/summaryOrderFaktura';
        }else{
            document.getElementById('faktura').style.display = 'none';
            document.getElementById('form').action = '/summaryOrder';
        }
    }

    var rodo = document.getElementById('rodo');

    rodo.addEventListener('click', () => {
        rodo.innerHTML = ' Przetwarzane będą następujące dane osobowe: imię, nazwisko, e-mail, telefon. Dane będą przechowywane przez'+ 
        'Administratora do czasu zakończenia rozliczenia realizacji usługi oraz przez czas wymagany przez prawo w zakresie, w jakim jest'+ 
        'to niezbędne do realizacja dyspozycji zawartych w tych przepisach lub do czasu złożenia przez Panią/Pana sprzeciwu wobec '+
        'przetwarzania Danych. Dane są chronione środkami technicznymi i organizacyjnymi, aby zagwarantować odpowiedni poziom ochrony, '+
        'zgodnie z obowiązującymi przepisami. Administrator nie pozyskuje Danych od podmiotów trzecich lub ze źródeł powszechnie '+
        'dostępnych (zgodnie z art. 13 RODO). Dane mogą być udostępniane podmiotom, które świadczą na rzecz Administratora usługi '+
        'informatyczne lub podmiotom świadczącym na rzecz Administratora usługi księgowe lub podmiotom świadczącym na rzecz Administratora '+
        'usługi administracyjne i inne związane z realizacją usługi. Dane mogą być przekazywane innym podmiotom upoważnionym do tego na '+
        'podstawie przepisów prawa tj. ZUS, Urząd Skarbowy. Podstawą przetwarzania Danych jest art. 6 ust. 1 lit. b) oraz lit. f) Ogólnego '+
        'Rozporządzenia o Ochronie Danych Osobowych z dnia 27 kwietnia 2016 r. (RODO), zaś w zakresie informacji przekazywanych Komisji '+
        'Europejskiej w ramach programów zarządzanych przez Komisję Europejską i jej agendy – art. 5 lit. c) Rozporządzenia 2018/1725. '+
        'Przysługuje Pani/Panu prawo do: uzyskania informacji na temat przetwarzania Danych, w tym o kategoriach przetwarzanych danych i '+
        'ewentualnych odbiorcach Danych, żądania skorygowania nieprawidłowych Danych lub uzupełnienia niekompletnych Danych, żądania '+
        'usunięcia lub ograniczenia przetwarzania Danych – na zasadach opisanych w RODO, złożenia sprzeciwu wobec przetwarzania - na '+
        'zasadach opisanych w RODO, przenoszenia Danych – poprzez otrzymanie Danych od Administratora formacie umożliwiającym ich '+
        'przekazanie wybranemu podmiotowi trzeciemu, złożenia skargi do organu nadzorczego - Prezesa Urzędu Ochrony Danych Osobowych, '+
        'Stawki 2, 00 - 193 Warszawa – w przypadku stwierdzenia, że Dane są przetwarzane sprzecznie z prawem. Ma Pani/Pan prawo zgłoszenia '+
        'sprzeciwu wobec przetwarzanie wszelkich lub niektórych Danych w dowolnym momencie. Sprzeciw nie ma wpływu na zgodność z prawem '+
        'przetwarzania, którego dokonano przed jego dokonaniem. Sprzeciw można zgłosić poprzez wysłanie oświadczenia na adres Stowarzyszenie'+ 
        'Inicjatyw Społecznych "PROJEKT KULTURA", ul. Ceramików 25, 68-130 Gozdnica, lub na adres e-mail: '+
        'stowarzyszenie.projektkultura@gmail.com. Wszelkie wnioski, pytania i żądania związane z przetwarzaniem Danych powinny być kierowane'+ 
        'na adres e-mail: stowarzyszenie.projektkultura@gmail.com. W szczególności mają Państwo prawo do żądania od Stowarzyszenia Inicjatyw '+
        'Społecznych "PROJEKT KULTURA" dostępu do swoich danych osobowych oraz ich sprostowania lub usunięcia. ';
    });

</script>
