<?php

namespace Database\Factories;

use App\Models\OvlascenoLice;
use Illuminate\Database\Eloquent\Factories\Factory;

class OvlascenoLiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OvlascenoLice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $firstName = array(
            'Andrea', 'Agnica', 'Adelina', 'Aleksandra', 'Aleksija', 'Ana', 'Anastasija', 'Andrijana', 'Anda', 'Anđa', 'Anđela', 'Anđelka', 'Anđelija', 'Angelina', 'Anka', 'Ankica', 'Anica', 'Antonina ',
            'Blagoja', 'Biljana', 'Bisenija', 'Biserka', 'Blaginja', 'Blagica', 'Blaženka', 'Bogdana', 'Bogdanka', 'Božana', 'Božidarka', 'Božinka', 'Božica', 'Bojana', 'Borislava', 'Borislavka', 'Borjana', 'Borjanka', 'Borka', 'Bosa', 'Bosiljka', 'Branislava', 'Branka', 'Brankica', 'Bratislava', 'Budimirka', 'Budimka',
            'Valerija', 'Vanja', 'Varvara', 'Vasilija', 'Vasiljka', 'Vasilka', 'Vaskrsija', 'Veliborka', 'Velinka', 'Velisava', 'Vera', 'Verka', 'Verica', 'Veronika', 'Veroslava', 'Veselinka', 'Vesela', 'Vesna', 'Vida', 'Vidojka', 'Vidosava', 'Viktorija', 'Violeta', 'Vitka', 'Vitomirka', 'Višeslava', 'Višnja', 'Vladana', 'Vladanka', 'Vladimirka', 'Vladislava', 'Vlasta', 'Vlastimirka', 'Vlatka', 'Vojislava', 'Vojka', 'Vujadinka', 'Vujka', 'Vujana', 'Vukana', 'Vukica', 'Vukosava', 'Vukmira ',
            'Gavra', 'Gavrila', 'Gavrilka', 'Gvozdenija', 'Georgina', 'Gorana', 'Gorica', 'Goranka', 'Gorjana', 'Gordana', 'Gospava', 'Grozdana', 'Grozda',
            'Davorka', 'Daliborka', 'Damjanka', 'Damljanka', 'Danica', 'Danka', 'Dana', 'Danojla', 'Darinka', 'Dara', 'Dafina', 'Daša', 'Deva', 'Dejana', 'Desanka', 'Desa', 'Despina', 'Despinja', 'Divna', 'Dikosava', 'Dmitra', 'Dobrila', 'Dobrinka', 'Dobrica', 'Dobrija', 'Dokna', 'Doroteja', 'Dostana', 'Dragica', 'Dragana', 'Draga', 'Draginja', 'Dragojla', 'Dragija', 'Dragomira', 'Dragoslava', 'Drenka', 'Drena', 'Drina', 'Drinka', 'Dubravka', 'Dunja', 'Dušanka', 'Dušica', 'Duška',
            'Đurđa', 'Đurđica', 'Đurđija', 'Đurisava', 'Đurđevka', 'Đuka',
            'Eva', 'Evica', 'Evgenija', 'Evdokija', 'Elena', 'Ekaterina', 'Emilija',
            'Žaklina', 'Žanka', 'Želimirka', 'Željka', 'Željana', 'Živadinka', 'Živana', 'Živanka', 'Živka', 'Živodarka', 'Živoratka', 'Živoslava', 'Živoslavka',
            'Zavida', 'Zagorka', 'Zaga', 'Zvezdana', 'Zvjezdana', 'Zvonka', 'Zdravka', 'Zlata', 'Zlatica', 'Zlatka', 'Zlatana', 'Zlatija', 'Zlatomirka', 'Zora', 'Zorica', 'Zorana', 'Zorka', 'Zorislava', 'Zrinka',
            'Iva', 'Ivana', 'Ivanka', 'Ivka', 'Ivona', 'Ikonija', 'Ilinka', 'Irena', 'Irina', 'Isidora',
            'Javorka', 'Jagoda', 'Jagodinka', 'Jadranka', 'Jana', 'Janja', 'Janovka', 'Jasmina', 'Jasminka', 'Jasna', 'Jevdokija', 'Jevrosima', 'Jela', 'Jelica', 'Jelka', 'Jeka', 'Jelača', 'Jelena', 'Jelenka', 'Jelisava', 'Jelisaveta', 'Jelisavka', 'Jefimija', 'Ješa', 'Jovana', 'Jovanka', 'Jovka', 'Jorgovanka', 'Jordanka', 'Julija', 'Julijana', 'Julka',
            'Kadivka', 'Kazimira', 'Kasija', 'Katarina', 'Kata', 'Katica', 'Kovana', 'Koviljka', 'Kovina', 'Kojadinka', 'Komnenija', 'Kosana', 'Kosara', 'Kosovka', 'Kostadinka', 'Koštana', 'Kraisava', 'Kristina', 'Krstina', 'Krsmanija', 'Krstana', 'Krunoslava', 'Ksenija',
            'Lana', 'Lara', 'Latinka', 'Lela', 'Lena', 'Lenka', 'Leonida', 'Leonora', 'Lepa', 'Leposava', 'Lidija', 'Liza', 'Lilijana', 'Lila', 'Lola', 'Luna', 'Lučija', 'Luča',
            'Ljepava', 'Ljeposava', 'Ljiljana', 'Ljilja', 'Ljubica', 'Ljuba', 'Ljubinka', 'Ljubomirka', 'Ljubosava', 'Ljupka',
            'Maja', 'Majda', 'Malina', 'Malinka', 'Manda', 'Manduša', 'Marija', 'Mara', 'Marica', 'Maša', 'Marina', 'Marinka', 'Marta', 'Mijana', 'Mila', 'Milana', 'Milanka', 'Miladija', 'Mileva', 'Milena', 'Milija', 'Milka', 'Milkica', 'Milijana', 'Milina', 'Milesa', 'Milisava', 'Milisavka', 'Milosava', 'Milosavka', 'Milica', 'Milojka', 'Miluka', 'Milunka', 'Miluša', 'Miljana', 'Miljka', 'Milja', 'Miomirka', 'Mira', 'Mirka', 'Mirjana', 'Miroslava', 'Mirosava', 'Mitra',
            'Nada', 'Nadežda', 'Nađa', 'Nadica', 'Natalija', 'Nataša', 'Najda', 'Neda', 'Nevena', 'Nevenka', 'Nedeljka', 'Neđeljka', 'Nikolija', 'Nina', 'Nišava', 'Novka', 'Nikoleta', 'Njegomirka', 'Njegoslava',
            'Obradinka', 'Obrenija', 'Ognjana', 'Olga', 'Olja', 'Olivera',
            'Pava', 'Pavija', 'Pavlija', 'Pauna', 'Pelagija', 'Persa', 'Persida', 'Petra', 'Petrija', 'Poznana', 'Prodana',
            'Rada', 'Radica', 'Radana', 'Radinka', 'Radmila', 'Radna', 'Radojka', 'Radoslava', 'Raduka', 'Radula', 'Radunka', 'Rajka', 'Rajna', 'Ranka', 'Roksanda', 'Rosa', 'Ruža', 'Ružica',
            'Sava', 'Savka', 'Sazdana', 'Sandra', 'Sanja', 'Sara', 'Svetislava', 'Svetlana', 'Svjetlana', 'Sekana', 'Simana', 'Simeuna', 'Simka', 'Simonida', 'Sinđa', 'Skorosava', 'Slavica', 'Slavka', 'Slavna', 'Slavojka', 'Slađana', 'Slobodanka', 'Smiljana', 'Smiljka', 'Smilja', 'Smoljana', 'Smoljka', 'Snežana', 'Snježana', 'Sofija', 'Soka', 'Sonja', 'Spasenija', 'Spomenka', 'Srbijanka', 'Stajka', 'Staka', 'Stamena', 'Stamenka', 'Stana', 'Stanka', 'Stanija', 'Stanica', 'Stanava', 'Stanača', 'Stanislava', 'Stanisava', 'Stanojka', 'Stanojla', 'Staša', 'Stoisava', 'Stojana', 'Stojanka', 'Stojka', 'Stoja', 'Stojna', 'Suzana',
            'Tajana', 'Tamara', 'Tankosa', 'Tankosava', 'Tara', 'Tatjana', 'Tanja', 'Teodora', 'Todora', 'Tea', 'Tijana', 'Tomanija',
            'Ćerana', 'Ubavka', 'Una', 'Fema', 'Hranislava',
            'Cveta', 'Cvijeta',
            'Čarna',
            'Šana',
            'Avakum', 'Avram', 'Adam', 'Aksentije', 'Aleksandar', 'Aleksandron', 'Aleksa', 'Aleksije', 'Aleksej', 'Alimpije', 'Andrej', 'Andrija', 'Andrijaš', 'Anđelko', 'Antonije', 'Aranđel', 'Arsenije', 'Arsen', 'Arsa', 'Arso', 'Atanasije', 'Atanacko', 'Aćim', 'Agnija',
            'Bajko', 'Bajo', 'Bajčeta', 'Balša', 'Bane', 'Batrić', 'Berislav', 'Berisav', 'Beriša', 'Berko', 'Biljan', 'Biserko', 'Blagoje', 'Blagota', 'Blagomir', 'Blaža', 'Blažo', 'Blažen', 'Blaško', 'Boban', 'Bogdan', 'Bogelj', 'Bogić', 'Bogiša', 'Bogoboj', 'Bogoje', 'Bogoljub', 'Bogoslav', 'Bogosav', 'Božidar', 'Boža', 'Božo', 'Božin', 'Božićko', 'Boin', 'Boica', 'Bojan', 'Bojko', 'Bojo', 'Bojčeta', 'Bora', 'Boro', 'Borivoje', 'Borivoj', 'Boris', 'Borislav', 'Borisav', 'Borko', 'Boriša', 'Boroje', 'Boško', 'Brajan', 'Brajica', 'Branivoje', 'Branivoj', 'Branimir', 'Branislav', 'Branko', 'Brano', 'Bratimir', 'Bratislav', 'Bratovan', 'Bratoljub', 'Brnča', 'Budimir', 'Budislav', 'Budisav',
            'Vasilije', 'Vajo', 'Vasilj', 'Vasko', 'Vasoje', 'Vasa', 'Vaso', 'Vaskrsije', 'Vekoslav', 'Vjekoslav', 'Velibor', 'Velizar', 'Velimir', 'Velisav', 'Veličko', 'Veliša', 'Veljko', 'Veselin', 'Vesko', 'Veran', 'Veroljub', 'Vidoje', 'Vidak', 'Vid', 'Vidač', 'Vidan', 'Viden', 'Vidosav', 'Vidojko', 'Vidoja', 'Viktor', 'Vilotije', 'Vitomir', 'Vitko', 'Vićentije', 'Vićan', 'Višeslav', 'Vladan', 'Vlada', 'Vlade', 'Vlado', 'Vlatko', 'Vladeta', 'Vladica', 'Vladoje', 'Vladun', 'Vladimir', 'Vladislav', 'Vladisav', 'Vlaislav', 'Vlasije', 'Vlajko', 'Vlastimir', 'Vlaško', 'Vojdrag', 'Vojimir', 'Vojkan', 'Vojin', 'Vojko', 'Voica', 'Vojislav', 'Vraneš', 'Vugdrag', 'Vuzman', 'Vuilo', 'Vuin', 'Vuica', 'Vujadin', 'Vujak', 'Vujan', 'Vujeta', 'Vujko', 'Vujčeta', 'Vujčin', 'Vujo', 'Vuk', 'Vuko', 'Vukalj', 'Vukas', 'Vukac', 'Vukač', 'Vukelja', 'Vukić', 'Vukša', 'Vukadin', 'Vukan', 'Vukota', 'Vukajlo', 'Vukalo', 'Vukman', 'Vukoman', 'Vukmilj', 'Vukoje', 'Vukojica', 'Vukola', 'Vukovoje', 'Vukašin', 'Vukomir', 'Vukmir', 'Vukoslav', 'Vukosav', 'Vuksan', 'Vuleta', 'Vule', 'Vunko', 'Vučeta', 'Vučina', 'Vučan', 'Vučen', 'Vučić', 'Vučko', 'Vuča',
            'Gavrilo', 'Gaja', 'Gajo', 'Gača', 'Gajin', 'Gvozden', 'Gvozdenko', 'Genadije', 'Georgije', 'Gerasim', 'German', 'Gligorije', 'Gliša', 'Glišo', 'Grigorije', 'Godeč', 'Godomir', 'Gojko', 'Golub', 'Goran', 'Gordan', 'Gorčin', 'Gostimir', 'Gostoljub', 'Gradimir', 'Gradeta', 'Gradiša', 'Grgur', 'Grdan', 'Grijak', 'Grozdan', 'Grubeta', 'Grubiša', 'Gruban', 'Grubac', 'Grubač', 'Grubeša', 'Gruja', 'Grujica', 'Grujo',
            'Dabiša', 'Dabo', 'Dabiživ', 'David', 'Dalibor', 'Danko', 'Danijel', 'Danilo', 'Dane', 'Damjan', 'Damljan', 'Dančul', 'Darije', 'Dario', 'Darijo', 'Darjan', 'Darko', 'Dejan', 'Desimir', 'Despot', 'Dimitrije', 'Dimčo', 'Dmitar', 'Dobrašin', 'Dobrilo', 'Dobrica', 'Dobrinko', 'Dobrivoje', 'Dobrivoj', 'Dobrovuk', 'Dobroslav', 'Dobrosav', 'Dojčin', 'Dojčilo', 'Doko', 'Dorotej', 'Dositej', 'Dragan', 'Dragiša', 'Dragić', 'Dragoja', 'Dragoje', 'Dragaš', 'Dragojlo', 'Dragoš', 'Dragobrat', 'Drago', 'Dragovan', 'Dragoljub', 'Dragoman', 'Dragomir', 'Dragorad', 'Dragoslav', 'Dragosav', 'Draža', 'Dražo', 'Dražeta', 'Dragutin', 'Drailo', 'Drakša', 'Draško', 'Dubravac', 'Dubravko', 'Dujak', 'Duka', 'Dukadin', 'Dušan', 'Duško',
            'Đenadije', 'Đorđe', 'Đorđo', 'Đura', 'Đukan', 'Đurađ', 'Đuro', 'Đoko', 'Đorđije', 'Đurašin', 'Đurisav', 'Đurica', 'Đurko', 'Đurđe',
            'Evgenije', 'Emilijan', 'Emilije', 'Emil', 'Erak',
            'Žarko', 'Želimir', 'Željko', 'Živa', 'Živica', 'Živadin', 'Živan', 'Živanko', 'Živko', 'Živojin', 'Živoljub', 'Živomir', 'Živorad', 'Života', 'Žika', 'Žikica', 'Žitomir',
            'Zaviša', 'Zarija', 'Zarije', 'Zaharije', 'Zvezdan', 'Zvjezdan', 'Zvezdodrag', 'Zvezdoslav', 'Zvonko', 'Zvonimir', 'Zdravko', 'Zdraviša', 'Zlatan', 'Zlatko', 'Zlatoje', 'Zlatibor', 'Zlatomir', 'Zlatosav', 'Zoran', 'Zrinko',
            'Ivan', 'Ivica', 'Ivo', 'Ivko', 'Ivaniš', 'Ignjat', 'Ignjatije', 'Igor', 'Ilija', 'Isaija', 'Isailo', 'Isak', 'Isidor',
            'Jablan', 'Javorko', 'Jagoš', 'Jadranko', 'Jakov', 'Jakša', 'Jandrija', 'Jandre', 'Janićije', 'Janko', 'Janča', 'Jaroslav', 'Jasen', 'Jasenko', 'Jevrem', 'Jevtimije', 'Jevta', 'Jevto', 'Jevtan', 'Jezdimir', 'Jezda', 'Jelen', 'Jelenko', 'Jelašin', 'Jelisije', 'Jeremija', 'Jerko', 'Jerotije', 'Jovan', 'Jovica', 'Joviša', 'Jova', 'Jovo', 'Jovko', 'Joko', 'Joksim', 'Jordan', 'Josif', 'Jugoljub', 'Jugomir', 'Jugoslav', 'Julijan', 'Junoša', 'Juriša', 'Justin',
            'Kamenko', 'Kažimir', 'Kazimir', 'Kiprijan', 'Kirilo', 'Koviljko', 'Kojadin', 'Kojčin', 'Kokan', 'Komnen', 'Konstantin', 'Kostadin', 'Kosta', 'Kozma', 'Kornelije', 'Koča', 'Kraguj', 'Krajčin', 'Krasimir', 'Krasoje', 'Krajislav', 'Krsman', 'Krsto', 'Krsta', 'Krstan', 'Krstivoje', 'Krunislav', 'Kuzman', 'Kumodrag',
            'Labud', 'Lazar', 'Laza', 'Lazo', 'Laka', 'Lako', 'Laketa', 'Lale', 'Ležimir', 'Lepoje', 'Lepomir', 'Leposlav', 'Lozan', 'Lola', 'Luka', 'Lujo',
            'Ljiljan', 'Ljuban', 'Ljubinko', 'Ljubo', 'Ljubiša', 'Ljubivoje', 'Ljuboje', 'Ljuboja', 'Ljuben', 'Ljubenko', 'Ljubislav', 'Ljubisav', 'Ljubobrat', 'Ljubodrag', 'Ljubomir',
            'Mavren', 'Maksim', 'Maleta', 'Maleš', 'Manojlo', 'Mane', 'Marinko', 'Marjan', 'Marko', 'Martin', 'Matija', 'Matijaš', 'Mateja', 'Matej', 'Mato', 'Mašan', 'Maško', 'Medak', 'Mijak', 'Mijan', 'Mijat', 'Mija', 'Mijo', 'Mijobrat', 'Miladin', 'Milak', 'Milan', 'Milanko', 'Milat', 'Milaš', 'Milašin', 'Mile', 'Milo', 'Milko', 'Milen', 'Milenko', 'Milentije', 'Mileta', 'Mileš', 'Milivoje', 'Milivoj', 'Milija', 'Milijan', 'Milijaš', 'Milin', 'Milinko', 'Milić', 'Milovan', 'Miloje', 'Milojko', 'Miloja', 'Milojica', 'Milomir', 'Milorad', 'Milosav', 'Milisav', 'Miloš', 'Milten', 'Milun', 'Milutin', 'Miluš', 'Miljan', 'Miljen', 'Miljko', 'Milj', 'Miljojko', 'Miljurko', 'Miodrag', 'Miomir', 'Miren', 'Mirko', 'Miro', 'Miroljub', 'Miroslav', 'Mirosav', 'Mirčeta', 'Mitar', 'Mićan', 'Mića', 'Mićo', 'Mihailo', 'Mihajlo', 'Mijailo', 'Mijuško', 'Miško', 'Miša', 'Mišo', 'Mišljen', 'Mladen', 'Mlađen', 'Mlađan', 'Mojsilo', 'Momir', 'Momčilo', 'Mrđan', 'Mrđen', 'Mrkša',
            'Najdan', 'Naum', 'Nebojša', 'Neven', 'Nevenko', 'Negovan', 'Negomir', 'Nedeljko', 'Neđeljko', 'Nemanja', 'Nenad', 'Neško', 'Nestor', 'Nikašin', 'Nikodim', 'Nikodije', 'Nikola', 'Nikša', 'Ninko', 'Nino', 'Ninoslav', 'Nićifor', 'Novak', 'Novica', 'Noviša', 'Novko', 'Novo',
            'Njegomir', 'Njegoš',
            'Obrad', 'Obradin', 'Obren', 'Obrenko', 'Obreten', 'Ognjen', 'Ognjan', 'Ozren', 'Ozriša', 'Oliver', 'Ostoja',
            'Pavle', 'Pavko', 'Pavlić', 'Pavić', 'Pantelija', 'Paun', 'Pejak', 'Pejo', 'Periša', 'Perun', 'Perunko', 'Petar', 'Pera', 'Pero', 'Perica', 'Petak', 'Petko', 'Petoje', 'Petoš', 'Petrašin', 'Petronije', 'Plavša', 'Poznan', 'Prvoslav', 'Predrag', 'Prerad', 'Pribić', 'Prodan', 'Prokopije', 'Puniša', 'Punan', 'Pureš', 'Purko', 'Puro',
            'Radak', 'Radan', 'Radas', 'Radašin', 'Rade', 'Raden', 'Radenko', 'Radeta', 'Radivoje', 'Radivoj', 'Radin', 'Radinko', 'Radič', 'Radiša', 'Radman', 'Radoman', 'Radmilo', 'Radoba', 'Radobud', 'Radovan', 'Radovac', 'Radojica', 'Radoje', 'Radojko', 'Radojlo', 'Radoja', 'Radomir', 'Radonja', 'Radoslav', 'Radosav', 'Radisav', 'Radota', 'Radoš', 'Radukan', 'Radul', 'Radulin', 'Radun', 'Radusin', 'Rađen', 'Rain', 'Raica', 'Raič', 'Raičko', 'Rajak', 'Rajan', 'Rajko', 'Rajčeta', 'Ralen', 'Raleta', 'Ranisav', 'Ranko', 'Raosav', 'Rastislav', 'Rastko', 'Ratibor', 'Ratko', 'Ratomir', 'Rafailo', 'Racko', 'Račeta', 'Raško', 'Rekula', 'Relja', 'Resan', 'Ristan', 'Risto', 'Rista', 'Ristivoje', 'Rodoljub',
            'Sava', 'Savo', 'Savko', 'Samuilo', 'Saša', 'Svetibor', 'Svetislav', 'Svetozar', 'Svetolik', 'Svetoljub', 'Svetomir', 'Svetorad', 'Sekula', 'Selak', 'Simeon', 'Simeun', 'Sima', 'Simo', 'Simon', 'Sinđel', 'Siniša', 'Skorosav', 'Slaven', 'Slavenko', 'Slavko', 'Slaviša', 'Slavo', 'Slavoljub', 'Slavomir', 'Slavuj', 'Sladoje', 'Slađan', 'Slobodan', 'Smiljan', 'Smiljko', 'Smoljan', 'Soko', 'Spasoje', 'Spasoja', 'Spiridon', 'Srbislav', 'Srboslav', 'Srboljub', 'Srdan', 'Srđan', 'Srđa', 'Sredoje', 'Sredoja', 'Sreten', 'Sretko', 'Srećko', 'Srećan', 'Stamenko', 'Stanimir', 'Stanislav', 'Stanisav', 'Staniša', 'Stanko', 'Stanoje', 'Stanojko', 'Stanojlo', 'Stanoja', 'Stefan', 'Stevan', 'Stevo', 'Stevica', 'Stepan', 'Stjepan', 'Stoin', 'Stoić', 'Stojadin', 'Stojak', 'Stojan', 'Stojko', 'Stojmen', 'Stojša', 'Strahinja', 'Strainja',
            'Tadej', 'Tadija', 'Tanasije', 'Tanacko', 'Tatomir', 'Tvrtko', 'Teodor', 'Todor', 'Teodosije', 'Teofil', 'Tešan', 'Timotije', 'Tihomir', 'Toma', 'Tomo', 'Tomaš', 'Tomica', 'Tomislav', 'Toplica', 'Trajan', 'Trajko', 'Trifun', 'Trivun', 'Tripun', 'Tripko', 'Trpko',
            'Ćirilo', 'Ćirko', 'Ćira', 'Ćiro', 'Ćirjak',
            'Uglješa', 'Umiljen', 'Uroš', 'Utješen', 'Utešen',
            'Filip',
            'Hvalimir', 'Hvalislav', 'Hranimir', 'Hranislav', 'Hraniša', 'Hrastimir', 'Hristijan', 'Hristoslav',
            'Cvejan', 'Cvijan', 'Cvetin', 'Cvijetin', 'Cvetko', 'Cvjetko', 'Cvetoje', 'Cvjetoje', 'Cvetoš', 'Cvjetoš', 'Cviko', 'Curko',
            'Časlav', 'Čedomir', 'Čubrilo',
            'Šakota', 'Šale', 'Šumenko', 'Šutan'
        );

        $lastName = array(
            'Abadžić', 'Abdulić', 'Abramić', 'Avalić', 'Avdulić', 'Avrić', 'Aguridić', 'Adamić', 'Azarić', 'Ajdačić', 'Ajdučić', 'Aksentić', 'Aksić', 'Alavantić', 'Aladić', 'Alargić', 'Albijanić', 'Aleksandrić', 'Aleksendrić', 'Aleksić', 'Alimpić', 'Aličić', 'Aljančić', 'Amidžić', 'Ananić', 'Andić', 'Andrejić', 'Andrijanić', 'Andrić', 'Androbić', 'Anđelić', 'Anđić', 'Anđušić', 'Anić', 'Aničić', 'Ankić', 'Anojčić', 'Anokić', 'Antić', 'Antonić', 'Anušić', 'Apelić', 'Apić', 'Arambašić', 'Ardalić', 'Arsenić', 'Arsić', 'Atlagić', 'Aćimić', 'Aćić', 'Acić', 'Ačić', 'Adžić', 'Aškrabić', 'Ašćerić',
            'Babarogić', 'Babić', 'Bavarčić', 'Baveljić', 'Badrić', 'Bajagić', 'Bajandić', 'Bajić', 'Bajičić', 'Bajkić', 'Bajčetić', 'Bajčić', 'Bakić', 'Baletić', 'Balotić', 'Baltić', 'Balšić', 'Banzić', 'Banić', 'Bantulić', 'Banjalić', 'Baralić', 'Barić', 'Barišić', 'Baroševčić', 'Basarić', 'Bastajić', 'Bastašić', 'Bataveljić', 'Batinić', 'Batnožić', 'Baćić', 'Bacetić', 'Bačić', 'Bačkulić', 'Bašić', 'Baštić', 'Bebić', 'Begenišić', 'Bežanić', 'Bekčić', 'Belančić', 'Belić', 'Belogrlić', 'Belodedić', 'Belonić', 'Beljić', 'Bendić', 'Berilažić', 'Berić', 'Besedić', 'Besjedić', 'Biberčić', 'Biberdžić', 'Bibić', 'Bižić', 'Bizetić', 'Bizumić', 'Bijanić', 'Bijelić', 'Bijelonić', 'Bilibajkić', 'Bilić', 'Bilkić', 'Biljić', 'Biljurić', 'Binić', 'Birišić', 'Bisenić', 'Biserić', 'Biserčić', 'Bisić', 'Bjekić', 'Bjeletić', 'Bjelinić', 'Bjelić', 'Bjeličić', 'Bjelkić', 'Bjelovitić', 'Bjelogrlić', 'Bjelonić', 'Bjelotomić', 'Blagić', 'Blagotić', 'Blažarić', 'Blažetić', 'Blažić', 'Blatešić', 'Blendić', 'Blesić', 'Blečić', 'Blešić', 'Boberić', 'Bobić', 'Bobušić', 'Bogatić', 'Bogdanić', 'Bogetić', 'Bogić', 'Bogičić', 'Bodirogić', 'Bodirožić', 'Bodić', 'Bodrožić', 'Božanić', 'Božikić', 'Božić', 'Božičić', 'Bojadić', 'Bojanić', 'Bojić', 'Bojičić', 'Bojkić', 'Bojčetić', 'Bojčić', 'Bokanić', 'Bokonjić', 'Bolić', 'Boltić', 'Boljanić', 'Bontić', 'Bondžić', 'Bondžulić', 'Borikić', 'Borić', 'Boričić', 'Borišić', 'Borjanić', 'Borokić', 'Borotić', 'Borčić', 'Bosančić', 'Bosiljkić', 'Bosiljčić', 'Bosiorčić', 'Bosiočić', 'Bosić', 'Bosnić', 'Botorić', 'Bocić', 'Bocokić', 'Bošnjačić', 'Boštrunić', 'Bradarić', 'Bradić', 'Bradonjić', 'Brajić', 'Braletić', 'Bralić', 'Bralušić', 'Brančić', 'Bratić', 'Bratonožić', 'Brašić', 'Brdarić', 'Brežančić', 'Brezić', 'Brekić', 'Brzić', 'Brisić', 'Brkanlić', 'Brkić', 'Brndušić', 'Brodalić', 'Brodić', 'Broćić', 'Bruić', 'Brujić', 'Brukić', 'Bubić', 'Bubonjić', 'Bugarčić', 'Budalić', 'Budimkić', 'Budimčić', 'Budinčić', 'Budić', 'Budišić', 'Budnić', 'Budurić', 'Buzaretić', 'Bujagić', 'Bujandrić', 'Bujić', 'Bujišić', 'Bujuklić', 'Bukazić', 'Bukvić', 'Bukelić', 'Bukovčić', 'Bukonjić', 'Bukumirić', 'Bukušić', 'Bulajić', 'Bulić', 'Buljubašić', 'Buljugić', 'Bumbić', 'Bunardžić', 'Bunić', 'Bunčić', 'Burgić', 'Burić', 'Burlić', 'Busančić', 'Buckić', 'Bučić', 'Bušetić', 'Bušić',
            'Vagić', 'Vagurić', 'Vajić', 'Vajkarić', 'Vakičić', 'Vanušić', 'Varagić', 'Varaklić', 'Vardalić', 'Varjačić', 'Varničić', 'Vaselić', 'Vasilić', 'Vasić', 'Vašalić', 'Vekić', 'Veletić', 'Velikić', 'Veličić', 'Velišić', 'Veljančić', 'Veljić', 'Vemić', 'Verbić', 'Verbunkić', 'Vergić', 'Verić', 'Verkić', 'Veselić', 'Veseličić', 'Vesić', 'Vesnić', 'Vidarić', 'Vidačić', 'Videkanić', 'Vidić', 'Vilendečić', 'Vilotić', 'Vinokić', 'Vinčić', 'Viorikić', 'Vitakić', 'Vitolić', 'Vićentić', 'Višić', 'Vladetić', 'Vladić', 'Vladičić', 'Vladušić', 'Vlajić', 'Vlajnić', 'Vlajčić', 'Vlaketić', 'Vlasinić', 'Vlasonjić', 'Vlastić', 'Vlačić', 'Vlaškalić', 'Vojičić', 'Vojkić', 'Vojčić', 'Vorgić', 'Vorkapić', 'Voćkić', 'Voštinić', 'Voštić', 'Vranić', 'Vrančić', 'Vratonjić', 'Vračarić', 'Vrekić', 'Vrećić', 'Vrzić', 'Vrtunić', 'Vrugić', 'Vujanić', 'Vujanušić', 'Vujačić', 'Vujetić', 'Vujinić', 'Vujisić', 'Vujić', 'Vujičić', 'Vujnić', 'Vujčetić', 'Vukanić', 'Vukelić', 'Vukić', 'Vukoičić', 'Vukojičić', 'Vukojčić', 'Vukolić', 'Vukomančić', 'Vukosavić', 'Vukotić', 'Vukšić', 'Vuletić', 'Vulešić', 'Vulikić', 'Vulić', 'Vulišić', 'Vucelić', 'Vučelić', 'Vučendić', 'Vučenić', 'Vučetić', 'Vučinić', 'Vučić',
            'Gavarić', 'Gavranić', 'Gavrančić', 'Gavrić', 'Gagić', 'Gagričić', 'Gajanić', 'Gajetić', 'Gajić', 'Gajičić', 'Gajtanić', 'Galetić', 'Galić', 'Galonić', 'Galonjić', 'Gambelić', 'Garačić', 'Gardić', 'Garić', 'Garotić', 'Gatarić', 'Gačić', 'Gadžić', 'Gašić', 'Gvozdenić', 'Gvozdić', 'Gvoić', 'Gvojić', 'Genčić', 'Gerzić', 'Gizdavić', 'Gilić', 'Glavendekić', 'Glavinić', 'Glavonić', 'Glavonjić', 'Glavčić', 'Glamočić', 'Gledić', 'Gležnić', 'Glibetić', 'Gligić', 'Gligorić', 'Gligurić', 'Glintić', 'Glišić', 'Gloginjić', 'Glomazić', 'Gluvajić', 'Glumičić', 'Gmizić', 'Gnjatić', 'Gobeljić', 'Gogić', 'Gojgić', 'Goncić', 'Goranić', 'Gorančić', 'Gordanić', 'Gordić', 'Goronjić', 'Gospavić', 'Gostić', 'Gostojić', 'Gocić', 'Gošnjić', 'Grabić', 'Grabovčić', 'Gradić', 'Gramić', 'Grandić', 'Granolić', 'Granulić', 'Graonić', 'Grašić', 'Grbić', 'Grečić', 'Grkinić', 'Grozdanić', 'Grozdić', 'Grokanić', 'Gromilić', 'Grubačić', 'Grubetić', 'Grubešić', 'Grubić', 'Grubišić', 'Grubješić', 'Grublješić', 'Grubnić', 'Gružanić', 'Grujanić', 'Grujić', 'Grujičić', 'Grumić', 'Guberinić', 'Gudurić', 'Gužvić', 'Gujaničić', 'Gurešić', 'Guconić', 'Gudžulić', 'Gušić',
            'Dabarčić', 'Dabetić', 'Dabić', 'Davinić', 'Dajić', 'Dajlić', 'Damjanić', 'Dangić', 'Dangubić', 'Daničić', 'Danojlić', 'Dardić', 'Dafunić', 'Dačić', 'Dvokić', 'Dvorančić', 'Dvornić', 'Debelnogić', 'Devedžić', 'Dedić', 'Dejanić', 'Delić', 'Demić', 'Demonjić', 'Denić', 'Denkić', 'Denčić', 'Derajić', 'Deretić', 'Derikonjić', 'Deronjić', 'Desančić', 'Despenić', 'Despinić', 'Despić', 'Deurić', 'Dešić', 'Divić', 'Divnić', 'Divčić', 'Dikić', 'Diklić', 'Dikosavić', 'Dimanić', 'Dimitrić', 'Dimić', 'Dimkić', 'Dimčić', 'Dinić', 'Dinkić', 'Dinčić', 'Diskić', 'Dičić', 'Dobranić', 'Dobratić', 'Dobrić', 'Dobričić', 'Dovijanić', 'Dogandžić', 'Doganjić', 'Dodić', 'Dokić', 'Doknić', 'Dolinić', 'Dončić', 'Dorontić', 'Dostanić', 'Dostić', 'Dostičić', 'Dotlić', 'Dravić', 'Draganić', 'Draginčić', 'Dragić', 'Dragišić', 'Dragoljić', 'Dragonjić', 'Dragoslavić', 'Dragotić', 'Dragušić', 'Dražić', 'Drajić', 'Drakulić', 'Dramlić', 'Drangić', 'Draškić', 'Drezgić', 'Drekić', 'Drenić', 'Drinić', 'Drinčić', 'Družetić', 'Drulić', 'Drčelić', 'Dubajić', 'Dubačkić', 'Dubonjić', 'Dugalić', 'Dugić', 'Dugonjić', 'Dudić', 'Dukić', 'Dumanjić', 'Dumeljić', 'Dumitrikić', 'Dumnić', 'Dumonić', 'Dunčić', 'Dunjić', 'Duronjić', 'Dučić', 'Dušanić',
            'Đajić', 'Đakušić', 'Đapić', 'Đekić', 'Đelić', 'Đelkapić', 'Đenadić', 'Đenisić', 'Đenić', 'Đerić', 'Đikić', 'Đinđić', 'Đokić', 'Đorđić', 'Đorić', 'Đuzić', 'Đujić', 'Đukarić', 'Đukelić', 'Đuketić', 'Đukić', 'Đuknić', 'Đuragić', 'Đurakić', 'Đurđić', 'Đuretić', 'Đurić', 'Đuričić', 'Đurišić', 'Đurkić', 'Đusić',
            'Evđenić', 'Egarić', 'Egerić', 'Egić', 'Ekmečić', 'Ekmedžić', 'Ergić', 'Eremić', 'Erić', 'Erletić', 'Erčić',
            'Žagrić', 'Žarić', 'Žarkić', 'Žepinić', 'Žeravić', 'Žeravčić', 'Žerajić', 'Žestić', 'Živanić', 'Živankić', 'Živić', 'Životić', 'Žigić', 'Žižić', 'Žikelić', 'Žikić', 'Žiletić', 'Žilić', 'Žmirić', 'Žmukić', 'Žmurić', 'Žugić', 'Žunić', 'Žutić', 'Žutobradić', 'Zaburnić', 'Zavišić', 'Zagorčić', 'Zakić', 'Zapukić', 'Zaradić', 'Zarić', 'Zatežić', 'Zaharić', 'Zbiljić', 'Zvekić', 'Zvizdić', 'Zdravić', 'Zdujić', 'Zebić', 'Zekavičić', 'Zekić', 'Zelić', 'Zimonjić', 'Zinaić', 'Zinajić', 'Zisić', 'Zjajić', 'Zjalić', 'Zjačić', 'Zlatić', 'Zličić', 'Zlovarić', 'Zojkić', 'Zokić', 'Zolotić', 'Zorbić', 'Zorić', 'Zoričić', 'Zorkić', 'Zrakić', 'Zrilić', 'Zrnić', 'Zubić', 'Zurnić',
            'Ibrić', 'Ivanić', 'Ivantić', 'Ivančić', 'Ivezić', 'Ivetić', 'Ivić', 'Ivičić', 'Ivucić', 'Igić', 'Ignjatić', 'Ignjić', 'Ijačić', 'Ikić', 'Ikonić', 'Ilibašić', 'Ilijić', 'Ilikić', 'Ilinčić', 'Ilisić', 'Ilić', 'Iličić', 'Ilkić', 'Inđić', 'Irić', 'Ičelić',
            'Jablančić', 'Javorić', 'Jagličić', 'Jagodić', 'Jakić', 'Jakišić', 'Jakonić', 'Jakšić', 'Jalić', 'Jandrić', 'Janikić', 'Janić', 'Janičić', 'Jankelić', 'Jankić', 'Janojkić', 'Jančić', 'Jančurić', 'Janjić', 'Janjušić', 'Jarić', 'Jasnić', 'Jašić', 'Jevdoksić', 'Jevđenić', 'Jeveričić', 'Jević', 'Jevrić', 'Jevtić', 'Jegdić', 'Jezdić', 'Jezerkić', 'Jelačić', 'Jelašić', 'Jelenić', 'Jelesić', 'Jelikić', 'Jelisavčić', 'Jelisić', 'Jelić', 'Jeličić', 'Jelušić', 'Jenić', 'Jergić', 'Jeremić', 'Jerinić', 'Jerinkić', 'Jerosimić', 'Jerotić', 'Jerčić', 'Jesretić', 'Jestrotić', 'Jeftenić', 'Jeftić', 'Ječmenić', 'Ješić', 'Jovakarić', 'Jovandić', 'Jovanetić', 'Jovanić', 'Jovankić', 'Jovančić', 'Jovadžić', 'Jovelić', 'Joveljić', 'Jovetić', 'Jovešić', 'Jovikić', 'Jović', 'Jovičić', 'Jovišić', 'Jovkić', 'Jovonić', 'Jovčić', 'Jozić', 'Jojić', 'Jojčić', 'Jokić', 'Jokičić', 'Joksić', 'Jolić', 'Jonikić', 'Jonić', 'Joničić', 'Jonkić', 'Jontić', 'Jončić', 'Jorgić', 'Jorgonić', 'Josić', 'Jocić', 'Juzbašić', 'Jukić', 'Jungić', 'Jurišić', 'Juškić',
            'Kavalić', 'Kajganić', 'Kalabić', 'Kalajić', 'Kalajdžić', 'Kalendić', 'Kalenić', 'Kalinić', 'Kamperelić', 'Kandić', 'Kanlić', 'Kanjerić', 'Karavidić', 'Karagić', 'Karajčić', 'Karaklajić', 'Karaleić', 'Karalejić', 'Karalić', 'Karapandžić', 'Karatošić', 'Karaulić', 'Karadžić', 'Karić', 'Karišić', 'Karličić', 'Katanić', 'Katić', 'Kaćurić', 'Kačaniklić', 'Kašerić', 'Kvrgić', 'Kendrišić', 'Kentrić', 'Kepić', 'Kesić', 'Kečkić', 'Kijačić', 'Kimčetić', 'Kiselčić', 'Kitanić', 'Kitić', 'Kitonjić', 'Kičić', 'Klevernić', 'Klepić', 'Klinić', 'Klipić', 'Klisarić', 'Klisurić', 'Kličarić', 'Kljajić', 'Kljakić', 'Knežić', 'Kovanušić', 'Kovandžić', 'Kovarbašić', 'Kovačić', 'Kovinić', 'Kovinčić', 'Kovjanić', 'Kovjenić', 'Kovljenić', 'Kozić', 'Kojanić', 'Kojić', 'Kojičić', 'Kojčić', 'Kojundžić', 'Kolavčić', 'Kolarić', 'Kolačarić', 'Količić', 'Kolundžić', 'Koljančić', 'Komadinić', 'Komarčić', 'Komlenić', 'Komnenić', 'Kondić', 'Kontić', 'Konculić', 'Konjikušić', 'Koraksić', 'Kordić', 'Korugić', 'Koružić', 'Kosanić', 'Kosić', 'Kosnić', 'Kosorić', 'Kostić', 'Kotarlić', 'Kotlajić', 'Kočić', 'Kodžopeljić', 'Košarić', 'Košpić', 'Košutić', 'Kravarušić', 'Kravić', 'Kragić', 'Krainčanić', 'Krantić', 'Krasavčić', 'Krasić', 'Krezić', 'Krejić', 'Kremić', 'Kremonjić', 'Krestić', 'Krivošić', 'Krkeljić', 'Krkić', 'Krkobabić', 'Krnetić', 'Krnjajić', 'Krnjeušić', 'Krompić', 'Krotić', 'Krpić', 'Krsmanić', 'Krsmić', 'Krstajić', 'Krstekanić', 'Krstinić', 'Krstić', 'Krstičić', 'Krstonić', 'Krstonošić', 'Krtinić', 'Krunić', 'Kruškonjić', 'Kršić', 'Kuveljić', 'Kudrić', 'Kuzmić', 'Kujavić', 'Kujačić', 'Kujundžić', 'Kukrić', 'Kulezić', 'Kulizić', 'Kulišić', 'Kulundžić', 'Kuljančić', 'Kuljić', 'Kumrić', 'Kureljušić', 'Kurilić', 'Kursulić', 'Kurucić', 'Kurčubić', 'Kusonić', 'Kusonjić', 'Kusturić', 'Kutlačić', 'Kutlešić', 'Kušić', 'Kušljić',
            'Labotić', 'Lavrnić', 'Lažetić', 'Lazendić', 'Lazetić', 'Lazić', 'Lazičić', 'Lazukić', 'Lajšić', 'Laketić', 'Lakić', 'Lalić', 'Lambić', 'Lapčić', 'Lastić', 'Latinčić', 'Leburić', 'Ležaić', 'Ležajić', 'Lekanić', 'Lekić', 'Lemaić', 'Lemajić', 'Leposavić', 'Lesendrić', 'Lečić', 'Leštarić', 'Lijeskić', 'Likodrić', 'Likušić', 'Lilić', 'Lipovčić', 'Lisičić', 'Lišančić', 'Lovrić', 'Lozanić', 'Lojaničić', 'Lolić', 'Lomić', 'Lopandić', 'Lubardić', 'Lubinić', 'Luburić', 'Lugonjić', 'Lužaić', 'Lužajić', 'Lukajić', 'Lukačić', 'Lukendić', 'Lukić', 'Lukičić', 'Lunić', 'Lutkić', 'Lučić',
            'Ljamić', 'Ljeganušić', 'Ljotić', 'Ljubanić', 'Ljubić', 'Ljubičić', 'Ljubišić', 'Ljušić', 'Ljuškić',
            'Maglić', 'Majkić', 'Makarić', 'Makivić', 'Makragić', 'Maksić', 'Malavrazić', 'Malbašić', 'Malenčić', 'Maletić', 'Malešić', 'Malinić', 'Mališić', 'Malobabić', 'Malušić', 'Maljugić', 'Maljčić', 'Mandarić', 'Mandinić', 'Mandić', 'Mandušić', 'Manić', 'Mančić', 'Manjenčić', 'Maravić', 'Marinčić', 'Marić', 'Maričić', 'Markagić', 'Markelić', 'Markeljić', 'Markulić', 'Marodić', 'Martić', 'Marunić', 'Marunkić', 'Marušić', 'Marčetić', 'Marčić', 'Masalušić', 'Maslarić', 'Maslić', 'Maslovarić', 'Matarugić', 'Matejić', 'Materić', 'Matić', 'Matičić', 'Matušić', 'Maćešić', 'Maćić', 'Mačić', 'Mačkić', 'Mačužić', 'Mašić', 'Medić', 'Medurić', 'Mektić', 'Mesulić', 'Mijalčić', 'Mijanić', 'Mijačić', 'Mijić', 'Mijucić', 'Mikarić', 'Mikelić', 'Miketić', 'Mikić', 'Mikičić', 'Mikonjić', 'Mikulić', 'Miladić', 'Milakić', 'Milačić', 'Milekić', 'Milenić', 'Miletić', 'Mileusnić', 'Milešić', 'Milijić', 'Milikić', 'Milikšić', 'Milinić', 'Milinčić', 'Milisavić', 'Miličić', 'Milić', 'Milišić', 'Milkić', 'Miloičić', 'Milojić', 'Milojičić', 'Milojkić', 'Milojčić', 'Milotić', 'Milunić', 'Milušić', 'Milčić', 'Miljanić', 'Mindić', 'Minić', 'Minčić', 'Miovčić', 'Miodanić', 'Mionić', 'Miražić', 'Mirić', 'Mirjanić', 'Mirkić', 'Mirosavić', 'Mirčetić', 'Mirčić', 'Misojčić', 'Mitić', 'Mitranić', 'Mitrekanić', 'Mitrić', 'Mitrušić', 'Mićić', 'Mihaljčić', 'Miholjčić', 'Mišeljić', 'Mišić', 'Miškić', 'Mišurić', 'Mladić', 'Mladžić', 'Mojsić', 'Mokrić', 'Momić', 'Moračić', 'Moretić', 'Morokvašić', 'Motičić', 'Mrakić', 'Mračić', 'Mrdić', 'Mrkić', 'Mrkonjić', 'Mrkušić', 'Mrkšić', 'Mudrinić', 'Mudrić', 'Munišić', 'Murganić', 'Mutavdžić', 'Mutibarić', 'Mučibabić', 'Mušikić',
            'Navalušić', 'Nagradić', 'Nagulić', 'Nadaškić', 'Najdić', 'Najkić', 'Nakalamić', 'Nakić', 'Narančić', 'Narandžić', 'Nastasić', 'Nastić', 'Nebrigić', 'Nevajdić', 'Nevenić', 'Negoicić', 'Nedinić', 'Nedić', 'Nekić', 'Nemanjić', 'Nenadić', 'Nenić', 'Neoričić', 'Nešić', 'Nikezić', 'Niketić', 'Nikitić', 'Nikoletić', 'Nikolešić', 'Nikolić', 'Nikolčić', 'Nikšić', 'Ninić', 'Ninčić', 'Ničić', 'Nišavić', 'Nišić', 'Novalušić', 'Novarlić', 'Novačikić', 'Nović', 'Novičić', 'Novčić', 'Nožinić', 'Nojkić', 'Njegić', 'Njegrić', 'Nježić',
            'Obrenić', 'Odavić', 'Ozimić', 'Ojdanić', 'Ojkić', 'Oketić', 'Okolić', 'Okulić', 'Olarić', 'Olić', 'Olujić', 'Oljačić', 'Opalić', 'Oparušić', 'Opačić', 'Oprikić', 'Oprić', 'Opricić', 'Oraovčić', 'Orlandić', 'Orlić', 'Osmajlić', 'Ostojić', 'Ocokoljić', 'Odžić',
            'Pavić', 'Pavičić', 'Pavlekić', 'Pavličić', 'Pavčić', 'Padić', 'Pajagić', 'Pajić', 'Pajičić', 'Pajkić', 'Pajtić', 'Palalić', 'Palangetić', 'Paligorić', 'Palić', 'Paninčić', 'Panić', 'Panišić', 'Pantelić', 'Pantić', 'Pančić', 'Pandžić', 'Papić', 'Paprić', 'Papulić', 'Paramentić', 'Paraušić', 'Parivodić', 'Parlić', 'Parojčić', 'Patrnogić', 'Paunić', 'Pašić', 'Pejić', 'Pejičić', 'Pejušić', 'Pejčić', 'Pelagić', 'Pendić', 'Penezić', 'Penčić', 'Pepić', 'Perenić', 'Perić', 'Peričić', 'Perišić', 'Perjaničić', 'Perkić', 'Perotić', 'Peruničić', 'Perčić', 'Petkanić', 'Petrikić', 'Petrić', 'Petričić', 'Petronić', 'Petrušić', 'Peulić', 'Pecić', 'Pečeničić', 'Pešić', 'Pikić', 'Pilindavić', 'Piljagić', 'Piperčić', 'Pirivatrić', 'Pirić', 'Pisarić', 'Pitulić', 'Pjanić', 'Pjević', 'Plavić', 'Plavkić', 'Plavljanić', 'Plavšić', 'Plazinić', 'Planinčić', 'Planić', 'Platanić', 'Plačić', 'Plemić', 'Pleskonjić', 'Plećić', 'Plintić', 'Plisnić', 'Ploskić', 'Pločić', 'Pljakić', 'Pljevaljčić', 'Pobulić', 'Podinić', 'Podraščić', 'Podrić', 'Poznanić', 'Poznić', 'Pojkić', 'Polić', 'Polomčić', 'Polugić', 'Ponjavić', 'Pop Lazić', 'Popadić', 'Poparić', 'Popčić', 'Potrebić', 'Poštić', 'Pravdić', 'Pražić', 'Predić', 'Prekić', 'Prelić', 'Prendić', 'Prešić', 'Pržić', 'Pribić', 'Pribišić', 'Prigodić', 'Prijić', 'Prikić', 'Prišić', 'Prodanić', 'Prokić', 'Prokopić', 'Prolić', 'Protić', 'Prošić', 'Pruginić', 'Prunić', 'Pršendić', 'Pualić', 'Puvalić', 'Puvačić', 'Pudarić', 'Punišić', 'Purešić', 'Purić', 'Purišić', 'Puslojić', 'Pušeljić',
            'Ravilić', 'Radančić', 'Radeljić', 'Radetić', 'Radešić', 'Radivojšić', 'Radikić', 'Radisavić', 'Radić', 'Radičić', 'Radišić', 'Radnić', 'Radoičić', 'Radojičić', 'Radojkić', 'Radojčić', 'Radonić', 'Radonjić', 'Radosavkić', 'Radotić', 'Radukić', 'Radulić', 'Raduljčić', 'Raducić', 'Radušić', 'Razumenić', 'Railić', 'Raičić', 'Rajačić', 'Rajić', 'Rajičić', 'Rajlić', 'Rajčetić', 'Rajčić', 'Rajšić', 'Rakezić', 'Raketić', 'Rakinić', 'Rakitić', 'Rakić', 'Rakonić', 'Raletić', 'Ralić', 'Raljić', 'Ramić', 'Ranđić', 'Ranisavić', 'Rankić', 'Rančić', 'Raonić', 'Rapaić', 'Rapajić', 'Rasulić', 'Ratkelić', 'Raulić', 'Racić', 'Račić', 'Rašetić', 'Rašić', 'Rašljić', 'Regodić', 'Regulić', 'Rekalić', 'Reljić', 'Remetić', 'Rendulić', 'Repašić', 'Resimić', 'Redžić', 'Ribarić', 'Riboškić', 'Riđošić', 'Riznić', 'Rinčić', 'Risimić', 'Ristanić', 'Ristić', 'Rogić', 'Roglić', 'Rogonjić', 'Rogulić', 'Rodić', 'Rozgić', 'Rokvić', 'Roknić', 'Roksandić', 'Romanić', 'Romić', 'Rosić', 'Roškić', 'Ruvidić', 'Rudić', 'Rudonjić', 'Ružić', 'Rumenić', 'Rundić', 'Runjajić', 'Rusalić', 'Rutešić', 'Rutonić', 'Ruškić',
            'Sabljić', 'Savandić', 'Savatić', 'Savelić', 'Saveljić', 'Savić', 'Savičić', 'Savkić', 'Savurdić', 'Savčić', 'Salatić', 'Samardžić', 'Sandić', 'Sapardić', 'Saramandić', 'Sarić', 'Satarić', 'Svetličić', 'Svilarić', 'Svojić', 'Sekanić', 'Sekulić', 'Selenić', 'Sendrić', 'Senić', 'Seničić', 'Sentić', 'Setenčić', 'Sibinkić', 'Sibinčić', 'Sikimić', 'Simanić', 'Simendić', 'Simetić', 'Simić', 'Simurdić', 'Sinđelić', 'Sinđić', 'Sinkić', 'Sitničić', 'Sjeničić', 'Skakić', 'Skelić', 'Skendžić', 'Skerlić', 'Skokić', 'Skočajić', 'Skočić', 'Skrobić', 'Skulić', 'Slavić', 'Slavnić', 'Sladić', 'Slović', 'Smilić', 'Smiljanić', 'Smiljić', 'Smiljkić', 'Smoljanić', 'Smrekić', 'Sovrlić', 'Sovtić', 'Sojkić', 'Sokić', 'Soknić', 'Soldatić', 'Sorajić', 'Soskić', 'Sofijanić', 'Sofranić', 'Sofrenić', 'Sofronić', 'Spaić', 'Spakić', 'Sparić', 'Spasenić', 'Spasić', 'Spenčić', 'Sperlić', 'Spirić', 'Spremić', 'Spužić', 'Sredić', 'Sretić', 'Stavrić', 'Stajić', 'Stajkić', 'Stajčić', 'Stajšić', 'Stakić', 'Stakušić', 'Stamatić', 'Stambolić', 'Stamenić', 'Stamenčić', 'Stanarčić', 'Stanetić', 'Stanikić', 'Stanisavić', 'Stanić', 'Staničić', 'Stanišić', 'Stankić', 'Stanovčić', 'Stanojčić', 'Stanušić', 'Stančetić', 'Stančić', 'Stašić', 'Stevandić', 'Stevanetić', 'Stevanić', 'Stevelić', 'Stević', 'Stevčić', 'Stegić', 'Stegnjaić', 'Stegnjajić', 'Stekić', 'Steljić', 'Stepandić', 'Stepanić', 'Stepić', 'Stijačić', 'Stijepić', 'Stikić', 'Stjepić', 'Stožinić', 'Stojanić', 'Stojankić', 'Stojančić', 'Stojačić', 'Stojić', 'Stojičić', 'Stojkić', 'Stojnić', 'Stojčić', 'Stojšić', 'Stokanić', 'Stokić', 'Stolić', 'Stoparić', 'Stopić', 'Stošić', 'Strajnić', 'Strahinić', 'Strahinjić', 'Strinić', 'Subotić', 'Suvajdžić', 'Sumenić', 'Sunarić', 'Surlić', 'Suručić',
            'Tadić', 'Tajsić', 'Tamindžić', 'Tanasić', 'Tanić', 'Tankosić', 'Tančić', 'Tarabić', 'Tasić', 'Tatišić', 'Tvrdišić', 'Teodosić', 'Tepić', 'Tepšić', 'Terzić', 'Teslić', 'Tešanić', 'Tešankić', 'Tešendić', 'Tešinić', 'Tešić', 'Tijanić', 'Timilić', 'Timotić', 'Tirić', 'Tirnanić', 'Tmušić', 'Tovarišić', 'Todić', 'Todorić', 'Todosić', 'Tojić', 'Tokalić', 'Toljagić', 'Tomanić', 'Tomecić', 'Tominčić', 'Tomić', 'Tomičić', 'Tomonjić', 'Tomčić', 'Tontić', 'Tončić', 'Topić', 'Topličić', 'Topolić', 'Toskić', 'Tošanić', 'Tošić', 'Travorić', 'Traparić', 'Trenčić', 'Trivalić', 'Trivić', 'Trivunić', 'Trivunčić', 'Trijić', 'Trikić', 'Trindić', 'Tripić', 'Trifunjagić', 'Trišić', 'Trmčić', 'Trninić', 'Trnić', 'Trošić', 'Trubajić', 'Trudić', 'Trujić', 'Trujkić', 'Tubonjić', 'Tukelić', 'Tumarić', 'Tupajić', 'Turajlić', 'Turnić', 'Turudić', 'Turunčić', 'Tutić', 'Tutorić', 'Tutulić', 'Tufegdžić', 'Tucić',
            'Ćajić', 'Ćalić', 'Ćatić', 'Ćebić', 'Ćelić', 'Ćeranić', 'Ćipranić', 'Ćirić', 'Ćirjanić', 'Ćojbašić', 'Ćopić', 'Ćorić', 'Ćosić', 'Ćuić', 'Ćujić', 'Ćupić', 'Ćurdić', 'Ćurić', 'Ćurčić', 'Ćušić',
            'Ubavić', 'Ubavkić', 'Uvalić', 'Uverić', 'Uglješić', 'Ugrinić', 'Ugrinčić', 'Ugričić', 'Udovičić', 'Udovčić', 'Umeljić', 'Umetić', 'Umiljendić', 'Uršikić', 'Ustić', 'Utvić', 'Ušendić',
            'Farkić', 'Fatić', 'Femić', 'Filipić', 'Fotirić', 'Fotić', 'Frtunić', 'Hadži Antić', 'Hadži Jovančić', 'Hadži Nikolić', 'Hadži Ristić', 'Hadži Tančić', 'Hadžić', 'Hinić', 'Hristić',
            'Cajić', 'Cakić', 'Carić', 'Caričić', 'Cvejić', 'Cvetić', 'Cvijetić', 'Cvijić', 'Cvikić', 'Cvišić', 'Cenić', 'Cenkić', 'Civišić', 'Civrić', 'Ciglić', 'Ciklušić', 'Cicvarić', 'Cmiljanić', 'Cmolić', 'Conić', 'Crnovčić', 'Cukanić', 'Cukić', 'Cuparić',
            'Čabrić', 'Čavić', 'Čajić', 'Čalenić', 'Čalić', 'Čamagić', 'Čantrić', 'Čaprnjić', 'Čarapić', 'Čarnić', 'Čvokić', 'Čvorić', 'Čeleketić', 'Čemerikić', 'Čečarić', 'Čivčić', 'Čikarić', 'Čikić', 'Čiplić', 'Čipčić', 'Čičić', 'Čkovrić', 'Čobelić', 'Čobeljić', 'Čović', 'Čojić', 'Čojčić', 'Čolanić', 'Čolić', 'Čomić', 'Čonkić', 'Čonjagić', 'Čorbić', 'Čotrić', 'Čočurić', 'Čubrić', 'Čudić', 'Čukarić', 'Čukić', 'Čumić', 'Čupeljić', 'Čuperkić', 'Čupić', 'Čuturić',
            'Džavrić', 'Džajić', 'Džambić', 'Džadžić', 'Dželebdžić', 'Džikić', 'Džinić', 'Džodić', 'Džombić', 'Džomić', 'Džonić',
            'Šakić', 'Šakotić', 'Šalinić', 'Šamatić', 'Šantić', 'Šapić', 'Šaponić', 'Šaponjić', 'Šapurić', 'Šarančić', 'Šarić', 'Šarkić', 'Šaronjić', 'Šašić', 'Švabić', 'Ševarlić', 'Šević', 'Ševkušić', 'Šestić', 'Šibalić', 'Šijakinjić', 'Šijačić', 'Šikanić', 'Šikanjić', 'Šimšić', 'Šipetić', 'Šišić', 'Šljivić', 'Šljukić', 'Šmigić', 'Šobajić', 'Šobačić', 'Šorgić', 'Šoškić', 'Špirić', 'Štakić', 'Štulić', 'Šubakić', 'Šubarić', 'Šubić', 'Šuleić', 'Šulejić', 'Šuletić', 'Šulkić', 'Šuluburić', 'Šuljagić', 'Šumatić', 'Šunderić', 'Šunkić', 'Šunjevarić', 'Šutuljić', 'Šušić', 'Šušulić'
        );

        $telefon = array(
            '+382204581',
            '+382673154',
            '+382692267',
            '+3826798712',
            '+382684561',
            '+382401298',
        );

        return [
            'ime' => $this->faker->randomElement($firstName),
            'prezime' => $this->faker->randomElement($lastName),
            'telefon' => $this->faker->randomElement($telefon),
            'telefon_viber' => $this->faker->boolean(),
            'telefon_whatsapp' => $this->faker->boolean(),
            'telefon_facetime' => $this->faker->boolean(),
            'email' => $this->faker->safeEmail()
        ];
    }
}
