/*
  Script de login de Clientes
  Descripcion: Lineas de codigo que permite la validacion de campos usando jquery validate, y realizar una peticion a un servicio
  que se encuentra en un controlador y este revibe como respuesta los datos del cliente ingresado si existe en la base de datos
*/
(function() {
    $("#frmLoginCliente").tooltip({
      show: false,
      hide: false
    });
  
    //Validar Campos del formulario
    $("#frmLoginCliente").validate({
      rules: {
        txtUsuario:"required",
        txtPassword:"required"
      },
      messages: {
        txtUsuario: "Por favor ingrese un usuario",
        txtPassword: "Por favor ingrese una contraseña"
      },
      submitHandler: function(form) {    
        var txt_user = $("#txtUsuario").val()
        var txt_password = $("#txtPassword").val()

        $.post("/Valoraciones/index.php/persona/login", { usuario: txt_user, password: txt_password })
        .done(function(result){
          if($.trim(result) != "[]"){
            window.location.href = "index.php/persona/home";  
          }
          
        })
        
      }
    });     
    
})();

