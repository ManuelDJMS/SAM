// var examples = {}
// window.examples = examples
// // Basic - shows what a default table looks like

// examples.basic = function () {
//   const pdf = new jsPDF();
//   let nombre = document.querySelector("#Cot");
//   var name = `Nombre ${nombre.value}`; 

//    pdf.text(10, 10, name);
//   return pdf
// }



const pdf = new jsPDF();
      let button = document.querySelector(".btnGuardar");
      let nombre = document.querySelector("#Cot");
      // let direccion = document.querySelector(".direccion");
      // let nombredelpadre = document.querySelector(".nombredelpadre");
      // let nombredelamadre = document.querySelector(".nombredelamadre");

      button.addEventListener('click', printPDF)


      function printPDF() {
      console.log(nombre.value);
        var opc = "obtener_registros";
        $.post("dist/fw/usuarios.php",{opc:opc},function(data){
          nombre = "Jhony";
            if(data){
              nombre = "jose luis";
            }
           
        });
        nombre = "Paulina";
         var name = `Nombre ${nombre}`; 
        //  var endereco = `Direccion ${direccion.value}`;
        //  var email = `Nombre de la Madre ${nombredelamadre.value}`; 
        //  var celular = `Nombre del Padre ${nombredelpadre.value}`; 

         pdf.text(10, 10, name);
        //  pdf.text(10, 20, endereco);
        //  pdf.text(10, 30, email);
        //  pdf.text(10, 40, celular);

         pdf.save();
      }



