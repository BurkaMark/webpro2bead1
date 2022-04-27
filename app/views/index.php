<?php
    require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="index">
    <divc class="index_container" onlode="hideText()">
        <h1>Magyar Tanösvény Szövetség (MaTaSz)</h1>
        <h2>Minden, ami természet, túra</h2>

        <button class="textButton" onclick="hideUnhideText('about')">Rólunk</button>

        <div id="about" hidden>
            <p>
                Szövetségünk azért dolgozik, hogy minnél szélesebb körben ismerté tegyük hazánk tanösvényeit. Bízunk abban, 
                hogy weboldalunk elősegítiheti a nagyobb látogatottságot és egyre többen látogatják meg a szebbnél szebb 
                vidékeken található ösvényeket.<br>
                Tesszük mindezt non-profit módon, ám minden támogatást szívesen fogadunk, melyeket teljes mértékben a tanösvények 
                népszerűsítésére, valamint események és rendezvények megszervezésére fordítunk.<br>
                További információra lenne szüksége? Kérdése volna rólunk, vagy a tanösvényekről? Kérjük, lépjen kapcsolatba velünk 
                a lentebb található lehetőségek egyikén!
            </p>
        </div>
        <br>

        <button class="textButton" onclick="hideUnhideText('history')">Rövid történetünk</button>

        <div id="history" hidden>
            <h2>A kezdetek</h2>
            <p>
                Szövetségünk alapító tagjai lelkes túrázók, természetjárók. Bár többnyire baráti társaságukkal, kollégákkal járták a természetet, 
                többször részt vettek közösségi oldalakon meghírdetett, nyitott túrázási eseményeken. Többen így ismerkedtek meg egymással.<br>
                Kis időn belül létrehoztak maguknak egy csoportot a közösségi oldalon, ahova már az alapítók többi tagjai is csatlakoztak.<br>
                Végül 2018-ban, egy közös, az ország több tanösvényét meglátogató, túra alkalmával arra jutottak, hogy a tanösvényekről 
                nem található egy közös felület, ahol könnyen megtalálhatók információk az ösvényekről és ezen változtatni kell.
            </p>
            <h2>A megalakulás</h2>
            <p>
                Miközben elkezdődött a szerveződés, tervezés, felszinre kerültek olyan információk is, hogy események, rendezvények, hírek és 
                látogatói vélemények közzétételére is szükség lenne. Továbbá ennek az összefogását hivatalosan, non-profit módon is végezhetik.<br>
                Ezért megszületett a döntés, hogy létrehoznak egy szervezetet, melynek a fő célja a tanösvényekkel kapcsolatos hírek és információk 
                összegyűjtése és közzététele. Jogászi tanácsadás mellet összeállításra került a szervezet felépítése, hivatalos okmányok elkészítése 
                és a megalapítás.
            </p>
            <h2>Az alapítás óta és a jövő</h2>
            <p>
                Szövetségünk megalakulása óta sikerült összeállítani az adatbázist Magyarországon taláható összes tanösvényről. E honlap ezen 
                közzétételéért jött létre, valamint, hogy az ösvényekkel kapcsolatos hírek, látogatói beszámolók is egy helyen megtalálhatóak
                legyenek.<br>
                Szeretnénk a jövőben, a jelenlegi adatok karbantartása mellett, a szomszédos országokban található tanösvényeket is összegyűjteni, 
                hogy, aki külföldi túrán gondolkodik, az is megtalálhassa honlapunkon a szükséges információkat.
            </p>
        </div>
        <br>

        <button class="textButton" onclick="hideUnhideText('contacts')">Kapcsolat</button>

        <div id="contacts" hidden>
            <p>
                MaTaSz Nonprofit Kft.<br>
                Címünk: 1145 Budapest, Torontál utca 47/b.<br>
                Tel.: 0612234689<br>
                E-mail: info@matesz.hu<br>
            </p>
        </div>

        <script>
            function hideUnhideText($id)
            {
                var text = document.getElementById($id);
                if(text.hasAttribute("hidden"))
                {
                    text.removeAttribute("hidden");
                }
                else
                {
                    text.setAttribute("hidden", "true");
                }
            }
        </script>
    </div>
</div>
</body>