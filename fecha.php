<style type="text/css">
 .mifecha {background-color:#ff7800; padding:3px; width:110px; text-align:center; font-family:verdana, arial; font-size:12pt; border-radius:5px;} .mifecha .ano{background-color:#707070; color:#ffe3c1; padding:2px; font-size:100%; margin-bottom:3px; letter-spacing:2px; font-weight:bold;} .mifecha .dia{background-color:#4ba3d8; color:#1957c0; font-size:300%; padding:2px 8px 5px; margin-bottom:3px; font-weight:bold; text-shadow:1px 1px 1px #000;} .mifecha .mes{background-color:#707070; color:#ffe3c1; font-size:80%; padding:2px; font-weight:bold;} </style> <script type="text/javascript">
 var f=new Date();
  var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
   document.write('<div class="mifecha">');
    document.write('<div class="ano">' + f.getFullYear() + '</div>');
     document.write('<div class="dia">' + f.getDate() + '</div>'); document.write('<div class="mes">' + meses[f.getMonth()] + '</div>');
      document.write('</div>');

       </script>