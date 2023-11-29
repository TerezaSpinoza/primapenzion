<?php
//nastartujem session, abychom mohli udelat prihlasovani a odhlasovani
session_start();
//tady rovnou pripojime data
require_once "./data.php";
$aktivniInstance = "";

//zpracujem login form
if (array_key_exists("login-submit", $_POST)) {
  $zadaneJmeno = $_POST["jmeno"];
  $zadaneHeslo = $_POST["heslo"];

  if ($zadaneJmeno == "admin" && $zadaneHeslo == "cici123") {
    $_SESSION["jePrihlasen"] = true;
  }
}

//zpracujeme logout form
if (array_key_exists("logout-submit", $_GET)) {
  //odstranime ty udaje ze session
  unset($_SESSION["jePrihlasen"]);
  header("Location: ?");
  exit;
}

//kontrola zda je uzivatel prihlaseny
//nektere operace chcem porvest jen kdyz je prihlaseny
if (array_key_exists("jePrihlasen", $_SESSION)) {
    //zpracujeme mazani stranky
  if (array_key_exists("delete", $_GET)) {
    $idStranky = $_GET["delete"];
    $poleStranek[$idStranky]->smazMe();
    header("Location: ?");
    exit;
  }

  if (array_key_exists("new", $_GET)) {
    //vytvorime instanci, ktera bude mit ve vsech vlastnostech prazdny string
    $aktivniInstance = new Stranka("","","","");
  }

  //zpracujeme formular pro editovani stranky
  if (array_key_exists("edit", $_GET)) {
      $idStranky = $_GET["edit"];
      //najdeme instanci, kterou uzivatel chce editovat
      $aktivniInstance = $poleStranek[$idStranky];
  }

  //zpracujeme formular pro ulozeni stranky
  if (array_key_exists("aktualizovat-submit", $_POST)) {
    //kontrola, zda id neni prazdne a pokud ano, tak ho odkazeme zpet na HP adminu
    if (trim($_POST["id-stranky"]) == "") { //tomuto IFu se rika guarding clause
      header("Location: ?");
      exit;
    }

    //vytahneme data z formulare
    $idStranky = trim($_POST["id-stranky"]); //jeste udelame trim zde, aby nehazely mezery chyby
    $titulekStranky = $_POST["titulek-stranky"];
    $menuStranky = $_POST["menu-stranky"];
    $obrazekStranky = $_POST["obrazek-stranky"];
    //vlozime tato data do instance
    $aktivniInstance->setId($idStranky);
    $aktivniInstance->setTitulek($titulekStranky);
    $aktivniInstance->setMenu($menuStranky);
    $aktivniInstance->setObrazek($obrazekStranky);

    //propiseme zmeny do DB
    $aktivniInstance->propisDoDb();

    //zjistime si novy obsah texarea
    $obsahStranky = $_POST["obsah-stranky"];

    //nyni zavolame metodu setObsah a do argumentu dame ten novy text souboru
    $aktivniInstance->setObsah($obsahStranky);

    //presmerujeme ho na novou url s novym id 
    header("Location: ?edit=$idStranky");
    exit;
  }
}//endKontrolaPrihlaseni

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin sekce</title>
</head>
<body>
  <h1>Admin sekce</h1>

<?php
//ted udelame dve verze stranek pro ne/prihlasene

if (array_key_exists("jePrihlasen", $_SESSION)) {
  //vypiseme verzi stranky pro prihlasene
  echo "<a href='?logout-submit'>Odhlásit se</a>";

  //pripojime seznam stranek a editor stranek
  require_once "./seznam-stranek.php";
  
  echo "<hr>";
  //toto je odkaz, ktery zapisujem jako GET formular a zobrazime uzivateli prazdny WYSIWYG
  echo "<a href='?new'>VYTVOŘIT NOVOU STRÁNKU</a>";
  echo "<hr>";

  
  if ($aktivniInstance != "") { //musel uzivatel zvolit konkretni stranku k editaci - ne kdyz to bude prazdny/NULL
    require_once "./editor-stranek.php";
  }

} else { //vypiseme verzi stranky pro neprihlasene
   require_once "./prihlasovaci_form.php";
}

?>


</body>
</html>
