const poleOdkazuSmazani = document.querySelectorAll(".odkaz-smazani");
for (let odkaz of poleOdkazuSmazani) {
  odkaz.addEventListener("click", (e) => {
    e.preventDefault();
    //vraci bool podle volby uzivatele
    const volbaBoolean = confirm("Jste si jisti, ze chcete stranku smazat? Tato akce je NEVRATNA!!!!");
    if (volbaBoolean) {
      //smazame stranku
      const cilOdkazu = odkaz.getAttribute("href");
      //odkazeme ho pryc na mazaci url
      window.location.href = cilOdkazu;
    }
  });
}

//sortable
$(".seznam-stranek-ul").sortable({
  update: () => {
    const poleId = $(".seznam-stranek-ul").sortable("toArray");
    console.log(poleId)
    $.ajax({
      type: "POST",
      url: "./admin.php",
      data: {
        razeniSubmit: true,
        poleSerazenychId: poleId
      },
      dataType: "json",
      success: (response) => { //kdyz dostane jakoukoli odpoved i treba 404, atd. neni success pokud dojde k timeoutu napr
        console.log(response);
      }
  });

  }


});
