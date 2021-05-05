<link href="/projekt-kultura/public/styles/courses.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@400;700&display=swap" rel="stylesheet">

<?php
    $workshop = $params['workshop'];
?>

<section class="container mb-5 mt-5">

    <h1 class="text-center font-weight-bold text-uppercase font-italic" style="font-family: 'Lora', serif;">
        Formularz Zakupu kursu </h1>
    <h2 class="text-center font-weight-normal text-uppercase mb-5 mt-4" style="font-family: 'Lora', serif;">
        <?php echo $workshop['name'] ?> </h2>

    <div class="row justify-content-center">

        <form action="{{ url('/warsztaty/zakup/sprawdzenie') }}" method="POST" class="form col-12 col-md-10 col-xl-9">

            <input type="hidden" name="name_of_warsztat" value="<?php echo $workshop['name'] ?>">
            <input type="hidden" name="price" value="<?php echo $workshop['price'] ?>" id="priceToPay">

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

            <p class="font-weight-bold mb-2" style="font-size: 17px" style="font-family: 'Bitter', serif;"> Warunki:
            </p>
            <div class="form-check mb-3 ml-4">
                <input type="checkbox" class="form-check-input" id="regulamin"
                    name="regulamin" required>

                <label class="form-check-label text-justify" for="regulamin"> <span class="text-danger">*</span> Wyrażam
                    zgodę na
                    przetwarzanie danych osobowych w celu wykonania umowy. Administratorem danych osobowych jest
                    Stowarzyszenie Inicjatyw Społecznych "PROJEKT KULTURA", ul. Ceramików 25, 68-130 Gozdnica, NIP:
                    9241916159, REGON: 387060723. W związku ze zgłoszeniem Pani/Pana do udziału w warsztatach,
                    informujemy iż:
                    Administratorem Pani/Pana danych osobowych jest Stowarzyszenie Inicjatyw Społecznych "PROJEKT
                    KULTURA" („Administrator”)<span id="rodo">...<span class="font-weight-bold"> Więcej </span></span>
                </label>
            </div>

            <input type="hidden" name="p24_merchant_id" value="142447" />
            <input type="hidden" name="p24_pos_id" value="142447" />
            <input type="hidden" name="p24_amount" value="{{ ($warsztat->cena)*100 }}" />

            <div class="row justify-content-center mt-4 pt-2">
                <button type="submit" class="btn btn-lg btn-success" value="submit"
                    style="font-family: 'Bitter', serif;" id="buyButton"> ZAKUP WARSZTAT -
                    <?php echo $workshop['price'] ?> zł
                </button>
            </div>
        </form>
    </div>

</section>

<script>
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
